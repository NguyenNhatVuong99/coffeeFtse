<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           $data=[
            ['name'=>'Tầng 1'],
            ['name'=>'Tầng 2'],
            ['name'=>'Tầng 3'],
        ];
        DB::table('areas')->insert($data);
    }
}
