
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/formatNumber.js') }}"></script>
    <script src="{{ asset('js/currency.js') }}"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <button type="button" class="btn btn-primary" onclick="history.back();">Back</button> 

      <div class="card" id="invoice" style="width:60%; margin:auto" >
    
            <!-- Card image -->
          
            <!-- Card content -->
            <div class="card-body">
          
              <!-- Title -->
              <h4 class="card-title text-center" style="font-weight: bolder; font-size:2rem" ><a>Phiếu thanh toán</a></h4>
                        
              <form>
                <div class="form-row">
                    <div class="col">
                    <input type="text" readonly class=" text-center form-control-plaintext" id="staticEmail" value="Bàn số: {{ $table->name }}">
                    </div>
                    <div class="col">
                        <input type="text" readonly class=" text-center form-control-plaintext" id="staticEmail" value="Khu vực:{{ $table->Area->name }}">
                    </div>
                  </div>
                <div class="form-group row text-center" >
                  <label for="staticEmail" class="col-sm-2 col-form-label">Giờ vào</label>
                  <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $document->time_in }}">
                  </div>
                </div>
               
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Đơn giá</th>
                        <th scope="col">Thành tiền</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $key => $detail)
                        <input type="hidden" id="input_sale_cost" value="{{ $detail->sale_cost }}">
                        <input type="hidden" id="input_detail_price" value="{{ $detail->price }}">
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td class="sale_cost"></td>
                            <td class="detail_price"> </td>
                          </tr>
                        <script>
                            formatNumber($("#input_sale_cost").val());
                            $(".sale_cost").text(price+" VNĐ");
                            formatNumber($("#input_detail_price").val());
                            $(".detail_price").text(price+" VNĐ");
                        </script>
                        @endforeach
                     
                    </tbody>
                    <tfoot>
                        <input type="hidden" id="input_total_price" value="{{ $document->total_price }}">
                        <input type="hidden" id="input_price" value="{{ $document->price }}">
                        <tr style="font-weight: bolder">
                            <td colspan="4" >Tổng cộng</td>
                            <td colspan="1"  class="price"></td>
                        </tr>
                        <tr style="font-weight: bolder">
                            <td colspan="4" >Giảm giá</td>
                            <td colspan="1" class=""></td>
                        </tr>
                        <tr style="font-weight: bolder">
                            <td colspan="4" >Thanh toán</td>
                            <td colspan="1"  class=" total_price"></td>
                        </tr>
                        <tr style="font-weight: bolder">
                            <td colspan="3">Bằng chữ</td>
                            <td colspan="2" style="text-align:right" class=" string_money"></td>
                            
                        </tr>
                        <script>
                            readMoney($("#input_total_price").val());
                            $(".string_money").text(nameMoney);

                            formatNumber($("#input_total_price").val());
                            $(".total_price").text(price+" VNĐ");
                            formatNumber($("#input_price").val());
                            $(".price").text(price+" VNĐ");
                        </script>
                    </tfoot>
                  </table>
                  <p class="text-center">Xin cảm ơn, hẹn gặp lại quý khách</p>
              </form>
          
            </div>
          
        </div>
    
     </div>
     <script>
             window.print();
     </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   </body>
</html>