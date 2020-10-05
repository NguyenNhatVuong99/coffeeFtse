<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Cà phê Việt Nam','type'=>1],
            ['name'=>'Cà phê máy','type'=>1],
            ['name'=>'Cold brew','type'=>1],
            ['name'=>'Trà trái cây','type'=>1],
            ['name'=>'Trà sữa macchiato','type'=>1],
            ['name'=>'Cà phê đá xay','type'=>1],
            ['name'=>'Thức uống trái cây','type'=>1],
            ['name'=>'Nguyên liệu','type'=>2],
        ];
        DB::table('categories')->insert($data);
    }
}
