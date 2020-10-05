<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Table;
use App\Models\Category;
use App\Models\Product;
use App\Models\Document;
use App\Models\DetailDocument;
use App\Models\TypeDocument;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use  App\Http\Requests\TableRequest;
class HomeController extends Controller
{
    public function index(){
        $data['areas']=Area::all();
        $data['tables']=Table::all();
        $data['categories']=Category::where('type',1)->get();
        $data['products']=Product::all();
        return view('home',$data);
    }
    public function getTable(Request $request){
        $data['table']=Table::with(['Area'])->where('id',$request->table_id)
                        ->first();
        $document=Document::where('table_id',$request->table_id)
                            ->where('status',1)
                            ->first();

        if($document==null && $data['table']->status==0){
            $data['status']=0;
            $data['document']=Document::where('table_id',$request->table_id)
                            ->where('status',0)
                            ->where('time_out','<',Carbon::now())
                            ->orderBy('time_out', 'DESC')
                            ->first();
                        return json_encode($data,404);          
        }  
        else{
            $data['status']=1;
            $document_id=$document->id;
            $data['details']=DetailDocument::leftJoin('products', 'detail_documents.product_id', 'products.id')
                                        ->where('document_id',$document_id)
                                        ->get();
            $data['document']=$document;                            
        }                 
        return json_encode($data);
    }
    public function addOrder(Request $request){
        $type=TypeDocument::where('code','PBL')->first();
        $product_id=$request->product_id;
        $table_id=$request->table_id;
        $document_id=$request->document_id;
        $product=Product::find($product_id);
        $document=Document::where('table_id',$table_id)
                    ->where('status',1)
                    ->first();            
        if($document==null){
            $newDocument=new Document();
            $newDocument->date=Carbon::now();
            $newDocument->type_id=$type->id;
            $newDocument->table_id=$table_id;
            $newDocument->total_quantity=1;
            $newDocument->time_in=Carbon::now();
            $newDocument->user_id= Auth::user()->id;
            $newDocument->status= 1;
            $newDocument->save();
            $table=Table::find($table_id);
            $table->status=1;
            $table->save();
            $document_id=$newDocument->id;
            $document=Document::find($document_id);
            $document->document_id=substr((string)Carbon::now()->year, 2, 2)."PBL".$document_id;
            $document->save();
            $newDetail=new DetailDocument();
            $newDetail->document_id=$document_id;
            $newDetail->product_id=$product_id;
            $newDetail->quantity=1;
            $newDetail->price=$product->sale_cost;
            $newDetail->save();
        }
        else{
            $document_id=$document->id;
            $detail=DetailDocument::where('document_id',$document_id)
                                ->where('product_id',$product_id)
                                ->first();
            if($detail==null){
                $newDetail=new DetailDocument();
                $newDetail->document_id=$document_id;
                $newDetail->product_id=$product_id;
                $newDetail->quantity=1;
                $newDetail->price=$product->sale_cost;
                $newDetail->save(); 
            } 
            else{                  
                $quantity=$detail->quantity+1;
                $price=$product->sale_cost*$quantity;
                $detail->quantity=$quantity;                        
                $detail->price=$price;
                $detail->save();
            }

        }
        $total_quantity=DetailDocument::where('document_id',$document_id)->sum('quantity');
        $total_price=DetailDocument::where('document_id',$document_id)->sum('price');
        $document=Document::where('table_id',$table_id)
        ->where('status',1)
        ->first();  
        $document->price=$total_price;
        $document->total_price=$total_price;
        $document->total_quantity=$total_quantity;
        $document->save();
        $data['document']=Document::where('table_id',$table_id)
                            ->where('status',1)
                            ->first();  
        $data['details']=DetailDocument::leftJoin('products', 'detail_documents.product_id', 'products.id')
                                        ->where('document_id',$document_id)
                                        ->get();
                                        $data['table_id']=$table_id;
        return json_encode($data);
    }
    public function updateOrder(Request $request){
        $document_id=$request->document_id;
        $product_id=$request->product_id;
        $number=$request->number;
        $product=Product::find($product_id);
        $detail=DetailDocument::where('product_id',$product_id)
                            ->where('document_id',$document_id)
                            ->first();
        $detail->quantity=$number;
        $detail->price=$number*$product->sale_cost;
        $detail->save();    
        $total_quantity=DetailDocument::where('document_id',$document_id)->sum('quantity');
        $total_price=DetailDocument::where('document_id',$document_id)->sum('price');     
        $document=Document::where('id',$document_id)
                        ->where('status',1)
                        ->first();  
        $document->price=$total_price;
        $document->total_price=$total_price;
        $document->total_quantity=$total_quantity;
        $document->save();
        $data['document']=Document::where('id',$document_id)
                            ->where('status',1)
                            ->first();  
        $data['details']=DetailDocument::leftJoin('products', 'detail_documents.product_id', 'products.id')
                                        ->where('document_id',$document_id)
                                        ->get();
        return json_encode($data);          
    }
    public function deleteProduct(Request $request){
        $document_id=$request->document_id;
        $product_id=$request->product_id;
        $detail=DetailDocument::where('product_id',$product_id)
                            ->where('document_id',$document_id)
                            ->first();
        $detail->delete();    
        $total_quantity=DetailDocument::where('document_id',$document_id)->sum('quantity');
        $total_price=DetailDocument::where('document_id',$document_id)->sum('price');     
        $document=Document::where('id',$document_id)
                        ->where('status',1)
                        ->first();  
        $document->price=$total_price;
        $document->total_price=$total_price;
        $document->total_quantity=$total_quantity;
        $document->save();
        $data['document']=Document::where('id',$document_id)
                            ->where('status',1)
                            ->first();  
        $data['details']=DetailDocument::leftJoin('products', 'detail_documents.product_id', 'products.id')
                                        ->where('document_id',$document_id)
                                        ->get();
        return json_encode($data);          
    }
    public function moveTable(TableRequest $request){
        $table_id_from=$request->table_id_from;
        $table_name_to=$request->table_name_to;
        $table_new=Table::where('name',$request->table_name_to)
                        ->first();
        $table_id_to=$table_new->id;
        if($table_id_to==$table_id_from){
            return response()
            ->json(['errors'=>
                ['table_name_to' => Array('Vui lòng chọn bàn khác')],
            ],422);
        }
        $table_to=Document::where('table_id',$table_id_to)
                            ->where('status',0)
                            ->first();
        $table_from=Document::where('table_id',$table_id_from)
                            ->where('status',1)
                            ->first();
        if($table_to!=null && $table_from==null){
            return response()
                ->json(['errors'=>
                    ['table_name_to' => Array('Hiện tại bàn số '.$request->table_name_to.' không trống')],
                ],422);
        }
        else{
            $table_from->table_id=$table_id_to;
            $table_from->save();
            $table_new=Table::where('name',$table_name_to)
                        ->first();
            $table_new->status=1;
            $table_new->save();
            $table_old=Table::find($table_id_from);
            $table_old->status=0;
            $table_old->save();            
            return response()->json(['table_id_to'=>$table_id_to],200);
        }                    
    }
    public function mergeTable(TableRequest $request){
        $table_id_from=$request->table_id_from;
        $table_name_to=$request->table_name_to;
        $table_new=Table::where('name',$request->table_name_to)
                        ->first();
        $table_id_to=$table_new->id;
        if($table_id_to==$table_id_from){
            return response()
            ->json(['errors'=>
                ['table_name_to' => Array('Vui lòng chọn bàn khác')],
            ],422);
        }
        
        $table_from=Document::where('table_id',$table_id_from)
                            ->where('status',1)
                            ->first();
        $table_to=Document::where('table_id',$table_id_to)
                            ->where('status',1)
                            ->first();
        if($table_to==null ){
            return response()
                ->json(['errors'=>
                    ['table_name_to' => Array('Bàn số '.$request->table_name_to.' không tồn tại')],
                ],422);
        }
        else{
            $table_old=Table::find($table_id_from);
            $table_old->status=0;
            $table_old->save();  
            $table_to=Document::where('table_id',$table_id_to)
                            ->where('status',1)
                            ->first();
            $document_id_to=$table_to->id;
            $document_id_from=$table_from->id;
            $details_from=DetailDocument::where('document_id',$document_id_from)->get();
            $details_to=DetailDocument::where('document_id',$document_id_to)->get();
            foreach($details_from as $item_from){
                $detail_from=DetailDocument::find($item_from->id);
                $product_id_from=$detail_from->product_id;
                $detail_from->document_id=$document_id_to;
                $detail_from->save();
                // dd($document_id_to);
                foreach($details_to as $item_to){
                    $detail_to=DetailDocument::find($item_to->id);
                    $product_id_to=$detail_to->product_id;
                    if($product_id_from==$product_id_to){
                        $detail_to->quantity+=$detail_from->quantity;
                        $detail_to->price+=$detail_from->price;
                        $detail_to->save();
                        $detail_from->delete();
                    }
                }
            }
            $total_quantity=DetailDocument::where('document_id',$document_id_to)->sum('quantity');
            $total_price=DetailDocument::where('document_id',$document_id_to)->sum('price');    
            $document_to=Document::where('id',$document_id_to)
                        ->where('status',1)
                        ->first();  
            $document_to->price=$total_price;
            $document_to->total_price=$total_price;
            $document_to->total_quantity=$total_quantity;
            $document_to->save();
            $document_from=Document::where('id',$document_id_from)
                        ->where('status',1)
                        ->first(); 
            $document_from->delete();
            return response()->json(['table_id_to'=>$table_id_to],200);
        }
    } 
    public function temporaryPay($id){
        $data['document']=Document::find($id);
        $table_id=$data['document']->table_id;
        $data['table']=Table::with(['Area'])->where('id',$table_id)->first();
        $data['details']=DetailDocument::leftJoin('products', 'detail_documents.product_id', 'products.id')
        ->where('document_id',$id)->get();
        return view("invoice",$data);
    }
    public function pay(Request $request){
        $document_id=$request->id;
        $document=Document::find($document_id);
        $document->status=0;
        $document->time_out=Carbon::now();
        $document->save();
        $table_id=$document->table_id;
        $table=Table::find($table_id);
        $table->status=0;
        $table->save();
        // $time_out=Carbon::now();
        return response()->json( $table_id);
    }
    public function listTable(){
        $data['areas']=Area::all();
        $data['tables']=Table::all();
        return json_encode($data);          
    }

}
