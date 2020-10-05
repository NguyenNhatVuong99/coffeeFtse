
@section('css')
{{-- {{-- <link rel="stylesheet" href="{{ 'css/table.css' }}"> --}}
<link rel="stylesheet" href="{{ 'css/crud.css' }}">
@endsection
@section('js')
<script src="{{ 'js/formatNumber.js' }}"></script>
<script src="{{ 'js/table.js' }}"></script>
<script src="{{ 'js/currency.js' }}"></script>
<script>
    formatNumber($(".input_total_price").val());
    $(".total_price").text(price+" VNĐ");
</script>
@endsection
@extends('layout')
@section('content')
<div class="container-xl" style="max-width:1266px">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Chứng từ</h2>
                    </div>
                    <div class="col-sm-8 row">
                        
                        <div class="col-3">
                            <button class="btn btn-danger"> <i class="fa fa-upload"> </i> Thêm</button>

                        </div>
                        <div class="col-3">
                            <button class="btn btn-primary"> <i class="fa fa-download"> </i> Thêm</button>

                        </div>
                        <div class="col-3">
                            <a href="{{ url('document/create ') }}" class="btn btn-success"> <i class="fa fa-plus"> </i> Thêm</a>

                        </div>
                        <div class="col-3">
                            <div class="search-box ">
                                <i class="fa fa-search"></i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active">
                          Tất cả
                        </button>
                        @foreach ($types as $type)
                            <button type="button" onclick="getType({{ $type->id }})" class="list-group-item list-group-item-action">{{ $type->name }}</button>

                        @endforeach
                      </div>
                </div>
                <div class="col-10">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr style="text-align:center;">
                                <th style="vertical-align: middle;" rowspan="2">STT</th>
                                <th colspan="3">Chứng từ</th>
                                <th colspan="2">Giá trị</th>
                                <th style="vertical-align: middle;" rowspan="2">Khách hàng</th>
                                <th style="vertical-align: middle;" rowspan="2">Nội dung</th>
                                <th style="vertical-align: middle;" rowspan="2">Người lập</th>
                            </tr>
                            <tr style="text-align:center;">
                                <th>Loại</th>
                                <th>Số chứng từ</th>
                                <th>Ngày lập</th>
                                <th>Số món</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody id="body_document">
                            @foreach ($documents as $key =>$document)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $document->type->name }}</td>
                                    <td>{{ $document->document_id }}</td>
                                    <td>{{ $document->date }}</td>
                                    <td>{{ ($document->total_quantity==null)? '' : $document->total_quantity }}</td>
                                    <input type="hidden" class="input_total_price" value="{{ $document->price }}">
                                    <td class="total_price"></td>
                                    <td>{{ ($document->cutomer_id==null)? '' : $document->cutomer_id }}</td>
                                    <td>{{ ($document->content==null)? '' : $document->content }}</td>
                                    <td>{{ $document->user_name }}</td>
                                    <td>
                                        <a href="#" class="view" title="View" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                                        <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                           
                          
                        </tbody>
                    </table>
                    {{ $documents->links() }}
                </div>
            </div>
           
          
        </div>
    </div>
</div>
@endsection