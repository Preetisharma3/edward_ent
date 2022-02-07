<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\str;
 use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('templates')->insert([
             'id'=>4,
             'template_name'=>'kajal',
             'question_name'=>'hgjkl',
             'answer'=>'ghjkl',
             'type'=>'text_field',
             'status'=>1
             
            
           
        ]);
    }
}
