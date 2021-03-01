<?php

use Illuminate\Support\Facades\Route;

use App\Models\Item;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{item?}', function (Item $item = null) {
    if(!$item){
        return view('items', ['items' => Item::all()]);
    }
    $view_data = $item->cost_data['data'];
    [ 'labor' => $labor, 'non_labor' => $non_labor ] = $view_data;

    $performers = collect(['labor' => $labor, 'non_labor' => $non_labor])->reduce(function($curr, $v, $name){
        foreach(calculate($v) as $performer => $tasks){
            if(!isset($curr[$performer])){
                $curr[$performer] = [];
            }
            foreach($tasks as $task){
                if(!isset($curr[$performer][$task['title']])){
                    $curr[$performer][$task['title']] = [];
                }
                $curr[$performer][$task['title']][$name] = $task['total'];
                $curr[$performer][$task['title']]['title'] = $task['title'];
            }
        }
        return $curr;
    }, []);

    return view('item', ['item' => $item, 'data' => collect($performers)]);
});

function calculate($v){
    $groups = Arr::get($v, 'groups');

    return collect($groups)->pluck('tasks', 'performer.display_name')->map(function($v, $k){
        return collect($v)->map(function($vv){

                $vv['total'] = collect($vv['items'])->pluck('fiscal_years')->map(function($vvv){
                    return collect($vvv)->sum('total_dollars');
                })->sum();
                return $vv;
            });
    });

}
