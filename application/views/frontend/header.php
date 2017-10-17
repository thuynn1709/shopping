<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="SIRODRUGSTORE - Chuyên hàng xách tay ĐỨC">
        <meta name="author" content="">
        <title>Home | SIRODRUGSTORE - Chuyên hàng xách tay ĐỨC</title>
        <link href="<?php echo base_url(); ?>public/frontend/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/prettyPhoto.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/price-range.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/animate.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/main.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>public/frontend/css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>public/frontend/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>public/frontend/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>public/frontend/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>public/frontend/images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-phone"></i> +841255282228</a></li> 
                                    <li><a href="#"><i class="fa fa-envelope"></i> sirodrugstore@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="https://www.facebook.com/SIROdrugstore/?ref=aymt_homepage_panel"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.instagram.com/sirodrugstore/?hl=vi"><i class="fa fa-instagram" aria-hidden="true"></i></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="index.html"><img src="<?php echo base_url(); ?>public/frontend/images/home/logo.png" alt="" /></a>
                            </div>
                            <div class="btn-group pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                        USA
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Canada</a></li>
                                        <li><a href="#">UK</a></li>
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                        DOLLAR
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Canadian Dollar</a></li>
                                        <li><a href="#">Pound</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><i class="fa fa-user"></i> Account</a></li>
                                    <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                    <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                    <li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <?php 
                                    if (!empty($list_menus)){
                                        foreach ($list_menus as $m) {                  
                                    ?>
                                        <?php 
                                        if (!empty($m['details'])){
                                        ?>
                                        <li class="dropdown"><a href="#"><?php echo $m['name']; ?><i class="fa fa-angle-down"></i></a>
                                            <ul role="menu" class="sub-menu">
                                                <?php 
                                                foreach ($m['details'] as $md) {                  
                                                ?>
                                                <li><a href="shop.html"><?php echo $md->name; ?></a></li>
                                                <?php                      
                                                }
                                                ?>
                                            </ul>
                                        </li>     
                                        <?php                      
                                        } else {                
                                        ?>
                                        <li><a href="index.html"><?php echo $m['name']; ?></a></li>
                                        <?php                      
                                        }           
                                        ?>
                                    
                                    <?php                      
                                        }                        
                                    }                
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="search_box pull-right">
                                <input type="text" placeholder="Search"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->