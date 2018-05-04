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
                <?php include 'menu_ban_hang.php' ?>
                <div id="main">

                    <input type="hidden" id="maTaiKhoan" value="1" />
                    <div id="content">
                        <table class="table table-striped">
                           <div class="row">
                               <div class="col-md-4"><h2>Danh sách sản phẩm</h2></div>
                               <div class="col-md-8">
                                   <a style="float: right" href="<?php echo base_url() ?>BanHang/trangThemSanPham?maCuaHang=<?php echo $maCuaHang?>" class="btn btn-primary">Thêm sản phẩm</a>
                               </div>
                           </div>
                            
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lần đặt</th>
                                    <th>Xem chi tiết</th>
                                    <th>Xóa sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $count = 1;
                                    foreach( $danhSachSanPham->result() as $row ) :
                                    
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $count++ ?>
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
                                        <td>
                                            <a class="btn btn-info" href="<?php echo base_url() ?>BanHang/chiTietSanPham?maSanPham=<?php echo $row->ma_san_pham?>&maCuaHang=<?php echo $maCuaHang?>">Xem</a>
                                        </td>
                                        <td>
                                            <form id="xoaSanPham" action="<?php echo base_url() ?>BanHang/xoaSanPham" method="post" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">
                                               <input type="hidden" name="maCuaHang" value="<?php echo $maCuaHang?>" />
                                               <input type="hidden" name="maSanPham" value="<?php echo $row->ma_san_pham?>" />
                                               <input class="btn btn-danger" type="submit" value="Xóa"/>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php 
                                        endforeach; 
                                    ?>
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
