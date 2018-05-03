/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    var diemCham = parseInt(document.getElementById("diemCham").value);
    var maTaiKhoan = document.getElementById("maTaiKhoan").value;
    if (diemCham === -1) {
        diemCham = 0;
    }
    $("#rateYo").rateYo({
        numStars: 10,
        fullStar: true,
        rating: diemCham / 2
    }).on("rateyo.set", function (e, data1) {
        $("#diemCham").val(data1.rating * 2);
        $.notify("Bạn đã chấm " + data1.rating * 2 + " điểm cho cửa hàng", "success");

        $.ajax({
            url: 'ChamDiem',
            data: {
                diem: (data1.rating * 2),
                maCuaHang: maCuaHang,
                maTaiKhoan: maTaiKhoan
            },
            type: 'get',
            cache: false,
            success: function (data) {
                $('#diem').text(data);
            },
            error: function () {
                alert('error');
            }
        });
    });

});