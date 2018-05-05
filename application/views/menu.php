<div id="menu">
    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-faded bg-menu">
        <a class="navbar-brand" href="<?php echo site_url("Welcome/index");?>">
            <img src="<?php echo base_url("image/foodapp1.png"); ?>" alt="" style="height: 40px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" style="margin-top: 4px;">
                    <a id='nav1' class="nav-link" href="#">Giỏ hàng </a>
                </li>
                <li class="nav-item" style="margin-top: 4px;">
                    <a id='nav2' class="nav-link" href="#">Lịch sử mua hàng </a>
                </li>
                <li class="nav-item" style="margin-top: 4px;">
                    <a id='nav3' class="nav-link" href="<?php echo base_url();?>BanHang/index?maTaiKhoan=1">Cửa hàng của tôi </a>
                </li>
                <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                <li>
                    <form class="form-inline" style="height: 49px;" action="index.jsp">
                        <label class="sr-only" for="inlineFormInput">Name</label>
                        <input type="text" name="timKiem" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Tìm kiếm cửa hàng" style="width: 400px;">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </form>
                </li>
            </ul>
            <div id="anhDaiDien"></div>
            <div id="status"></div>
            &nbsp;&nbsp;
            <div class="btn login btn-succes" id="login">
                <a onclick="login();" id="dangnhap">Đăng nhập</a>
                <a onclick="fbLogoutUser();" id="dangxuat" hidden="true">Đăng xuất</a>
            </div>

            <script>
                if (checkCookie("username") !== "") {
                    document.getElementById("dangnhap").hidden = true;
                    document.getElementById("login").hidden = true;
                    //                    document.getElementById("dangxuat").hidden = false;
                    //                    document.getElementById('status').innerHTML =
                    //                            '<img style="border-radius: 50%;" src="' + localStorage.getItem("anhDaiDien") + '" width="38" height="38">' + '\u00A0\u00A0' + getCookie("username")
                    //                            + '\u00A0';
                    document.getElementById('anhDaiDien').innerHTML = '<img style="border-radius: 50%;" src="' + localStorage.getItem("anhDaiDien") + '" width="38" height="38"> \u00A0\u00A0';
                    document.getElementById('status').innerHTML =
                        '   <div class="dropdown">  ' +
                        '       <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"> ' +
                        '\u00A0\u00A0' + getCookie("username") + '\u00A0' +
                        '       <span class="caret"></span></button>  ' +
                        '       <ul class="dropdown-menu">  ' +
                        '         <li><a href="#" onclick="fbLogoutUser();">Đăng xuất</a></li>  ' +
                        '         <li><a href="DanhSachDonHang?maTaiKhoan=' + localStorage.getItem("maTaiKhoan") + '">Đơn hàng</a></li>  ' +
                        '       </ul>  ' +
                        '    </div>  ';
                }

                document.getElementById("dangnhap").style.cursor = "pointer";

            </script>

        </div>
    </nav>
</div>
