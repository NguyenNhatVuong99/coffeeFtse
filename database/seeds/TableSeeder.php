<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<91; $i++){
            if($i<91 &&$i>61){
                $data=[
                    ['name'=>$i, 'area_id'=>'3','status'=>0],
                ];
                DB::table('tables')->insert($data);
            }
            
            else if($i<61 && $i>31 ){
                $data=[
                    ['name'=>$i, 'area_id'=>'2','status'=>0],
                ];
                DB::table('tables')->insert($data);
               
            }else{
                $data=[
                    ['name'=>$i, 'area_id'=>'1','status'=>0],
                ];
                DB::table('tables')->insert($data);

            }
            
        }
        
    }
}
