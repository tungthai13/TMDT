<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="<?php echo base_url() ?>BanHang/danhSachCuaHang?maTaiKhoan=<?php echo($_SESSION['user'][0]['ma_khach_hang']); ?>" id="dsch">Cửa hàng</a>
    <a href="<?php echo base_url() ?>BanHang/index?maTaiKhoan=<?php echo($_SESSION['user'][0]['ma_khach_hang']); ?>">Thống kê</a>
</div>
<br>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
