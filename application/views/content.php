<div id="content">
    <div class="container" id="container1">

        <!--Tab-->
        <div class="row select">
            <div class="col-md-4">
                <div class="tab">
                    <ul id="tabItem">
                        <li class="London active-slide" id='London1' onclick="openCity('London')">
                            <span class="btn London">Cửa hàng</span>
                        </li>
                        <li class="Tokyo" id='Tokyo1' onclick="openCity('Tokyo')">
                            <span class="btn Tokyo"> Lọc kết quả hiển thị</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--End tab-->

        <!--Tab 1 content-->
        <div class="row product w3-container w3-display-container city tabLondon" id="London">
            <?php 
                //Kiểm tra xem có chọn quận huyện nào không
                if (is_array($quanHuyen)){
            ?>
            <div class="col-md-12">
                <h2>Lọc kết quả hiển thị theo quận huyện:
                    <?php echo $stringTenQuanHuyen ?> </h2>
            </div>
            <?php } ?>
            <?php
                foreach( $danhSachCuaHang->result() as $row ) :
                    
            ?>


                <!--Store Item-->
                <div class="col-md-4 default">
                    <div class="item-product">
                        <div class="image">
                            <a href="<?php echo base_url();?>DatMon/index?maCuaHang=<?php echo $row->ma_cua_hang ?>"><img src="<?php echo base_url() ?>image/<?php echo $row->logo ?>" alt=""></a>

                        </div>
                        <div class="title">
                            <a href="#">
                                <div class="star">
                                    <span><?php 
                                        echo ($row->tong_diem/$row->so_luot_cham)
                                        ?>
                                </span>
                                </div>
                                <div class="address">
                                    <strong><?php echo $row->ten_cua_hang ?></strong><br>
                                    <span>
                                    <?php echo $row->dia_chi ?>
                                </span>
                                </div>

                            </a>
                        </div>
                        <div class="cach"></div>
                        <div class="order">
                            <!--                       onsubmit="return kiemTraDangNhap();"-->
                            <form action="<?php echo base_url();?>DatMon/index?maCuaHang=<?php echo $row->ma_cua_hang ?>" method="post">

                                <input type="hidden" name="maTaiKhoan" class="maTaiKhoan" value="1" />

                                <input type="submit" class="storeButton btn btn-submit" value="Đặt món" />
                            </form>
                        </div>
                        <!--End button-->

                    </div>
                </div>
                <?php
                endforeach;
            ?>
                    <!--End Store Item-->
                    <div class="col-md-12" align="center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <?php if($trangHienTai == 1){ ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=1" tabindex="-1">Previous</a>
                                    <?php } else { ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $trangHienTai-1; ?>" tabindex="-1">Previous</a>
                                    <?php } ?>
                                </li>
                                <?php for($i = 1; $i <= $tongSoTrang; $i++): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $i?>">
                                        <?php echo $i?>
                                    </a>
                                </li>
                                <?php endfor; ?>
                                <li class="page-item">
                                    <?php if($trangHienTai == $tongSoTrang){ ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $tongSoTrang; ?>">Next</a>
                                    <?php } else { ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $trangHienTai+1; ?>">Next</a>
                                    <?php } ?>
                                </li>
                            </ul>
                        </nav>
                    </div>
        </div>

        <!--End tab 1 content-->

        <!--Tab 3 content-->
        <div class="row product w3-container w3-display-container city" id="Tokyo" style="display:none">
            <div class="col-xs-6">
                <form action="<?php echo base_url(); ?>Welcome/index" method="post">
                    <h3 class="text-center">Lọc cửa hàng theo quận huyện</h3>
                    <div class="well" style="max-height: 550px;overflow: auto;">
                        <ul class="list-group checked-list-box">


                            <?php 
                                if (!is_array($quanHuyen)){
                                    $quanHuyen = [];
                                }
                            
                                foreach($danhSachQuanHuyen->result() as $row): 
                            ?>

                            <?php if (in_array($row->ma_quan_huyen, $quanHuyen)){ ?>
                            <li class="list-group-item">
                                <input checked type="checkbox" name="quanHuyen[]" value="<?php echo $row->ma_quan_huyen ?>">
                                <?php echo $row->ten_quan_huyen ?>
                            </li>
                            <?php } else { ?>
                            <li class="list-group-item">
                                <input type="checkbox" name="quanHuyen[]" value="<?php echo $row->ma_quan_huyen ?>">
                                <?php echo $row->ten_quan_huyen ?>
                            </li>
                            <?php } ?>

                            <?php endforeach; ?>
                            

                        </ul>
                    </div>
                    <br>
                    <input type="submit" value="Lọc kết quả" class="btn btn-success" />
                    &nbsp;&nbsp;
                    <input type="reset" value="Bỏ chọn" id="reset" class="btn btn-danger" onclick="myFunction()" />
                    <script>
                        function myFunction(){
                            var checkBoxes = document.getElementsByName("quanHuyen[]");
                            for(var i=0; i<checkBoxes.length; i++){
                                checkBoxes[i].removeAttribute("checked");
                            }
                        }
                    </script>
                </form>
            </div>

        </div>
        <!--End tab 3 content-->

    </div>
</div>
