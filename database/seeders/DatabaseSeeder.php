<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\str;
 use Illuminate\Support\Facades\Hash;

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
        DB::table('users')->insert([
             'id'=>1,
           'email'=>'admin@gmail.com',
           'password'=>hash::make('password'),
           'first_name'=>'jyoti',
           'last_name'=>'mishra',
           'phone_no'=>'56789',
           'username'=>'gfhjkh',
           'status'=>1,
           'role'=>'Admin',
           'address'=>"ParkAvenue"
        ]);
        
    }
}