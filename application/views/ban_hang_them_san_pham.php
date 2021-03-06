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
            
            img{
                width: 200px;
                height: 200px;
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

                        <h2>Thêm mới sản phẩm</h2>
                        <form action="<?php echo base_url() ?>BanHang/themSanPham" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="maCuaHang" value="<?php echo $maCuaHang ?>">
                            <input type="hidden" name="soLanDat" value="0">
                            <div class="form-group">
                                <label for="tenSanPham">Tên sản phẩm:</label>
                                <input required type="text" class="form-control" id="tenSanPham" placeholder="Nhập tên sản phẩm" name="tenSanPham" value="">
                            </div>
                            <div class="form-group">
                                <label for="donGia">Đơn giá:</label>
                                <input required type="text" class="form-control" id="donGia" placeholder="Nhập đơn giá" name="donGia" value="">
                            </div>
                            <div class="form-group">
                                <label for="tenNhomSanPham">Tên nhóm sản phẩm:</label>
                                <input required type="text" class="form-control" id="tenNhomSanPham" placeholder="Nhập tên nhóm sản phẩm" name="tenNhomSanPham" value="">
                            </div>
                            <div class="form-group">
                                <label for="trangThaiSanPham">Trạng thái sản phẩm:</label>
                                <div class="radio">
                                    <label><input type="radio" name="trangThaiSanPham" value="1" checked> Còn hàng</label>
                                    &nbsp; &nbsp;
                                    <label><input type="radio" name="trangThaiSanPham" value="0" > Hết hàng</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="picture">Ảnh minh họa:</label>
                                <input type="file" class="form-control" name="picture">
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

    </script>
s