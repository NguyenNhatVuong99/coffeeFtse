function getTable(table_id) {
    var document_id = $("#document_id").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/getTable',
        data: {
            table_id: table_id,
        },
        success: function(result) {
            {
                // console.log(result);
                var table = result.table;
                $("#table").text('Bàn ' + table.name + " - " + table.area.name);
                $("#table_id").val(table.id);
                $("#recently_time").val(table.id);
                var document = result.document;
                var details = result.details;
                if (result.status == 0) {
                    if (document == null) {
                        time_out = "";
                    } else {
                        time_out = document.time_out;
                    }
                    tableEmpty(time_out);
                } else {
                    tableFull(document, details);
                }
            }
        },
        error: function(error) {
            console.log(error);
        }


    });
}

function tableEmpty(time_out) {

    var content = "";
    content += '<div class="form-group row">' +
        '<label for="staticEmail"  class="col-sm-6 col-form-label">Trạng thái:</label>' +
        '<div class="col-sm-6">' +
        '<input type="text" id="status" readonly class="form-control-plaintext text-danger" id="staticEmail" value="Trống">' +
        '</div>' +
        '</div>' +
        '<div class="form-group row">' +
        '<label for="staticEmail"  class="col-sm-6 col-form-label">Phục vụ gần nhất:</label>' +
        '<div class="col-sm-6">' +
        '<input type="text" id="recently_time" readonly class="form-control-plaintext text-danger" id="staticEmail" value="">' +
        '</div>' +
        '</div>' +
        '<div class="form-group">' +
        '<button type="button" onclick="showMenu()" class="btn btn-primary">Mở bàn</button>' +
        '</div>';
    $(".infoTable").html(content);
    $("#recently_time").val(time_out);


}
defaultTab();

function defaultTab() {
    $("#content-tab-map").addClass('show');
}

function changeTab(id) {
    $(".tabpanel").removeClass("show");
    $(".tab").removeClass("tab-active");
    $("#content-" + id).addClass("show");
    $("#" + id).addClass("tab-active");
}

function showMenu() {
    $("#content-tab-map").removeClass("show");
    $("#content-tab-menu").addClass("show");
    $("#tab-map").removeClass("tab-active");
    $("#tab-menu").addClass("tab-active");
}


function addOrder(product_id) {
    var table_id = $("#table_id").val();
    if (table_id == "") {
        return false;
    }
    var document_id = $("#document_id").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/addOrder',
        data: {
            product_id: product_id,
            table_id: table_id,
        },
        success: function(result) {
            {
                alertify.success('Thêm thành công');
                var document = result.document;
                var details = result.details;
                if (!$("#table" + result.table_id).hasClass('card-active')) {
                    $("#table" + result.table_id).addClass('card-active');
                }
                tableFull(document, details);
            }
        }
    });
}

function tableFull(document, details) {
    url = "/temporaryPay/" + document.id;
    var content = ""
    content += '<div class="form-group row">' +
        '<label for="staticEmail" class="col-sm-6 col-form-label">Giờ đến: </label>' +
        '<div class="col-sm-6">' +
        '<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="' + document.time_in + '">' +
        '</div>' +
        '</div>' +
        '<div class="form-group row">' +
        '<label for="staticEmail" class="col-sm-6 col-form-label">Tình trạng:</label>' +
        '<div class="col-sm-6">' +
        '<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">' +
        '</div>' +
        '</div>' +
        '<div class="form-group row">' +
        '<label for="staticEmail" class="col-sm-6 col-form-label">Số lượng món:</label>' +
        '<div class="col-sm-6">' +
        '<input type="text" readonly class="form-control-plaintext" id="staticEmail" value="' + document.total_quantity + ' món">' +
        '</div>' +
        '</div>' +
        '<div class="row form-group ">' +
        '<div class="col-4 text-center">' +
        '<button type="button" onclick="showMenu()" class=" btn btn-primary">Gọi món</button>' +
        '</div>' +
        '<div class="col-4 text-center">' +
        '<a type="button" href="' + url + '" class="btn btn-primary" onclick="temporaryPay()">Tạm tính</a>' +
        '<a type="button" id="btn-pay" onclick="pay(' + document.id + ')" style="display:none"  class="btn btn-primary" ">Thanh toán</a>' +
        '</div>' +
        '<div class="col-4 text-center">' +
        '<button class="btn btn-primary" type="button"  id="move" data-toggle="modal"  data-target="#move-modal" aria-expanded="true" aria-controls="move">Chuyển </button>' +
        '</div>' +
        '<div class="col-4 text-center">' +
        '<button class="btn btn-primary" type="button" id="merge" data-toggle="modal" data-target="#merge-modal" aria-expanded="false" aria-controls="merge">Nhập </button>' +
        '</div>' +
        '</div>' +
        '<table class="table">' +
        '<thead>' +
        '<tr>' +
        '<th scope="col"></th>' +
        '<th scope="col">Tên</th>' +
        '<th scope="col">Giá</th>' +
        '<th scope="col">Số lượng</th>' +
        '<th scope="col">Thành tiền</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>';
    for (detail of details) {
        content += '<tr>' +
            '<th scope="row">' +
            '<button class="btn btn-danger btn-sm rounded-0" onclick=deleteProduct(' + document.id + "_" + detail.product_id + ') type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>' +
            '</th>' +
            '<td>' + detail.name + '</td>' +
            '<td>' + detail.sale_cost + '</td>' +
            '<td>' +
            '<div class="def-number-input number-input safari_only">' +
            '<button onclick="minus(' + document.id + "_" + detail.product_id + ')" class="minus"></button>' +
            '<input class="quantity" data-document="' + document.id + '" data-product="' + detail.product_id + '" onchane="changeQuantity(this);" id="quantity_' + document.id + detail.id + '" min="0" name="quantity" value="' + detail.quantity + '" type="number">' +
            '<button onclick="plus(' + document.id + detail.product_id + ')" class="plus"></button>' +
            '</div>' +
            '</td>';
        formatNumber(detail.price);
        content += '<td>' + price + ' VNĐ</td>' +
            '</tr>';
    }
    content += '</tbody>' +
        '<tfoot>' +
        '<tr>' +
        '<td colspan="4" class="text-center f-w-b">Tổng cộng</td>';
    formatNumber(document.total_price);
    readMoney(document.total_price);
    content += '<td>' + price + ' VNĐ</td>' +
        '</tr>' +
        '<tr >' +
        '<td colspan="5" class="text-center f-w-b text-up" >' + nameMoney + '</td>' +
        '</tr>' +
        '</tfoot>' +
        '</table>';
    $(".infoTable").html(content);
    listTable();


}
$(".quantity").on('keyup mouseup', function() {
    console.log($(this).val());
});

function minus(id) {
    var number = $("#quantity_" + id).val();
    if (number > 1) {
        number--;
    }
    $('#quantity_' + id).attr("value", parseInt(number));
    var document_id = $('#quantity_' + id).data("document");
    var product_id = $('#quantity_' + id).data("product");
    updateOrder(document_id, product_id, number);
}

function plus(id) {
    var number = $("#quantity_" + id).val();
    number++;
    $('#quantity_' + id).attr("value", parseInt(number));
    var document_id = $('#quantity_' + id).data("document");
    var product_id = $('#quantity_' + id).data("product");

    updateOrder(document_id, product_id, number);
}

function changeQuantity(e) {
    console.log(e);
}

function updateOrder(document_id, product_id, number) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/updateOrder',
        data: {
            document_id: document_id,
            product_id: product_id,
            number: number,
        },
        success: function(result) {
            {
                alertify.success('Thay đổi thành công');
                var document = result.document;
                var details = result.details;
                tableFull(document, details);
            }
        }
    });
}

function deleteProduct(id) {
    var document_id = $('#quantity_' + id).data("document");
    var product_id = $('#quantity_' + id).data("product");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/deleteProduct',
        data: {
            document_id: document_id,
            product_id: product_id,
        },
        success: function(result) {
            {
                alertify.success('Xóa thành công');
                var document = result.document;
                var details = result.details;
                tableFull(document, details);
            }
        }
    });
}


$('body').on('click', '#move', function() {
    var table_id = $("#table_id").val();
    $("#table_id_move_from").val(table_id);
});
$('body').on('click', '#merge', function() {
    var table_id = $("#table_id").val();
    $("#table_id_merge_from").val(table_id);
});

function moveTable() {
    var table_id_from = $("#table_id_move_from").val();
    var table_name_to = $("#table_name_move_to").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/moveTable',
        data: {
            table_id_from: table_id_from,
            table_name_to: table_name_to,
        },
        success: function(result) {
            {
                $("#move-modal").modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                getTable(result.table_id_to);
                alertify.success('Chuyển bàn thành công');
            }
        },
        error: function(errors) {
            var error = errors.responseJSON.errors;
            if (error.table_name_to) {
                var table_name_to = error.table_name_to[0];
            }
            var content = '<div class="alert alert-danger" role="alert">' +
                table_name_to +
                '</div>';
            $("#move_error").html(content);
        }
    });
}
//NHẬP BÀN
function mergeTable() {
    var table_id_from = $("#table_id_merge_from").val();
    var table_name_to = $("#table_name_merge_to").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/mergeTable',
        data: {
            table_id_from: table_id_from,
            table_name_to: table_name_to,
        },
        success: function(result) {
            {
                $("#merge-modal").modal('hide');
                getTable(result.table_id_to);
                alertify.success('Nhập bàn thành công');
            }
        },
        error: function(errors) {
            // console.log(errors);
            var error = errors.responseJSON.errors;
            if (error.table_name_to) {
                var table_name_to = error.table_name_to[0];
            }
            var content = '<div class="alert alert-danger" role="alert">' +
                table_name_to +
                '</div>';
            // console.log(content);
            $("#merge_error").html(content);
        }
    });
}

function temporaryPay(id) {
    $("#btn-pay").css("display", "block");
}

function pay(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: '/pay',
        data: {
            id: id,
        },
        success: function(result) {
            {
                tableEmpty();
                listTable();
                getTable(result);
                alertify.success('Thanh toán thành công');
            }
        },
    });
}
listTable();

function listTable() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/listTable',
        success: function(result) {
            var areas = result.areas;
            var tables = result.tables;
            var arr_area_id = [];
            var content = "";
            for (var key in areas) {
                arr_area_id.push(areas[key].id);
                if (key == 0) {
                    content += '<input type="radio" id="tab' + areas[key].id + '" name="tab-control" checked>';
                } else {
                    content += '<input type="radio" id="tab' + areas[key].id + '" name="tab-control">';
                }
            }
            content += "<ul>";
            for (var key in areas) {
                content += '<li title="Features"><label for="tab' + areas[key].id + '" role="button"><br><span>' + areas[key].name + '</span></label></li>';
            }
            content += "</ul>" +
                '<div class="content row p-0">';
            for (var key in arr_area_id) {
                content += "<section>";
                for (table of tables) {
                    if (arr_area_id[key] == table.area_id) {
                        if (table.status == 0) {
                            content += '<a class="col-2 p-0" href="javascript:getTable(' + table.id + ')">' +
                                '<div id="table' + table.id + ' " class="card">' +
                                '<div class="card-title">' +
                                '<h2 class="text-center">' + table.name + '</h2>' +
                                '</div>' +
                                '</div>' +
                                '</a>';
                        } else {
                            content += '<a class="col-2 p-0" href="javascript:getTable(' + table.id + ')">' +
                                '<div id="table' + table.id + ' " class="card card-active">' +
                                '<div class="card-title">' +
                                '<h2 class="text-center">' + table.name + '</h2>' +
                                '</div>' +
                                '</div>' +
                                '</a>';
                        }
                    }
                }
                content += "</section>";
            }
            content += '</div>';
            $("#listTable").html(content);
        },
    });
}