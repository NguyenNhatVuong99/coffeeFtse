<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'admin','email'=>'admin@gmail.com','password'=>bcrypt('admin')],
            ['name'=>'thungan1','email'=>'thungan1@gmail.com','password'=>bcrypt('thungan1')],
            ['name'=>'thungan2','email'=>'thungan2@gmail.com','password'=>bcrypt('thungan1')],
        ];
        DB::table('users')->insert($data);
    }
}
