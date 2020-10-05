<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['name'=>'BẠC SỈU','unit_id'=>1,'category_id'=>1,'sale_cost'=>'20000'],
            ['name'=>'CÀ PHÊ ĐEN','unit_id'=>1,'category_id'=>1,'sale_cost'=>'20000'],
            ['name'=>'CÀ PHÊ SỮA','unit_id'=>1,'category_id'=>1,'sale_cost'=>'20000'],
            ['name'=>'CÀ PHÊ SỮA SÀI GÒN','unit_id'=>1,'category_id'=>1,'sale_cost'=>'20000'],
            ['name'=>'CÀ PHÊ ĐEN SÀI GÒN','unit_id'=>1,'category_id'=>1,'sale_cost'=>'20000'],
            ['name'=>'AMERICANO','unit_id'=>1,'category_id'=>2,'sale_cost'=>'20000'],
            ['name'=>'CAPPUCCINO','unit_id'=>1,'category_id'=>2,'sale_cost'=>'20000'],
            ['name'=>'CARAMEL MACCHIATO','unit_id'=>1,'category_id'=>2,'sale_cost'=>'20000'],
            ['name'=>'ESPRESSO','unit_id'=>1,'category_id'=>2,'sale_cost'=>'20000'],
            ['name'=>'LATTE','unit_id'=>1,'category_id'=>2,'sale_cost'=>'20000'],
            ['name'=>'MOCHA','unit_id'=>1,'category_id'=>2,'sale_cost'=>'20000'],
            ['name'=>'COLD BREW TRUYỀN THỐNG','unit_id'=>1,'category_id'=>2,'sale_cost'=>'20000'],
            ['name'=>'COLD BREW CAM VÀNG','unit_id'=>1,'category_id'=>3,'sale_cost'=>'20000'],
            ['name'=>'COLD BREW SỮA TƯƠI MACCHIATO','unit_id'=>1,'category_id'=>3,'sale_cost'=>'20000'],
            ['name'=>'COLD BREW PHÚC BỒN TỬ','unit_id'=>1,'category_id'=>3,'sale_cost'=>'20000'],
            ['name'=>'COLD BREW SỮA TƯƠI','unit_id'=>1,'category_id'=>3,'sale_cost'=>'20000'],
            ['name'=>'TRÀ Ô LONG VẢI','unit_id'=>1,'category_id'=>4,'sale_cost'=>'20000'],
            ['name'=>'TRÀ Ô LONG HẠT SEN','unit_id'=>1,'category_id'=>4,'sale_cost'=>'20000'],
            ['name'=>'TRÀ ĐÀO CAM SẢ','unit_id'=>1,'category_id'=>4,'sale_cost'=>'20000'],
            ['name'=>'TRÀ Ô LONG BƯỞI MẬT ONG','unit_id'=>1,'category_id'=>4,'sale_cost'=>'20000'],
            ['name'=>'TRÀ Ô LONG PHÚC BỒN TỬ','unit_id'=>1,'category_id'=>4,'sale_cost'=>'20000'],
            ['name'=>'TRÀ LÀI MACCHIATO','unit_id'=>1,'category_id'=>5,'sale_cost'=>'20000'],
            ['name'=>'TRÀ ĐEN MACCHIATO','unit_id'=>1,'category_id'=>5,'sale_cost'=>'20000'],
            ['name'=>'TRÀ SỮA MẮC CA TRÂN CHÂU TRẮNG','unit_id'=>1,'category_id'=>5,'sale_cost'=>'20000'],
            ['name'=>'TRÀ MATCHA MACCHIATO','unit_id'=>1,'category_id'=>5,'sale_cost'=>'20000'],
            ['name'=>'TRÀ XOÀI MACCHIATO','unit_id'=>1,'category_id'=>5,'sale_cost'=>'20000'],
            ['name'=>'TRÀ CÀ PHÊ ĐÁ XAY','unit_id'=>1,'category_id'=>5,'sale_cost'=>'20000'],
            ['name'=>'CÀ PHÊ ĐÁ XAY','unit_id'=>1,'category_id'=>6,'sale_cost'=>'20000'],
            ['name'=>'CHANH SẢ ĐÁ XAY','unit_id'=>1,'category_id'=>7,'sale_cost'=>'20000'],
            ['name'=>'PHÚC BỒN TỬ CAM ĐÁ XAY','unit_id'=>1,'category_id'=>7,'sale_cost'=>'20000'],
            ['name'=>'SINH TỐ CAM XOÀI','unit_id'=>1,'category_id'=>7,'sale_cost'=>'20000'],
            ['name'=>'SINH TỐ VIỆT QUẤT','unit_id'=>1,'category_id'=>7,'sale_cost'=>'20000'],
        ];
        DB::table('products')->insert($data);
    }
}
