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
                        <?php if(isset($tongSoCuaHang)): ?><h3>Tổng số cửa hàng: <?php echo $tongSoCuaHang; ?></h3>
                        <?php endif; ?>
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
