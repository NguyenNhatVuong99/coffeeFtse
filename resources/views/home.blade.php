

@section('css')
<link rel="stylesheet" href="{{ 'css/table.css' }}">
<link rel="stylesheet" href="{{ 'css/index.css' }}">
@endsection
@section('js')
<script src="{{ 'js/formatNumber.js' }}"></script>
<script src="{{ 'js/table.js' }}"></script>
<script src="{{ 'js/order.js' }}"></script>
<script src="{{ 'js/currency.js' }}"></script>
@endsection
@extends('layout')
@section('content')
<div class="container" style="max-width:1200px">
   <div class="row">
      <div class="col-md-5">
         <ul class="tablist" role="tablist">
            <li class="tab" id="tab-map" onclick="changeTab('tab-map')" role="tab"><a href="#map">Sơ đồ</a></li>
            <li class="tab" id="tab-menu" onclick="changeTab('tab-menu')" role="tab"><a href="#menu">Menu</a></li>
            <li class="tab-menu">
               <div class="line"></div>
               <div class="line"></div>

               <div class="line"></div>
            </li>
         </ul>
         <div class="tabpanel" id="content-tab-map" role="tabpanel">
            <div class="sub_tabs" id="listTable">
               {{-- @php
               $arr_area_id=array();
               @endphp
               @foreach ($areas as $key=>$area)
               @php
               array_push($arr_area_id,$area->id)
               @endphp
               @if($key==0)
               <input type="radio" id="tab{{ $area->id }}" name="tab-control" checked>
               @else
               <input type="radio" id="tab{{ $area->id }}" name="tab-control">
               @endif
               @endforeach
               <ul>
                  @foreach ($areas as $key=>$area)
                  <li title="Features"><label for="tab{{ $area->id }}" role="button"><br><span>{{ $area->name }}</span></label></li>
                  @endforeach
               </ul>
               <div class="content row p-0">
                  @foreach ($arr_area_id as $key=> $area_id)
                  <section>
                     @foreach ($tables as $table)
                     @if($area_id==$table->area_id)
                     @if ($table->status==0)
                     <a class="col-2 p-0" href="javascript:getTable({{ $table->id }})">
                        <div id="table{{ $table->id }} " class="card">
                           <div class="card-title">
                              <h2 class="text-center">
                                 {{ $table->name }}
                              </h2>
                           </div>
                        </div>
                     </a>
                     @else
                     <a class="col-2 p-0" href="javascript:getTable({{ $table->id }})">
                        <div id="table{{ $table->id }} " class="card card-active">
                           <div class="card-title">
                              <h2 class="text-center">
                                 {{ $table->name }}
                              </h2>
                           </div>
                        </div>
                     </a>
                     @endif
                     @endif
                     @endforeach
                  </section>
                  @endforeach
               </div> --}}
            </div>
         </div>
         <div class="tabpanel" id="content-tab-menu" role="tabpanel">
            <div class="row">
               <div class="col-md-3 mb-3">
                  <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                     @php
                     $arr_category_id=array();
                     @endphp
                     @foreach ($categories as $key=> $item )
                     @php
                     array_push($arr_category_id,$item->id)
                     @endphp
                     @if($key=0)
                     <li class="nav-item">
                        <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#category_{{ $item->id }}" role="tab" aria-controls="category_{{ $item->id }}" aria-selected="true">{{ $item->name }}</a>
                     </li>
                     @else
                     <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#category_{{ $item->id }}" role="tab" aria-controls="category_{{ $item->id }}" aria-selected="false">{{ $item->name }}</a>
                     </li>
                     @endif
                     @endforeach
                  </ul>
               </div>
               <!-- /.col-md-4 -->
               <div class="col-md-9">
                  <div class="tab-content" id="myTabContent">
                     @foreach ($arr_category_id as $key=> $category_id)
                     @if($key==0)
                     <div class="tab-pane fade show active" id="category_{{ $category_id }}" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row cards m-auto">
                           @foreach ($products as $product)
                           @if($category_id==$product->category_id)
                           <div class="card" style="width:118px;"  onclick="addOrder({{ $product->id }})">
                           {{--  <a class="col-4" href="javascript:addOrder({{ $product->id }})">  --}}
                              <!-- Card -->
                              
                                <!-- Card image -->
                                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/43.jpg" alt="Card image cap">
                              
                                <!-- Card content -->
                                <div class="card-body" style="padding: 1.25em 0.3em">
                              
                                  <!-- Title -->
                                  {{--  <h4 class="card-title"><a>Card title</a></h4>  --}}
                                  <h5 class="card-text text-center fs-17">{{ $product->name }}</h5>
                                  <input type="hidden" class="input-price" value="{{ $product->sale_cost }}">
                                  <p class=" p-t-5 card-text text-center price"></>
                                    <script>
                                       formatNumber($(".input-price").val());
                                       $(".price").text(price+" VNĐ");
                                    </script>
                                  <!-- Text -->
                                  <!-- Button -->
                              
                                </div>
                              </div>
                              
                           {{--  </a>  --}}
                              {{--  <div class="card">
                                 <div class="card-title">
                                    <h2 class="text-center">
                                       {{ $product->name }}
                                    </h2>
                                 </div>
                              </div>  --}}
                           
                           @endif
                           @endforeach
                        </div>
                     </div>
                     @else
                     <div class="tab-pane fade" id="category_{{ $category_id }}" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row cards">
                           @foreach ($products as $product)
                           @if($category_id==$product->category_id)
                           <a class="col-4" href="javascript:addOrder({{ $product->id }})">
                              <div class="card">
                                 <div class="card-title">
                                    <h2 class="text-center">
                                       {{ $product->name }}
                                    </h2>
                                 </div>
                              </div>
                           </a>
                           @endif
                           @endforeach
                        </div>
                     </div>
                     @endif
                     @endforeach
                  </div>
               </div>
            </div>
            <!-- /.col-md-8 -->
         </div>
      </div>
      <div class="col-md-7">
         <div class="col-md-12 nav-link-wrap mb-5">
            <div class="cards" >
               <div class="card" style="width:100%; max-width:100%">
                  <div class="card-title">
                     <h4 id="table">
                     </h4>
                     <input type="hidden" id="table_id" value="">
                  </div>
                  <div class="card-body infoTable">
                   
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</section>
</div>
<div class="modal fade" id="move-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Chuyển bàn</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
          <input type="hidden" id="table_id_move_from" value="">
         <div class="form-group">
            <input type="text" required class="form-control" id="table_name_move_to" aria-describedby="emailHelp" placeholder="Nhập số bàn">
          </div>
          <div id="move_error">

          </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         <button type="button" onclick="moveTable()" class="btn btn-primary">Lưu</button>
       </div>
     </div>
   </div>
 </div>
 <div class="modal fade" id="merge-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Nhập bàn</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <input type="hidden" id="table_id_merge_from" value="">
        <div class="form-group">
           <input type="text" class="form-control" id="table_name_merge_to" aria-describedby="emailHelp" placeholder="Nhập số bàn">
         </div>
         <div id="merge_error">
         </div>
      </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="mergeTable()">Save changes</button>
       </div>
     </div>
   </div>
 </div>
@endsection

