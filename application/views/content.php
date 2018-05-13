<div id="content">
    <div class="container" id="container1">

        <!--Tab-->
        <div class="row select">
            <div class="col-md-6">
                <div class="tab">
                    <ul id="tabItem">
                       <?php if(!isset($timKiem)) { ?>
                        <li class="London active-slide" id='London1' onclick="openCity('London')">
                            <span class="btn London">Cửa hàng</span>
                        </li>
                        <li class="Tokyo" id='Tokyo1' onclick="openCity('Tokyo')">
                            <span class="btn Tokyo"> Lọc cửa hàng</span>
                        </li>
                        <li class="Hanoi" id='Hanoi1' onclick="openCity('Hanoi')">
                            <span class="btn Hanoi"> Kết quả tìm kiếm</span>
                        </li>
                        <?php } else { ?>
                        <li class="London" id='London1' onclick="openCity('London')">
                            <span class="btn London">Cửa hàng</span>
                        </li>
                        <li class="Tokyo" id='Tokyo1' onclick="openCity('Tokyo')">
                            <span class="btn Tokyo"> Lọc cửa hàng</span>
                        </li>
                        <li class="Hanoi active-slide" id='Hanoi1' onclick="openCity('Hanoi')">
                            <span class="btn Hanoi"> Kết quả tìm kiếm</span>
                        </li>                       
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--End tab-->

        <!--Tab 1 content-->
        <div class="row product w3-container w3-display-container city tabLondon" id="London" <?php if(isset($timKiem)): ?>style="display:none"<?php endif; ?>>
            <!--Hiện danh sách gợi ý nếu đã đăng nhập-->
            <?php if(isset($_SESSION['user'])){ if(isset($danhSachCuaHangGoiY)) { ?>
            <div class="col-md-12" style="margin-left: 5px; margin-right: 5px;">
                <h2> Gợi ý cửa hàng </h2>
            </div>
            <div class="row" style="margin-left: 5px; margin-right: 5px;">
                <?php foreach( $danhSachCuaHangGoiY->result() as $row ) : ?>
                <div class="col-md-3" >  
                    <div class="item-product" style="height: 372px;">
                        <div class="image">
                            <a href="<?php echo base_url();?>DatMon/index?maCuaHang=<?php echo $row->ma_cua_hang ?>"><img src="<?php echo base_url() ?>image/<?php echo $row->logo ?>" alt=""></a>

                        </div>
                        <div class="title">    
                            <strong><?php echo $row->ten_cua_hang ?></strong><br>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>  
            </div>
            
            <?php } } ?>
            
            
            <!--Kiểm tra xem có chọn quận huyện nào không-->
            <?php if (isset($stringMaQuanHuyen) || is_array($quanHuyen)){ ?>
            
            <div class="col-md-12">
                <h2> Lọc kết quả hiển thị theo quận huyện: <?php echo $stringTenQuanHuyen ?> </h2>
            </div>
            
            <?php } else { ?>
            <div class="col-md-12">
                <h2> Danh sách tất cả cửa hàng </h2>
            </div>
            <?php } ?>
            <?php foreach( $danhSachCuaHang->result() as $row ) : ?>
               
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
                    
                <!--Phân trang-->
                <div class="col-md-12" align="center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                               
                                <!-- Nút Previous -->
                                <li class="page-item">
                                    <?php 
                                        //Kiểm tra xem có chọn quận huyện nào không
                                        if (isset($stringMaQuanHuyen) || is_array($quanHuyen)){
                                    ?>
                                    
                                        <?php if($trangHienTai == 1){ ?>
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=1&stringMaQuanHuyen=<?php echo $stringMaQuanHuyen ?>&stringTenQuanHuyen=<?php echo $stringTenQuanHuyen ?>" tabindex="-1">Previous</a>
                                        <?php } else { ?>
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $trangHienTai-1; ?>&stringMaQuanHuyen=<?php echo $stringMaQuanHuyen ?>&stringTenQuanHuyen=<?php echo $stringTenQuanHuyen ?>" tabindex="-1">Previous</a>
                                        <?php } ?>
                                    
                                    <?php } else { ?>
                                    
                                        <?php if($trangHienTai == 1){ ?>
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=1" tabindex="-1">Previous</a>
                                        <?php } else { ?>
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $trangHienTai-1; ?>" tabindex="-1">Previous</a>
                                        <?php } ?>
                                    
                                    <?php } ?>
                                </li>
                                
                                
                                <!-- Nút số -->
                                <?php for($i = 1; $i <= $tongSoTrang; $i++): ?>
                                <li class="page-item">
                                   <?php 
                                        //Kiểm tra xem có chọn quận huyện nào không
                                        if (isset($stringMaQuanHuyen) || is_array($quanHuyen)){
                                    ?>
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $i?>&stringMaQuanHuyen=<?php echo $stringMaQuanHuyen ?>&stringTenQuanHuyen=<?php echo $stringTenQuanHuyen ?>">
                                        <?php echo $i?>
                                        </a>
                                        
                                    <?php } else { ?>
                                        
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $i?>">
                                        <?php echo $i?>
                                        </a>
                                        
                                    <?php } ?>
                                    
                                </li>
                                <?php endfor; ?>
                                
                                
                                
                                <!-- Nút Next -->
                                <li class="page-item">
                                <?php 
                                    //Kiểm tra xem có chọn quận huyện nào không
                                    if (isset($stringMaQuanHuyen) || is_array($quanHuyen)){
                                ?>
                                    
                                    <?php if($trangHienTai == $tongSoTrang){ ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $tongSoTrang; ?>&stringMaQuanHuyen=<?php echo $stringMaQuanHuyen ?>&stringTenQuanHuyen=<?php echo $stringTenQuanHuyen ?>">Next</a>
                                    <?php } else { ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $trangHienTai+1; ?>&stringMaQuanHuyen=<?php echo $stringMaQuanHuyen ?>&stringTenQuanHuyen=<?php echo $stringTenQuanHuyen ?>">Next</a>
                                    <?php } ?>
                                    
                                <?php } else { ?>
                                   
                                    <?php if($trangHienTai == $tongSoTrang){ ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $tongSoTrang; ?>">Next</a>
                                    <?php } else { ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTai=<?php echo $trangHienTai+1; ?>">Next</a>
                                    <?php } ?>
                                    
                                <?php } ?>
                                    
                                </li>
                            </ul>
                        </nav>
                    </div>
        </div>
        <!--End tab 1 content-->
        
        <!--Tab 2 content-->
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
        <!--End tab 2 content-->

        <!--Tab 3 content-->
        <div class="row product w3-container w3-display-container city" id="Hanoi" <?php if(!isset($timKiem)): ?>style="display:none"<?php endif; ?> >
            <div class="col-md-12">
                <form class="form-inline" style="height: 49px;" action="<?php echo base_url() ?>Welcome/index" method="get">
                    <label class="sr-only" for="inlineFormInput">Name</label>
                    <input 
                        type="text" 
                        name="timKiem" 
                        class="form-control mb-2 mr-sm-2 mb-sm-0" 
                        id="inlineFormInput" 
                        placeholder="Tìm kiếm cửa hàng" 
                        style="width: 85%;">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
            <?php if(isset($timKiem)){ ?>
                <div class="col-md-12"><h2>Kết quả tìm kiếm: </h2></div>
                <!--Store Item-->
                <?php foreach( $danhSachCuaHangTimKiem->result() as $row ) : ?>
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
                <?php endforeach; ?>
                <!--End Store Item-->
                
                <!--Phân trang-->
                <div class="col-md-12" align="center">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                               
                                <!-- Nút Previous -->
                                <li class="page-item">
                                    
                                        <?php if($trangHienTai == 1){ ?>
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTaiTimKiem=1&timKiem=<?php echo $timKiem ?>" tabindex="-1">Previous</a>
                                        <?php } else { ?>
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTaiTimKiem=<?php echo $trangHienTai-1; ?>&timKiem=<?php echo $timKiem ?>" tabindex="-1">Previous</a>
                                        <?php } ?>
                                    
                                </li>
                                
                                
                                <!-- Nút số -->
                                <?php for($i = 1; $i <= $tongSoTrang; $i++): ?>
                                <li class="page-item">
                                    
                                        
                                        <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTaiTimKiem=<?php echo $i?>&timKiem=<?php echo $timKiem ?>">
                                        <?php echo $i?>
                                        </a>

                                </li>
                                <?php endfor; ?>
                                
                                
                                
                                <!-- Nút Next -->
                                <li class="page-item">
                                   
                                    <?php if($trangHienTai == $tongSoTrang){ ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTaiTimKiem=<?php echo $tongSoTrang; ?>&timKiem=<?php echo $timKiem ?>">Next</a>
                                    <?php } else { ?>
                                    <a class="page-link" href="<?php echo base_url() ?>Welcome/index?trangHienTaiTimKiem=<?php echo $trangHienTai+1; ?>&timKiem=<?php echo $timKiem ?>">Next</a>
                                    <?php } ?>
                            
                                    
                                </li>
                            </ul>
                        </nav>
                    </div>
            <?php } else { ?>

            <?php } ?>
        </div>
        <!--End tab 3 content-->
    </div>
</div>
