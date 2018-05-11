<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'head.php';?>
        <style>
            .sidenav {
                height: 100%;
                width: 0;
                position: fixed;
                z-index: 1;
                top: 4em;
                left: 0;
                background-color: #464a4e;
                overflow-x: hidden;
                transition: 0.5s;
                padding-top: 60px;
            }

            .sidenav a {
                padding: 8px 8px 8px 32px;
                text-decoration: none;
                font-size: 22px;
                color: #b1b1b1;
                display: block;
                transition: 0.3s;
            }

            .sidenav a:hover {
                color: #f1f1f1;
            }

            .sidenav .closebtn {
                position: absolute;
                top: 0;
                right: 25px;
                font-size: 36px;
                margin-left: 50px;
            }

            @media screen and (max-height: 450px) {
                .sidenav {
                    padding-top: 15px;
                }
                .sidenav a {
                    font-size: 18px;
                }
            }

            #picture {
                width: 200px;
                height: 200px;
            }

            #map {
                width: 100%;
                height: 400px;
                padding-bottom: 5px
            }

        </style>
    </head>

    <body>

        <div id="all">

            <!--menu-->
            <?php include 'menu.php';?>

            <div class="container" id="container1">
                <?php include 'menu_ban_hang.php' ?>
                <div id="main">
                    <div id="content">

                        <h2>Chi tiết cửa hàng</h2>
                        <form action="<?php echo base_url() ?>BanHang/suaThongTinCuaHang" method="post" enctype="multipart/form-data">
                            <?php $row = $cuaHang->row(); ?>
                            <input type="hidden" name="maTaiKhoan" value="<?php echo $row->ma_nguoi_quan_ly ?>">
                            <input type="hidden" name="maCuaHang" value="<?php echo $row->ma_cua_hang ?>">
                            <div class="form-group">
                                <label for="tenCuaHang">Tên cửa hàng:</label>
                                <input required type="text" class="form-control" id="tenCuaHang" placeholder="Nhập tên cửa hàng" name="tenCuaHang" value="<?php echo $row->ten_cua_hang ?>">
                            </div>
                            
                            <div class="form-group">
                                <input required id="address" class="form-control" name="diaChi" placeholder="Nhập địa chỉ cửa hàng" type="textbox" value="<?php echo $row->dia_chi ?>">
<!--                                <input id="submit" type="button" value="Geocode">-->
                            </div>

                            <div id="map"></div>
                            <script>
                                var markers = [];
                                function initMap() {
                                    var myLatLng = {lat: <?php echo $row->lat ?>, lng: <?php echo $row->lng ?>};
                                    var map = new google.maps.Map(document.getElementById('map'), {
                                        zoom: 15,
                                        center: {
                                            lat: myLatLng.lat,
                                            lng: myLatLng.lng
                                        }
                                    });
                                    
                                      markers[0] = new google.maps.Marker({
                                      position: myLatLng,
                                      map: map,
                                    });
                                    
                                    var geocoder = new google.maps.Geocoder();

                                    document.getElementById('submit').addEventListener('click', function() {
                                        setMapOnAll(null);
                                        geocodeAddress(geocoder, map);
                                    });
                                }
                                
                                function setMapOnAll(map) {
                                    for (var i = 0; i < markers.length; i++) {
                                      markers[i].setMap(map);
                                    }
                                }


                                function geocodeAddress(geocoder, resultsMap) {
                                    var address = document.getElementById('address').value;
                                    geocoder.geocode({
                                        'address': address
                                    }, function(results, status) {
                                        if (status === 'OK') {
                                            resultsMap.setCenter(results[0].geometry.location);
                                            var marker = new google.maps.Marker({
                                                map: resultsMap,
                                                position: results[0].geometry.location
                                            });
                                            document.getElementById("kiemTraGeocode").value = "true";
                                            document.getElementById("lat").value = marker.position.lat();
                                            document.getElementById("lng").value = marker.position.lng();
                                        } else {
                                            alert('Geocode was not successful for the following reason: ' + status);
                                        }
                                    });
                                }

                            </script>

                            <div class="form-group">
                                <label for="soDienThoai">Số điện thoại:</label>
                                <input required type="text" class="form-control" id="soDienThoai" placeholder="Nhập số điện thoại cửa hàng" name="soDienThoai" value="<?php echo $row->so_dien_thoai ?>">
                            </div>
                            <div class="form-group">
                                <label for="tinhThanh">Tỉnh thành:</label>
                                <select class="form-control" id="tinhThanh" name="tinhThanh">
                                    <option>Hà Nội</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quanHuyen">Quận huyện:</label>
                                <select class="form-control" id="quanHuyen" name="quanHuyen">
                                    <?php 
                                        foreach ($danhSachQuanHuyen->result() as $row1) : 
                                    ?>
                                        <option <?php if($row1->ma_quan_huyen == $row->ma_quan_huyen): echo "selected"; endif; ?> ><?php echo $row1->ten_quan_huyen; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gioMoCua">Giờ mở cửa:</label>
                                <select class="form-control" id="gioMoCua" name="gioMoCua">
                                    <?php 
                                        for ($i = 0; $i <= 23; $i++) {
                                            if($row->gio_mo_cua == $i){
                                                echo "<option selected>".$i.":00</option>";
                                            } else {
                                                echo "<option>".$i.":00</option>";
                                            }
                                            
                                        }  
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gioMoCua">Giờ đóng cửa:</label>
                                <select class="form-control" id="gioDongCua" name="gioDongCua">
                                    <?php 
                                        for ($i = 0; $i <= 23; $i++) {
                                            if($row->gio_dong_cua == $i){
                                                echo "<option selected>".$i.":00</option>";
                                            } else {
                                                echo "<option>".$i.":00</option>";
                                            }
                                        }  
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" name="lat" id="lat" value="<?php echo $row->lat ?>" />
                            <input type="hidden" name="lng" id="lng" value="<?php echo $row->lng ?>" />
                            <input type="hidden" name="logo" id="logo" value="<?php echo $row->logo ?>" />
                            <input type="hidden" id="kiemTraGeocode" value="false" />
                            <div class="form-group">
                                <label for="picture">Ảnh logo:</label>
                                <br>
                                <img id="picture" src="<?php echo base_url() ?>image/<?php echo $row->logo ?>" />
                                <br>
                                <br>
                                <input type="file" class="form-control" name="picture">
                            </div>

<!--                            <button type="submit" class="btn btn-primary">Thêm cửa hàng</button>-->
                                
                                <div id="nutSubmit">
                                    <input id="submit" type="button" class="btn btn-info" value="Định vị tọa độ cửa hàng" onclick="themNutSubmit()">
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                        </form>
                    </div>
                </div>
            </div>


            <br>

            <!--Footer-->
            <?php include 'footer.php';?>
        </div>

    </body>

    </html>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA84UAqytUxGlER7GBT2E723Wjo3Pwlafg&callback=initMap">


    </script>
    <!--
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA84UAqytUxGlER7GBT2E723Wjo3Pwlafg&libraries=places&callback=initAutocomplete"
    async defer></script>
-->
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
        
        function themNutSubmit(){
            var html = '<button type="submit" class="btn btn-success">Sửa thông tin cửa hàng</button>';
            $("#nutSubmit").prepend(html);
        }

//        function kiemTra(input) {
//            var x = document.getElementById("kiemTraGeocode").value;
//            if (x === "false") {
//                alert("Chưa lấy được tọa độ");
//                return false;
//            }
//            return true;
//        }
    </script>
