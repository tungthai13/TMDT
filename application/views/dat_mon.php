
<!DOCTYPE html>
<html>
    <head>
        <?php include 'head.php' ?>
        <title>Đặt món</title>

        <style>

            #map {
                width: 100%;
                height: 450px;
                padding-bottom: 5px
            }

            .fb-comments {
                margin: auto;
                width: 50%;
            }
        </style>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11&appId=2002167313362798';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

<!--
        <%
            request.setCharacterEncoding("UTF-8"); //Để cho truyền parameter lên dưới dạng utf-8
            NumberFormat nf = NumberFormat.getNumberInstance(Locale.GERMAN);
            DecimalFormat format = (DecimalFormat) nf; //Format định dạng tiền

            String maTaiKhoan = String.valueOf(request.getSession().getAttribute("maTaiKhoan"));
            CuaHang ch = (CuaHang) request.getSession().getAttribute("cuaHang");
            int maCuaHang = ch.getMaCuaHang();
            String tenCuaHang = ch.getTenCuaHang();
            String diaChiCuaHang = ch.getDiaChi();
            float diem;
            if (ch.getSoLuotCham() != 0) {
                diem = ch.getTongDiem() / ch.getSoLuotCham();
            } else {
                diem = 0;
            }

            int diemCham = Integer.parseInt(String.valueOf(request.getSession().getAttribute("diemCham")));
        %>
-->
       <?php 
            $row = $cuaHang->row();
        ?>

        <input type="hidden" id="tenCuaHang" value="<?php echo $row->ten_cua_hang ?>"/>
        <input type="hidden" id="diaChiCuaHang" value="<?php echo $row->dia_chi ?>"/>
        <input type="hidden" id="diemCham" value=""/>
        <input type="hidden" id="maTaiKhoan" value="<?php if(isset($_SESSION['user'])){echo $_SESSION['user'][0]['ma_khach_hang'];}else{echo 'false';}  ?>"/>
        <input type="hidden" id="gioHang<?php echo $row->ma_cua_hang ?>_<?php if(isset($_SESSION['user'])){echo $_SESSION['user'][0]['ma_khach_hang'];} ?>" value='<?php echo $chiTietGioHang ?>' />
        
        <div id="all">
            <!--menu-->
            <?php include "menu.php" ?>

            <!--content-->
            <div id="dat-mon">
                <div class="detail-order">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 img">
                                <div class="">
                                    <img src="<?php echo base_url(); ?>image/<?php echo $row->logo ?>" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">

                                <h4 style="padding-top: 20px"><?php echo $row->ten_cua_hang ?></h4>
                                <p class="address"><?php echo $row->dia_chi ?></p>
                                <p>Điểm: <span id="diem"><?php echo ($row->tong_diem/$row->so_luot_cham) ?></span></p>

                                <div class="time">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <span style="color: green"><?php echo $row->gio_mo_cua ?> - <?php echo $row->gio_dong_cua ?></span>
                                </div>
                                <!--hien thong bao khoang cach tu javascript-->
                                <div id="khoangCach">
                                    <p>Phí vận chuyển: 5000 đ/km</p>
                                </div>

                                <!--hiện form chấm điểm-->
<!--
                                <div id="rateYo" style="padding-left: 0px;"></div>
                                <input type="hidden" name="diemCham" id="diemCham" value="" />
-->

                                <br>

                            </div>
                            <div class="col-md-4 price">
                                <form action="<?php echo site_url('dathang'); ?>" method="POST" onsubmit="return kiemTraGioHangRong();">
                                    <!--Mã cửa hàng-->
                                    <input type="hidden" name="maTaiKhoan" id="maTaiKhoan" value="<?php if(isset($_SESSION['user'])){echo $_SESSION['user'][0]['ma_khach_hang'];}else{echo 'false';}  ?>"/>
                                    <input type="hidden" name="maCuaHang" id="maCuaHang" value="<?php echo $row->ma_cua_hang ?>"/>
                                    <input type="hidden" id="tenCuaHang" name="tenCuaHang" value="<?php echo $row->ten_cua_hang ?>"/>
                                    <input type="hidden" id="diaChiCuaHang" name="diaChiCuaHang" value="<?php echo $row->dia_chi ?>"/>
                                    <table class="table">
                                        <thead>
                                            <tr>                      
                                                <th><button type="button" class="btn btn-danger" id="reset">Xóa tất cả</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr id="gioHang">

                                                <td>Tổng </td>
                                                <td id="money"> 0 VNĐ </td>
                                            </tr>
                                            <tr>
                                                <td>      
                                                    <input type="hidden" id="json" name="json" value=""/>
                                                    <input type="submit" class="pull-right btn btn-success" value="Đặt Mua"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                                <?php if (isset($_SESSION['user'])) {?>
                                    <form action="<?php echo base_url(); ?>giohang/luu" method="POST" onsubmit="return kiemTraGioHangRong();">
    <input type="hidden" name="ma_gio_hang" value="<?php echo$maGioHang['ma_gio_hang']; ?>">
    <input type="hidden" name="ma_cua_hang" value="<?php echo$row->ma_cua_hang; ?>" >
    <input type="hidden" name="ma_cua_hang" value="<?php echo$row->ma_cua_hang; ?>" >
    <input type="hidden" id="json1" name="json" value=""/>
    <input type="submit" name="" value="Lưu Giỏ Hàng" class="pull-right btn btn-success">
    <input type="hidden" id="gioHang<?php echo $row->ma_cua_hang ?>_<?php if(isset($_SESSION['user'])){echo $_SESSION['user'][0]['ma_khach_hang'];} ?>" value='<?php echo $chiTietGioHang ?>' name="san_pham_gio" />

                                    </form>
                                <?php } ?>
                                   
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" value="<?php echo $row->lng ?>" id="lngCuaHang">
                            <input type="hidden" value="<?php echo $row->lat ?>" id="latCuaHang">

                            <!--Google map-->   
                            <div id="map"></div>
                            <!--End google map-->
                        </div>
                    </div>
                </div>

                <div class="lien-quan">
                    <div class="container">
                        <div class="row">
                            <h3>Thực đơn</h3>
                        </div>
                        <div class="row">
                        <?php
                            foreach( $sanPham->result() as $rowSanPham ) :
                                        
                        ?>
                            <div class="col-md-6 box">
                                <div class="left pull-left">
                                    <div class="img">
                                        <img src="<?php echo base_url(); ?>image/<?php echo $rowSanPham->anh_minh_hoa ?>" alt="">
                                    </div>
                                    <div class="item">
                                        <strong><?php echo $rowSanPham->ten_san_pham ?></strong><br>
                                        <span>Đã được đặt <?php echo $rowSanPham->so_lan_dat ?> lần</span>
                                    </div>
                                </div>
                                <div class="right pull-right">

                                    <!--<form action="themmon" method="post">-->
                                    <strong><?php echo $rowSanPham->don_gia ?> VNĐ</strong>
                                    <input type="hidden" id="tenMon<?php echo $rowSanPham->ma_san_pham ?>" value="<?php echo $rowSanPham->ten_san_pham ?>" />
                                    <input type="hidden" id="donGia<?php echo $rowSanPham->ma_san_pham ?>" value="<?php echo $rowSanPham->don_gia ?>" />
                                    <i class="fa fa-plus themMon" aria-hidden="true" id="them<?php echo $rowSanPham->ma_san_pham ?>"></i>
                                    <i class="fa fa-minus botMon" aria-hidden="true" id="bot<?php echo $rowSanPham->ma_san_pham ?>"></i>
                                    <!--</form>-->

                                </div>
                            </div>   
                            
                            <?php
                                endforeach;
                            ?>
                            <!--End mon an-->
                        </div>
                            <br>
                        <!--Comment facebook row-->   
                        <div class="row">
                            <div class="fb-comments" data-numposts="5"></div>
                            <script>
                                var maCuaHang = document.getElementById("maCuaHang").value;
                                $(".fb-comments").attr("data-href", window.location.href + "?maCuaHang=" + <?php echo $row->ma_cua_hang ?>);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
                            
            <!--Footer-->
            <?php include "footer.php" ?>
        </div>
    </body>
</html>

<!--script chấm điểm (Sử dụng ajax)-->
<script src="<?php echo base_url("js/chamdiem.js"); ?>"></script>

<!--script xử lý giỏ hàng-->
<script src="<?php echo base_url("js/xulygiohang.js?v=3"); ?>"></script>

<!--Script xử lý google map-->
<script src="<?php echo base_url("js/xulygooglemap.js"); ?>"></script>

<!--Google map-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA84UAqytUxGlER7GBT2E723Wjo3Pwlafg&callback=initMap" async defer></script>
