<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Parse the data file.
     * $path = path to data file relative to base_path
     * default = data.json
     *
     * @return Array
     */

    private function import($path = "data.json"){
        $file_contents = json_decode(file_get_contents(base_path($path)), true);
        dd($file_contents);
    }


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        //! Importing the data.json file as a seed source
        //  I'm using json fields to simulate relations.
        //  Also in models i'm using accessors to the same effect.
        $this->import();

    }
}
