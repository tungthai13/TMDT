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

        </style>
    </head>

    <body>

        <div id="all">

            <!--menu-->
            <?php include 'menu.php';?>

            <div class="container" id="container1">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="<?php echo base_url() ?>BanHang/danhSachCuaHang?maTaiKhoan=1" id="dsch">Cửa hàng</a>
                    <a href="#">Thực đơn</a>
                    <a href="#">Clients</a>
                    <a href="#">Contact</a>
                </div>
                <div id="main">
                    <br>
                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
                    <input type="hidden" id="maTaiKhoan" value="1" />
                    <div id="content">
                        <table class="table table-striped">
                            <h2>Danh sách cửa hàng</h2>

                            <thead>
                                <tr>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lần đặt</th>
                                    <th>Xem chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    foreach( $danhSachSanPham->result() as $row ) :
                                    
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $row->ma_san_pham ?>
                                        </td>
                                        <td>
                                            <?php echo $row->ten_san_pham ?>
                                        </td>
                                        <td>
                                            <?php echo $row->don_gia ?>
                                        </td>
                                        <td>
                                            <?php echo $row->so_lan_dat ?>
                                        </td>
                                        <td><a href="<?php echo base_url() ?>BanHang/danhSachCuaHang?maSanPham=1&maCuaHang="<?php echo $row->ma_cua_hang ?>>Xem</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>

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
