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
    foreach([$labor, $non_labor] as $v){
        $performers = calculate($v);
        $total = $performers->pluck('fiscal_years')->map(function($v){
            return collect($v)->sum('total_dollars');
        })->sum();
        dump($performers, $total);
    }

    return view('item', ['item' => $item]);
});

function calculate($v){
    $groups = Arr::get($v, 'groups');
    $performers = collect($groups)->pluck('tasks.0.items', 'performer.display_name')->flatten(1);
    return $performers;
}
