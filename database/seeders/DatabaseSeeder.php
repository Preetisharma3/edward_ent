<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\str;

class DatabaseSeeder extends Seeder
{

  
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('types')->insert([
             'id'=>3,
            'question_type'=>'Text_Field',
            'type_id'=>1
            
            

        ]);
    }
}
