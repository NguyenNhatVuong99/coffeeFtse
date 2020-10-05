
@section('css')
{{-- {{-- <link rel="stylesheet" href="{{ 'css/table.css' }}"> --}}
<link rel="stylesheet" href="{{ asset('css/crud.css') }}">
@endsection
@section('js')
<script src="{{ asset('js/formatNumber.js') }}"></script>
<script src="{{ asset('js/document.js') }}"></script>
<script src="{{ asset('js/table.js') }}"></script>
<script src="{{ asset('js/currency.js') }}"></script>
<script>
    function myFunction() {
        console.log('ok');
    }
    formatNumber($(".input_total_price").val());
    $(".total_price").text(price+" VNĐ");
</script>
@endsection
@extends('layout')
@section('content')
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <h2>Thêm Chứng từ</h2>
                    </div>
                </div>
                
            </div>
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Loại chứng từ</label>

                    <select class="browser-default custom-select" onchange="myFunction()" >
                        <option value="XN">Phiếu nhập kho</option>
                        <option value="XN">Phiếu xuất kho</option>
                        <option value="TC">Phiếu thu</option>
                        <option value="TC">Phiếu chi</option>
                    </select>
                </div>
                <div class="xuat-nhap dis-none">
                    xuất nhập
                </div>
                <div class="thu-chi dis-none">
                    thu chi
                </div>
              </form>
          
        </div>
    </div>
</div>
@endsection