<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Sản phẩm mới</h2>
        <?php 
        if (!empty($features)){
           foreach ($features as $f) {                  
        ?>
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="<?php echo base_url(); ?>public/images/products/<?php echo $f->img_thumb ; ?>" alt="" />
                        <h2><?php echo  number_format($f->price); ?> VND</h2>
                        <p><?php echo $f->name ; ?></p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2><?php echo  number_format($f->price); ?> VND</h2>
                            <p><?php echo $f->name ; ?></p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm ưu thích</a></li>
                        <li><a href="#"><i class="fa fa-info" aria-hidden="true"></i>Chi tiết</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php                      
            }                        
        }                
        ?>

    </div><!--features_items-->

    <div class="category-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <?php 
                if (!empty($list_small_menus)){
                   foreach ($list_small_menus as $f) {                  
                ?>
                <li class="<?php echo (str_replace('-','', $f['alias']) == $active_small_menu) ? 'active' : '' ; ?>">
                    <a href="#<?php echo str_replace('-','', $f['alias']) ; ?>" data-toggle="tab"><?php echo $f['name'] ; ?></a>
                </li>
                <?php                      
                    }                        
                }                
                ?>
            </ul>
        </div>
        <div class="tab-content">
            <?php 
            if (!empty($list_small_menus)){
                foreach ($list_small_menus as $f) {                  
            ?>
            <div class="tab-pane fade <?php echo (str_replace('-','', $f['alias']) == $active_small_menu) ? 'active in' : '' ; ?>" id="<?php echo str_replace('-','', $f['alias']) ; ?>" >
                <?php 
                if( !empty($f['details'])) {
                    foreach ($f['details'] as $d) {                  
                ?>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?php echo base_url(); ?>public/images/products/<?php echo $d->img ; ?>" alt="" />
                                <h2><?php echo  number_format($d->price); ?> VND</h2>
                                <p><?php echo $d->name ; ?></p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
                <?php                      
                    }
                }                
                ?>
            </div>
            <?php                      
               }
            }                
            ?>
        </div>
    </div><!--/category-tab-->

    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">recommended items</h2>

        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php 
                if (!empty($recommend_items)){
                    for ($i = 0; $i <= 2; $i++) {                  
                ?>
                <div class="item <?php echo ( $i == 0) ? 'active' : '' ; ?>">
                    <?php 
                    if (!empty($recommend_items[$i])){
                        foreach ($recommend_items[$i] as $r)  {                  
                    ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="<?php echo base_url(); ?>public/images/products/<?php echo $r['img_1'] ; ?>" alt="" />
                                    <h2><?php echo  number_format($r['price']); ?> VND</h2>
                                    <p><?php echo $r['name'] ; ?></p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php                      
                        }
                    }  
                    ?>
                    
                </div>
                <?php                      
                    }
                }  
                ?>
            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>			
        </div>
    </div><!--/recommended_items-->

</div>
</div>
</div>
</section>