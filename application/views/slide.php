<div id="slide" onLoad="runShow()">
    <div class="container">
        <div class="row">
            <div class="col-md-5 item-slide">
                <div class="section-demo">
<!--
                    <button onclick="plusDivs(-1)">❮ Prev</button>
                    <button onclick="plusDivs(1)">Next ❯</button>
-->
                </div>
<!--
                <% 
                    List<CuaHang> cuaHangMoi = new CuaHangDAO().cuaHangBanChay();
                    int dem = 1;
                    for (CuaHang ch : cuaHangMoi) {
                %>
-->
                <div class="demo" onclick="currentDiv(<%=dem%>)" style="width: 400px; height: 110px">
                    <div class="item-img">
                        <img src="<?php echo base_url("image/logo-default.jpg") ?>" alt="" width="50" height="50">
                    </div>
                    <div class="para" style="padding-left: 62px">
                        <p><strong>Tên cửa hàng</strong></p>
                        <p>Địa chỉ</p>
                    </div>
                </div>
<!--                <% dem++; } %>-->
            </div>
            <div class="col-md-7 img-slide">
                <div onmouseover="stopShow()" onmouseout="runShow()">
<!--
<% 
                        for (CuaHang ch : cuaHangMoi) {
                    %>
-->
                    <a href="#">
                        <img class="mySlides" src="<?php echo base_url("image/logo-default.jpg") ?>" height="416" width="100%">
                    </a>
<!--                    <% ;} %>-->
                </div>

            </div>
        </div>
    </div>
</div>
