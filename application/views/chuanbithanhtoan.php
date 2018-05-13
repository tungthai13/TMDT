
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <script src="js/checkout.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
        <script src="js/jquery-ui.js"></script>

        <link rel="stylesheet" href="css/jquery-ui.css">

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="js/notify.min.js" type="text/javascript"></script>
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
        </style>
        <style type=”text/css” media=”print”>
            #print_button{
                display:none;
            }
        </style>
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body> 
        <div class="row">
            <div class="container">
                <h2>Thời gian và địa chỉ giao hàng</h2>
                <form action="<?php echo base_url(); ?>Dathang/thanhtoan" method="POST">
                    <input type="hidden" name="maTaiKhoan" id="maCuaHang" value="<?=$datMon['maTaiKhoan'] ?>"/>
                    <input type="hidden" name="maCuaHang" id="maCuaHang" value="<?=$datMon['maCuaHang'] ?>"/>
                    <input type="hidden" name="json"  value=""/>
                    <input type="hidden" name="tenCuaHang" value="<?=$datMon['tenCuaHang'] ?>"/>
                    <input type="hidden" name="diaChiCuaHang" value="<?=$datMon['diaChiCuaHang'] ?>"/>

                    <div class="form-group">
                        <label for="soDT">Số điện thoại</label>
                        <input type="text" maxlength="11" class="form-control" id="soDT" placeholder="Nhập số điện thoại di động" name="soDT" pattern="(09|01[2|6|8|9])+([0-9]{8})\b" required>
                    </div>
                    <div class="form-group">
                        <label for="diaChi">Địa chỉ giao hàng</label>
                        <input id="autocomplete" onFocus="geolocate()" type="text" class="form-control" id="diaChi" placeholder="Nhập địa chỉ giao hàng" name="diaChi" required>
                    </div>
                    <div class="form-group">
                        <label for="ngayGio">Ngày giờ giao hàng</label>
                        <br>
                        <input type="text" name="ngay" id="ngay" required>
                        <input type="text" name="gio" id="gio" style="cursor: pointer;">

                        <script>
                            var currentdate = new Date();
                            $('#gio').timepicker({
                                timeFormat: 'HH:mm',
                                interval: 30,
                                minTime: '10:00am',
                                maxTime: '8:00pm',
                                defaultTime: '10',
                                startTime: '10:00',
                                dynamic: true,
                                dropdown: true,
                                scrollbar: true
                            });

                            $(function () {
                                $("#ngay").datepicker({minDate: 0, maxDate: "+7D"});
                                $("#ngay").datepicker("option", "dateFormat", "yy-mm-dd");
                            });

                        </script>
                    </div>
                    <div class="form-group">
                        <label for="ghiChu">Ghi chú đơn hàng</label>         
                        <input type="text" class="form-control" id="ghiChu" placeholder="Ghi chú về đơn hàng này" name="ghiChu">
                    </div>
                    <div class="className text-center">
                        <button type="submit" class="btn btn-primary">Tiếp tục</button>
                    </div>

                </form>
            </div>
        </div>

        <!--Footer-->


    </body>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA84UAqytUxGlER7GBT2E723Wjo3Pwlafg&libraries=places&callback=initAutocomplete"
    async defer></script>
    <script>
        var maCuaHang = document.getElementById("maCuaHang").value.slice(0, -1);
        var maTaiKhoan = localStorage.getItem("maTaiKhoan");
        document.getElementById("json").value = localStorage.getItem("gioHang" + maCuaHang + "_" + maTaiKhoan);

        var placeSearch, autocomplete;
        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                    {types: ['geocode']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }
    </script> 

</html>
