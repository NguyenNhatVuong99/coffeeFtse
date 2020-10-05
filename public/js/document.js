function getType(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/type/' + id,
        success: function(result) {
            var documents = result.documents;
            // console.log(result.documents.length);
            var content = "";
            if (documents.length == 0) {
                content += '<tr><td  class="text-center" colspan="10">Dữ liệu trống</td></tr>';
            } else {
                var index = 1;
                for (var document of documents) {
                    content += '<tr>' +
                        '<td> ' + index + ' </td>' +
                        '<td> ' + document.type.name + '</td>' +
                        '<td>' + document.document_id + '</td>' +
                        '<td>' + document.date + ' </td>' +
                        '<td> ' + document.total_quantity + '</td>' +
                        '<input type="hidden" class="input_total_price" value=' + document.total_price + '>' +
                        '<td class="total_price"></td>';

                    if (document.cutomer_id == undefined) {
                        content += '<td></td>';
                    } else {
                        content += '<td>' + document.cutomer_id + ' </td>';
                    }
                    if (document.content == null) {
                        content += '<td></td>';
                    } else {
                        content += '<td>' + document.content + ' </td>';
                    }
                    content += '<td>' + document.user_name + '</td>' +
                        '</tr>';
                    index++;
                }

            }
            $("#body_document").html(content);
        }
    });
}
formatNumber($(".input_total_price").val());
$(".total_price").text(price + " VNĐ");

function myFunction() {
    console.log('ok');
}