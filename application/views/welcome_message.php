<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include 'head.php';?>
    </head>

    <body>

        <div id="all">

            <!--menu-->
            <?php include 'menu.php';?>

            <!--slide-->
            <?php include 'slide.php';?>

            <!--content-->
            <?php include 'content.php';?>

            <br>
            <!--Footer-->
            <?php include 'footer.php';?>

        </div>
        
    </body>

    <script>
        var listMaTaiKhoan = document.getElementsByClassName("maTaiKhoan");
        for (var i = 0; i < listMaTaiKhoan.length; i++) {
            listMaTaiKhoan[i].value = parseInt(localStorage.getItem("maTaiKhoan"));
        }

    </script>

    </html>
    <!--Script slide-->
    <script type="text/javascript" src="<?php echo base_url("js/slideShow.js") ?>"></script>

    <!--Script tab-->
    <script type="text/javascript" src="<?php echo base_url("js/tab.js") ?>"></script>
