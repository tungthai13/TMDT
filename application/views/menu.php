<div id="menu">
    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-faded bg-menu">
        <a class="navbar-brand" href="<?php echo base_url();?>Welcome/index">
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
                &nbsp;
                <li class="nav-item" style="margin-top: 4px;">
                    <form action="<?php echo base_url();?>BanHang/index" method="post" onsubmit="return kiemTraDangNhap();">
                        <?php  if (isset($_SESSION['user'])) { ?>
                        <input type="hidden" id="maTK" name="maTaiKhoan" value="<?php echo($_SESSION['user'][0]['ma_khach_hang']); ?>" />
                        <?php } else { ?>
                        <input type="hidden" id="maTK" name="maTaiKhoan" value="false" />
                        <?php } ?>
                        <input id="cuaHangCuaToi" style="" type="submit" value="Cửa hàng của tôi" />
                    </form>
                </li>

            </ul>
            <div id="anhDaiDien"></div>
            <div id="status"></div>
            &nbsp;&nbsp;
            <div class="" id="login">
                <?php  if (isset($_SESSION['user'])) { ?>
                <p>

                    <form method="post" action="<?php echo base_url('khachhang/logout'); ?>">
                        <span>chào, </span><strong><?php echo($_SESSION['user'][0]['ten_khach_hang']); ?></strong>
                        <button class="w3-button w3-green">Đăng Xuất</button>
                    </form>
                </p>
                <?php }else{ ?>
                <p>
                    <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-margin-top">Đăng Nhập</button>

                    <button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-blue w3-margin-top">Đăng Kí</button>
                </p>
                <?php } ?>
            </div>


            <div id="id01" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                    <div class="w3-center"><br>
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                    </div>
                    <form class="w3-container" method="post" action="<?php echo base_url('khachhang/login'); ?>">
                        <div class="w3-section">
                            <label><b>Tên</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Tên" name="username" required>
                            <label><b>Mật khẩu</b></label>
                            <input class="w3-input w3-border" type="password" placeholder="Mật Khẩu" name="password" required>
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Đăng Nhập </button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="id02" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                    <div class="w3-center"><br>
                        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                    </div>
                    <form class="w3-container" method="post" action="<?php echo base_url('khachhang/dangki'); ?>">
                        <div class="w3-section">
                            <label><b>Tên</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Tên" name="username" required>
                            <label><b>Email</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Email" name="email" required>
                            <label><b>Số điện thoại</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="phone" placeholder="Số điện thoại" name="phone" required>
                            <label><b>Tạo mật khẩu</b></label>
                            <input class="w3-input w3-border" type="password" placeholder="Tạo mật khẩu" name="password" required>
                            <label><b>Nhập lại mật khẩu</b></label>
                            <input class="w3-input w3-border" type="password" placeholder="Nhập lại mật khẩu" name="password_again" required>
                            <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Đăng kí </button>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                function kiemTraDangNhap() {
                    if (document.getElementById("maTK").value === "false") {
                        $.notify("Bạn cần đăng nhập vào hệ thống trước", {className: 'error', position: "left top", autoHideDelay: 2000});
                        return false;
                    } else {
                        return true;
                    }

                }

            </script>
        </div>
    </nav>
</div>
