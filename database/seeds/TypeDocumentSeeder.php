<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'Phiếu nhập kho','code'=>'PN'],
            ['name'=>'Phiếu xuất kho','code'=>'PX'],
            ['name'=>'Phiếu thu','code'=>'PT'],
            ['name'=>'Phiếu chi','code'=>'PC'],
            ['name'=>'Phiếu bán lẻ','code'=>'PBL'],
        ];
        DB::table('type_documents')->insert($data);
    }
}
