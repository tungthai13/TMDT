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
                <?php foreach($danhSachCuaHangSlide->result() as $row): ?>
                <div class="demo" onclick="currentDiv(<%=dem%>)" style="width: 400px; height: 120px">
                    <div class="item-img">
                        <img src="<?php echo base_url() ?>image/<?php echo $row->logo ?>" alt="" width="50" height="50">
                    </div>
                    <div class="para" style="padding-left: 62px">
                        <p><strong><?php echo $row->ten_cua_hang ?></strong></p>
                        <p><?php echo $row->dia_chi ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-7 img-slide">
                <div>
                    <?php foreach($danhSachCuaHangSlide->result() as $row): ?>
                    <a href="<?php echo base_url() ?>DatMon/index?maCuaHang=<?php echo $row->ma_cua_hang ?>">
                        <img class="mySlides" src="<?php echo base_url() ?>image/<?php echo $row->logo ?>" height="416" width="100%">
                    </a>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>
