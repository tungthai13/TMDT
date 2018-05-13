<%-- 
    Document   : thanhtoan
    Created on : Dec 7, 2017, 9:26:56 AM
    Author     : tungthai
--%>

<%@page import="dao.CuaHangDAO"%>
<%@page import="entity.CuaHang"%>
<%@page import="entity.MonAnChon"%>
<%@page import="java.util.List"%>
<%@page import="java.util.Locale"%>
<%@page import="java.text.DecimalFormat"%>
<%@page import="java.text.NumberFormat"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="js/checkout.js"></script>

        <title>JSP Page</title>

        <style>

            /* Media query for mobile viewport */
            @media screen and (max-width: 400px) {
                #paypal-button-container {
                    width: 100%;
                }
            }

            /* Media query for desktop viewport */
            @media screen and (min-width: 400px) {
                #paypal-button-container {
                    width: 250px;
                    display: inline-block;
                }
            }

            h2{
                text-align: center;
            }

            html, body {
                height: 100%;
            }

            html {
                display: table;
                margin: auto;
            }

            body {
                display: table-cell;
                vertical-align: middle;
            }

            .className{
                width:270px;
                height:150px;
                margin:0 auto;
            }


            #map {
                width: 100%;
                height: 450px;
                padding-bottom: 5px
            }

            .thongTin{
                float: right;
            }

        </style>
        <style type=”text/css” media=”print”>
            #print_button{
                display:none;
            }
        </style>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyA84UAqytUxGlER7GBT2E723Wjo3Pwlafg"></script>
    </head>
    <body>

        <div id="map"></div>
        <input type="hidden" name="latHome" id="latHome"/>
        <input type="hidden" name="lngHome" id="lngHome"/>
        <div id="directionsPanel"></div>

        <br>
        
        <div id="thanhCong"></div>

        <br>

        <h2>Thông tin giao hàng</h2>
        <table>
            <tr>
                <td class="thongTin">Số điện thoại:</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><strong>${soDT}</strong></td>
            </tr>
            <tr>
                <td class="thongTin">Địa chỉ:</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><strong>${diaChi}</strong></td>
            </tr>
            <tr>
                <td class="thongTin">Ngày giao hàng:</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><strong>${ngay}</strong></td>
            </tr>
            <tr>
                <td class="thongTin">Thời gian giao hàng:</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><strong>${gio}</strong></td>
            </tr>
            <tr>
                <td class="thongTin">Ghi chú đơn hàng:</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><strong>${ghiChu}</strong></td>
            </tr>
        </table>

        <br>

        <div id="khoangCach">
            <p>Phí vận chuyển: 5000 đ/km</p>
        </div>

        <br>

        <h2>Chi tiết đơn hàng</h2>
        <h3><%=request.getAttribute("tenCuaHang")%></h3>
        <p><%=request.getAttribute("diaChiCuaHang")%></p>
        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Tên món</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Tổng Giá</th>
            </tr>

            <%
                String maCuaHang = request.getParameter("maCuaHang");
                maCuaHang = maCuaHang.substring(0, maCuaHang.length() - 1);
                CuaHang ch = new CuaHangDAO().getCuaHang(Integer.parseInt(maCuaHang));
                Double lat = ch.getLat();
                Double lng = ch.getLng();
                NumberFormat nf = NumberFormat.getNumberInstance(Locale.GERMAN);
                DecimalFormat format = (DecimalFormat) nf;
                int tongTienThanhToan = 0;
                List<MonAnChon> gioHang = (List<MonAnChon>) request.getAttribute("gioHang");

                int i = 1;
                for (MonAnChon item : gioHang) {
                    tongTienThanhToan += item.tongGia();
            %>
            <tr>
                <td><%=i%></td>
                <td><%=item.getTenMon()%></td>
                <td><%=item.getSoLuong()%></td>
                <td><%=format.format(item.getDonGia())%> VNĐ</td>
                <td><%=format.format(item.tongGia())%> VNĐ</td>
            </tr>

            <% i++;
                }%>
        </table>
        <div id="tinhTien">
            <strong>Tổng: <%=format.format(tongTienThanhToan)%> VNĐ</strong>
        </div>
<<<<<<< HEAD

        <input type="hidden" id="tongTienThanhToan" value="<%=tongTienThanhToan%>"/>
        <input type="hidden" id="diaChiCuaHang" value="<%=request.getAttribute("diaChiCuaHang")%>"/>
        <input type="hidden" id="address" value="${diaChi}"/>
        <input type="hidden" id="lat" value="<%=lat%>"/>
        <input type="hidden" id="lng" value="<%=lng%>"/>
        <input type="hidden" id="maCuaHang" value="<%=maCuaHang%>"/>
        <input type="hidden" id="maTaiKhoan" value=""/>
        <input type="hidden" id="ngay" value="${ngay}"/>
        <input type="hidden" id="gio" value="${gio}"/>
        <input type="hidden" id="soDT" value="${soDT}"/>
        <input type="hidden" id="ghiChu" value="${ghiChu}"/>

=======
         <!--       array(10) {
  ["maTaiKhoan"]=> 
  ["maCuaHang"]=> 
  ["json"]=> 
  ["tenCuaHang"]=> 
  ["diaChiCuaHang"]=> 
  ["soDT"]=> 
  ["diaChi"]=> 
  ["ngay"]=> 
  ["gio"]=> 
  ["ghiChu"]=> 
} --> 
    <form action="<?php echo base_url(); ?>dathang/saveAll" method = "POST">
        <input type="hidden" id="tongTienThanhToan" name="tongTienThanhToan" value="<?php echo($tong); ?>"/>
        <input type="hidden" id="diaChiCuaHang" name="diaChiCuaHang" value="<?php echo $thanhtoan['diaChiCuaHang']; ?> "/>
        <input type="hidden" id="address" name="address" value="<?php echo $thanhtoan['diaChi']; ?>"/>
        <input type="hidden" id="lat" name="lat" value="<?php echo $cuaHang[0]['lat']; ?>"/>
        <input type="hidden" id="lng" name="lng" value="<?php echo $cuaHang[0]['lng']; ?>"/>
        <input type="hidden" id="maCuaHang" name="maCuaHang" value="<?php echo $thanhtoan['maCuaHang']; ?>"/>
        <input type="hidden" id="maTaiKhoan" value="<?php echo $thanhtoan['maTaiKhoan']; ?>"/>
        <input type="hidden"  name="maTaiKhoan" value="<?php echo $thanhtoan['maTaiKhoan']; ?>"/>
        <input type="hidden" id="ngay" name="ngay" value="<?php echo $thanhtoan['ngay']; ?>"/>
        <input type="hidden" id="gio" name="gio" value="<?php echo $thanhtoan['gio']; ?>"/>
        <input type="hidden" id="soDT" name="soDT" value="<?php echo $thanhtoan['soDT']; ?>"/>
        <input type="hidden" id="ghiChu" name="ghiChu" value="<?php echo $thanhtoan['ghiChu']; ?>"/>
        <input type="hidden" name="latHome" id="latHome"/>
        <input type="hidden" name="lngHome" id="lngHome"/> 
        <!-- <input type="hidden" name="khoangCach" id="khoangCach1" value="distance" />  -->
        <input type="submit" class="btn btn-primary" value="Đặt hàng"/>
    </form>
>>>>>>> parent of a6e66a2... Sửa xong
        <br>

        <script>
            function formatCurrency(numberStr) {
                return numberStr.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            document.getElementById("maTaiKhoan").value = localStorage.getItem("maTaiKhoan");
            var maCuaHang = document.getElementById("maCuaHang").value;
            var maTaiKhoan = document.getElementById("maTaiKhoan").value;

            var list = localStorage.getItem("gioHang" + maCuaHang + "_" + maTaiKhoan);
            var latCuaHang = parseFloat(document.getElementById("lat").value);
            var lngCuaHang = parseFloat(document.getElementById("lng").value);
            var diemDen = {
                lat: Number(latCuaHang),
                lng: Number(lngCuaHang)
            };

            var home = {
                lat: 0,
                lng: 0
            };

            var start = {}, end = {};

            $(document).ready(function () {
                // initialize(); 
            });

            var geocoder = new google.maps.Geocoder();
            var address = document.getElementById("address").value;

            geocoder.geocode({'address': address}, function (results, status) {

                if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();

                    initialize(latitude, longitude);

                    $("#latHome").val(latitude);
                    $("#lngHome").val(longitude);
                }

            });

            var directionDisplay;
            var directionsService = new google.maps.DirectionsService();
            function initialize(latitude, longitude) {

                var latlng = new google.maps.LatLng(latitude, longitude);
                directionsDisplay = new google.maps.DirectionsRenderer();
                var myOptions = {
                    zoom: 14,
                    center: latlng,
                    mapTypeControl: false
                };
                var map = new google.maps.Map(document.getElementById("map"), myOptions);
                directionsDisplay.setMap(map);
//                directionsDisplay.setPanel(document.getElementById("directionsPanel"));
//                var marker = new google.maps.Marker({
//                    position: latlng,
//                    map: map,
//                    title: "My location"
//                });
            }

            function calcRoute() {

                start.lat = Number($("#lat").val());
                start.lng = Number($("#lng").val());
                end["lat"] = Number($("#latHome").val());
                end["lng"] = Number($("#lngHome").val());

                var request = {
                    origin: diemDen,
                    destination: end,
                    travelMode: 'DRIVING'
                };
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                });

                //Lay khoang cach
                var a = new google.maps.LatLng(start.lat, start.lng);
                var b = new google.maps.LatLng(end.lat, end.lng);

                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                        {
                            origins: [a],
                            destinations: [b],
                            travelMode: 'DRIVING'
                        }, callback);
                function callback(response, status) {
                    if (status == 'OK') {
                        var origins = response.originAddresses;
                        var destinations = response.destinationAddresses;

                        for (var i = 0; i < origins.length; i++) {
                            var results = response.rows[i].elements;
                            for (var j = 0; j < results.length; j++) {
                                var element = results[j];
                                var distance = element.distance.text;
                                var duration = element.duration.text;
                                var from = origins[i];
                                var to = destinations[j];

                                //Hien khoang cach
                                var node = document.createElement("p");
                                var textnode = document.createTextNode("Khoảng cách đến cửa hàng: " + distance);
                                node.appendChild(textnode);
                                document.getElementById("khoangCach").appendChild(node);

                                var node1 = document.createElement("p");
                                var textnode1 = document.createTextNode("Tổng chi phí giao hàng: " + formatCurrency(parseFloat(distance.split(" ")[0]) * 5000 + "") + " VNĐ");
                                node1.appendChild(textnode1);
                                document.getElementById("tinhTien").appendChild(node1);

                                var tongTienBanDauStr = document.getElementById("tongTienThanhToan").value;
                                var tongTienBanDau = parseFloat(tongTienBanDauStr);
                                var tongPhi = parseFloat(distance.split(" ")[0]) * 5000;
                                var tongTienThanhToan = tongTienBanDau + tongPhi;

                                var node2 = document.createElement("strong");
                                var textnode2 = document.createTextNode("Tổng tiền thanh toán: " + formatCurrency(tongTienThanhToan + "") + " VNĐ");
                                node2.appendChild(textnode2);
                                document.getElementById("tinhTien").appendChild(node2);

                                document.getElementById("tongTienThanhToan").value = tongTienThanhToan;
                            }
                        }
                    }
                }
            }

            setTimeout(function () {
                calcRoute();
            }, 1500);


        </script>

        <div id="paypal-button-container" style="margin: auto; width: 50%"></div>
        <div id="inHoaDon"></div>
    </body>
    <!--Paypal API-->
    <script>
        var ngay = document.getElementById("ngay").value;
        var gio = document.getElementById("gio").value;
        var diaChi = document.getElementById("address").value;
        var soDienThoai = document.getElementById("soDT").value;
        var ghiChu = document.getElementById("ghiChu").value;
        if (ghiChu === null) {
            ghiChu = "";
        }

        var tongTienThanhToan;
        var tongTienThanhToanUSD;

        setTimeout(function () {
            tongTienThanhToan = document.getElementById("tongTienThanhToan").value;

            // set endpoint and your access key
            endpoint = 'live'
            access_key = '8a060d736e474adc7dc4e10372a3d978';
            var tiGia;

            //get the most recent exchange rates via the "live" endpoint:
            $.ajax({
                url: 'http://apilayer.net/api/' + endpoint + '?access_key=' + access_key + '&currencies=USD,VND',
                dataType: 'jsonp',
                success: function (json) {

                    // exchange rata data is stored in json.quotes
                    tiGia = json.quotes.USDVND;
                    tongTienThanhToanUSD = (parseInt(tongTienThanhToan) / parseInt(tiGia)).toFixed(2);
                }
            });

            paypal.Button.render({

                env: 'sandbox', // sandbox | production

                style: {
                    label: 'checkout', // checkout | credit | pay | buynow | generic
                    size: 'responsive', // small | medium | large | responsive
                    shape: 'pill', // pill | rect
                    color: 'gold'   // gold | blue | silver | black
                },
                // PayPal Client IDs - replace with your own
                // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                client: {
                    sandbox: 'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                    production: '<insert production client id>'
                },

                // Show the buyer a 'Pay Now' button in the checkout flow
                commit: true,

                // payment() is called when the button is clicked
                payment: function (data, actions) {

                    // Make a call to the REST api to create the payment
                    return actions.payment.create({
                        payment: {
                            transactions: [
                                {
                                    amount: {total: tongTienThanhToanUSD, currency: 'USD'}
                                }
                            ]
                        }
                    });
                },

                // onAuthorize() is called when the buyer approves the payment
                onAuthorize: function (data, actions) {

                    // Make a call to the REST api to execute the payment
                    return actions.payment.execute().then(function () {

                        $.ajax({
                            url: 'LuuDonHang',
                            data: {
                                tongTien: tongTienThanhToan,
                                maCuaHang: maCuaHang,
                                maTaiKhoan: maTaiKhoan,
                                list: list,
                                ngay: ngay,
                                gio: gio,
                                diaChi: diaChi,
                                soDienThoai: soDienThoai,
                                ghiChu: ghiChu
                            },
                            type: 'get',
                            cache: false,
                            success: function (data) {
                                localStorage.removeItem("gioHang" + maCuaHang + "_" + maTaiKhoan);
                                $.notify("Thanh toán thành công", "success");
                            },
                            error: function () {
                                $.notify("Loi", "error");
                            }
                        });

                        var html = '<input type="button" class="btn btn-primary" id="print_button"  value="Quay về" onclick="quayVe();" />';
                        $("#inHoaDon").prepend(html);
                        $("#paypal-button-container").hide();
                        $("#map").hide();
                        var html1 = '<h2 style="color: green">Thanh toán thành công!</h2>'
                        $("#thanhCong").prepend(html1);
                    });
                }

            }, '#paypal-button-container');

        }, 2500);

        function quayVe() {
            window.location.href = "index.jsp";
        }
    </script>


</html>
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/notify.min.js"></script>
