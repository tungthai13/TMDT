/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function kiemTraGioHangRong() {

    if (gioHang.length != 0) {
        return true;
    } else {
        $.notify("Bạn chưa chọn món ăn nào", "warn");
        return false;
    }
}

$("#quayLai").click(function () {
    window.location.href = "index.jsp";
});

//Lay thong tin gio Hang
var maTaiKhoan1 = document.getElementById("maTaiKhoan").value;
var listThucDon = document.getElementsByClassName("themMon");
var maCuaHang = document.getElementById("maCuaHang").value;

document.getElementById("json").value = localStorage.getItem("gioHang" + maCuaHang+ "_" + maTaiKhoan1);
var gioHang = [];

if (localStorage.getItem("gioHang" + maCuaHang + "_" + maTaiKhoan1) !== null) {
    gioHang = JSON.parse(localStorage.getItem("gioHang" + maCuaHang + "_" + maTaiKhoan1));
    capNhatGioHang();
} else {
    localStorage.setItem("gioHang" + maCuaHang + "_" + maTaiKhoan1, JSON.stringify(gioHang));
}

//Xu ly nut them mon
var monAn;
function themMon(id) {
    var tenMon = document.getElementById("tenMon" + id).value;
    var donGia = document.getElementById("donGia" + id).value;
    document.getElementById("them" + id).onclick = function () {

        if (layViTriTrongGioHang(id) !== -1) {
            gioHang[layViTriTrongGioHang(id)].soLuong = gioHang[layViTriTrongGioHang(id)].soLuong + 1;
        } else {
            monAn = {
                maMon: id,
                tenMon: tenMon,
                soLuong: 1,
                donGia: donGia
            };
            gioHang.push(monAn);
        }

        capNhatGioHang();

        $.notify("Thêm 1 " + tenMon + " thành công", "success");
    };
}

//Xu ly nut bot mon
function botMon(id) {
    var tenMon = document.getElementById("tenMon" + id).value;
    var donGia = document.getElementById("donGia" + id).value;
    document.getElementById("bot" + id).onclick = function () {

        if (layViTriTrongGioHang(id) !== -1) {
            gioHang[layViTriTrongGioHang(id)].soLuong = gioHang[layViTriTrongGioHang(id)].soLuong - 1;
            if (gioHang[layViTriTrongGioHang(id)].soLuong === 0) {
                gioHang.splice(layViTriTrongGioHang(id), 1);
            }
        }

        capNhatGioHang();

        $.notify("Bớt 1 " + tenMon + " thành công", "success");
    };
}

for (var i = 1; i <= listThucDon.length; i++) {
    themMon(i);
    botMon(i);

}

function layViTriTrongGioHang(maMon) {
    for (var i = 0; i < gioHang.length; i++) {
        if (gioHang[i].maMon == maMon) {
            return i;
        }
    }

    return -1;
}


function capNhatGioHang() {
    $("tBody").empty();
    var x = [];
    var tongTien = 0;
    for (var i = 0; i < gioHang.length; i++) {
        var html = '<tr>' +
                '<td> <strong> ' + gioHang[i].soLuong + ' </strong>' + gioHang[i].tenMon + '</td>' +
                '<td> giá: ' + formatCurrency(gioHang[i].donGia+"") + ' VNĐ </td> </tr>';
        tongTien += gioHang[i].donGia * gioHang[i].soLuong;
        x.push(html);
    }

    var html1 = '   <tr>  ' +
            '          <td>Tổng </td>  ' +
            '          <td id="money"> ' + formatCurrency(tongTien+"") + ' VNĐ </td>  ' +
            '   </tr>  ' +
            '   <tr>  ' +
            '          <td>' +
            '<input type="hidden" id="json" name="json" value=""/>' +
            '<input type="hidden" id="tenCuaHang" name="tenCuaHang" value=""/>' +
            '<input type="hidden" id="diaChiCuaHang" name="diaChiCuaHang" value=""/>' +
            '<input type="submit" class="pull-right btn btn-success" value="Đặt Mua"/>' +
            '</td>  ' +
            '  </tr>  ';
    $("tBody").prepend(html1);
    /*$("tBody").prepend(roHang);*/
    for (var i = 0; i < x.length; i++) {
        $("tBody").prepend(x[i]);
    }

    localStorage.setItem("gioHang" + maCuaHang + "_" + maTaiKhoan1, JSON.stringify(gioHang));
    document.getElementById("json").value = localStorage.getItem("gioHang" + maCuaHang + "_" + maTaiKhoan1);
    document.getElementById("tenCuaHang").value = document.getElementById("tenCH").value;
    document.getElementById("diaChiCuaHang").value = document.getElementById("dcCH").value;
}

$("#reset").click(function () {
    gioHang = [];
    localStorage.removeItem("gioHang" + maCuaHang + "_" + maTaiKhoan1);
    $("tBody").empty();
    var html = '   <tr>  ' +
            '          <td>Tổng </td>  ' +
            '          <td id="money"> 0 VNĐ </td>  ' +
            '   </tr>  ' +
            '   <tr>  ' +
            '          <td>' +
            '<input type="hidden" id="json" name="json" value=""/>' +
            '<input type="hidden" id="tenCuaHang" name="tenCuaHang" value=""/>' +
            '<input type="hidden" id="diaChiCuaHang" name="diaChiCuaHang" value=""/>' +
            '<input type="submit" class="pull-right btn btn-success" value="Đặt Mua"/>' +
            '</td>  ' +
            '  </tr>  ';
    $("tBody").prepend(html);
    document.getElementById("tenCuaHang").value = document.getElementById("tenCH").value;
    document.getElementById("diaChiCuaHang").value = document.getElementById("dcCH").value;
});

function formatCurrency(numberStr) {
    return numberStr.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


