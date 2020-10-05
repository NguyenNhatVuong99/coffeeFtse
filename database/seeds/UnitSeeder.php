<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'ly'],
            ['name'=>'kg'],
        ];
        DB::table('units')->insert($data);
    }
}
