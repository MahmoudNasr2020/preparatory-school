<?php
include "control/connection.php";
$select = $con->prepare("SELECT * FROM settingsite WHERE siteid='1'");
$select->execute();
$fetch = $select->fetch();
$selectnews = $con->prepare("SELECT * FROM news ");
$selectnews->execute();
$fetchnews = $selectnews->fetch();
$select_slider = $con->prepare("SELECT * FROM silder");
$select_slider->execute();
$fetch_slider = $select_slider->fetch();
$selectmanger = $con->prepare("SELECT * FROM manger WHERE id=2");
$selectmanger->execute();
$fetchmanger = $selectmanger->fetch();
$selectteacher = $con->prepare("SELECT * FROM teacher");
$selectteacher->execute();
$fetchteacher = $selectteacher->fetch();
$selectservice = $con->prepare("SELECT * FROM service");
$selectservice->execute();
$fetchtservice = $selectservice->fetch();
$selectgoals1 = $con->prepare("SELECT * FROM goals WHERE id=1");
$selectgoals1->execute();
$fetchtgoals1 = $selectgoals1->fetch();
$selectgoals2 = $con->prepare("SELECT * FROM goals WHERE id=2");
$selectgoals2->execute();
$fetchtgoals2 = $selectgoals2->fetch();
$selectgoals3 = $con->prepare("SELECT * FROM goals WHERE id=3");
$selectgoals3->execute();
$fetchtgoals3 = $selectgoals3->fetch();
$selectres3 = $con->prepare("SELECT * FROM studentres3 WHERE id=1");
$selectres3->execute();
$fetchres3 = $selectres3->fetch();
$selectsocial = $con->prepare("SELECT * FROM social WHERE id=1");
$selectsocial->execute();
$fetchsocial = $selectsocial->fetch();
if ($fetch['status'] == 1) {?>
    <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from sha.edu.eg/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Apr 2020 19:34:28 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="الموقع الرسمي لمدرسة ميدوم الاعدادية بنين الواقعه
 في قرية ميدوم في محافظة بني سويف"/>
<meta property="og:title" content="" />
<meta property="og:description" content="" />
<meta property="og:image" content="" />
<meta name="format-detection" content="telephone=no">

<!-- FAVICONS ICON -->
<link rel="icon" href="layout/images/l" type="image/x-icon" />
<link rel="shortcut icon" type="image/x-icon" href="layout/images/logo2.png" />
<link href="https://fonts.googleapis.com/css?family=Cairo&amp;display=swap" rel="stylesheet" />
<!-- PAGE TITLE HERE -->
<title><?php if (isset($fetch)) {echo $fetch['sitename'];}?></title>

<!-- MOBILE SPECIFIC -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- STYLESHEETS -->
<link rel="stylesheet" type="text/css" href="layout/css/plugins.css">
<link rel="stylesheet" type="text/css" href="layout/css/style.css">
<link rel="stylesheet" type="text/css" href="layout/css/templete.css">
<link class="skin" rel="stylesheet" type="text/css" href="layout/css/skin/skin-1.css">
</head>

<body id="bg">
    <div class="page-wraper">
        <!-- header -->
        <header class="site-header header mo-left">
            <!-- main header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix ">
                    <div class="container clearfix">

                        <!-- main nav -->
                        <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="">الصفحة الرئيسية <i class="fa"></i></a></li>

                                <li class=""><a href="about-school.php">عن المدرسة</a></li>
                                <li><a href="version.php">رؤية المدرسة</a></li>
                                <li><a href="#">النتيجة<i class="fa fa-chevron-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="result/result.php" target="_blank">نتيجة الصف الاول</a></li>
                                        <li><a href="result/result.php" target="_blank">نتيجة الصف الثاني</a></li>
                                        <li><a href="<?php if (isset($fetchres3)) {echo $fetchres3['link'];}?>" target="_blank">نتيجة الصف الثالث</a></li>
                                    </ul>
                                </li>

                                <li><a href="Contact/contact.php" target="_blank"> اتصل بنا </a></li>
                            </ul>
                        </div>
                        <!-- website logo -->
                        <div class="logo-header mostion">
                            <a href="" class="dez-page"><img src="layout/images/logo2.png" alt=""></a>
                        </div>
                        <!-- nav toggle button -->
                        <button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
           <span></span>
           <span></span>
           <span></span>
         </button>
                    </div>

                </div>
            </div>
            <!-- main header END -->
        </header>
        <!-- header END -->

        <!-- Content -->
        <div class="page-content bg-white">
            <!-- Slider Banner -->
            <!-- Main Slider -->
            <div class="home_slider owl-slider Slider owl-carousel owl-theme owl-btn-center-lr dots-none">
                <?php
while ($fetch_slider = $select_slider->fetch()) {?>
                            <div class="item slide-item">
                                <div class="slide-item-img"><img src="control/<?php echo $fetch_slider['img']; ?>" class="" alt="" /></div>
                                <div class="slide-content">
                                    <div class="slide-content-box container">
                                        <div class="slide-content-area">
                                            <p><?php echo $fetch_slider['adress']; ?></p>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                   <?php }
    ?>
            </div>
            <!-- Slider Banner -->

            <div class="content-block">

                <div class="section-full bg-gray content-inner-2">
                    <h3 class="title"> خدمات الموقع </h3>
                    <div class="container">
                        <div class="row">
                            <div class="courses-carousel owl-carousel owl-btn-center-lr owl-btn-3 col-md-12 p-lr0">
                                <!-- <div class="item">
							<a href="#">
								<div class="courses-bx">
									<img src="868273_sign_512x512.png" alt=""/>
									<h2 class="title"> وظائف </h2>
								</div>
							</a>
                        </div> -->
                        <?php
while ($fetchtservice = $selectservice->fetch()) {?>
                                    <div class="item">
                                    <a href="<?php echo $fetchtservice['news']; ?>" target="_blank">
                                        <div class="courses-bx">
                                            <img src="control/<?php echo $fetchtservice['img']; ?>" alt="" />
                                            <h2 class="title"><?php echo $fetchtservice['adressnews']; ?></h2>
                                        </div>
                                    </a>
                                </div>
                            <?php }
    ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About Us -->
                <div class="section-full bg-white content-inner-2" style="background-image:url(layout/images/pattern/pt1.png);">
                    <div class="container">
                        <div class="section-head text-center">
                            <h3 class="title"><?php if (isset($fetchmanger)) {echo $fetchmanger['mangerAdd'];}?></h3>
                        </div>
                        <div class="row align-items-center about-bx2">
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                <div class="about-box">
                                    <p class="ext"><?php if (isset($fetchmanger)) {echo $fetchmanger['mangerText'];}?></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                <img src="control/<?php if (isset($fetchmanger)) {echo $fetchmanger['img'];}?>" class="img" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="institutes section-full content-inner-2 bg-gray">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="courses-bx-2 m-b30">
                                    <img src="control/<?php if (isset($fetchtgoals1)) {echo $fetchtgoals1['img'];}?>" alt="">
                                    <div class="info">
                                        <h2 class="title"><a href=""><?php if (isset($fetchtgoals1)) {echo $fetchtgoals1['address'];}?></a></h2>
                                        <p><?php if (isset($fetchtgoals1)) {echo $fetchtgoals1['text'];}?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="courses-bx-2 m-b30">
                                    <img src="control/<?php if (isset($fetchtgoals2)) {echo $fetchtgoals2['img'];}?>" alt="">
                                    <div class="info">
                                        <h2 class="title"><a href=""><?php if (isset($fetchtgoals2)) {echo $fetchtgoals2['address'];}?></a></h2>
                                        <p><?php if (isset($fetchtgoals2)) {echo $fetchtgoals2['text'];}?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                <div class="courses-bx-2 m-b30">
                                    <img src="control/<?php if (isset($fetchtgoals3)) {echo $fetchtgoals3['img'];}?>" alt="">
                                    <div class="info">
                                        <h2 class="title"><a href=""><?php if (isset($fetchtgoals3)) {echo $fetchtgoals3['address'];}?></a></h2>
                                        <p><?php if (isset($fetchtgoals3)) {echo $fetchtgoals3['text'];}?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sha_news section-full content-inner-2 bg-gray">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="action-box">
                                    <div class="head">
                                        <h4 class="title"> <a href="news.html" style="color: #ffffff !important;"> أخر الأخبار </a> </h4>
                                    </div>
                                    <div class="action-area marquee1">
                                        <ul>
                                            <?php
while ($fetchnews = $selectnews->fetch()) {?>
                                                    <li>
                                                        <a href="#">
                                                            <div class="row ">
                                                                <div class="col-md-4 col-sm-12 col-12">
                                                                    <img src="control/<?php if (isset($fetchnews)) {echo $fetchnews['img'];}?>" alt="">
                                                                </div>
                                                                <div class="col-md-8 col-sm-12 col-12">
                                                                    <h5><?php if (isset($fetchnews)) {echo $fetchnews['adressnews'];}?></h5>
                                                                    <p><?php if (isset($fetchnews)) {echo $fetchnews['news'];}?></p>
                                                                    <span><?php if (isset($fetchnews)) {echo $fetchnews['date'];}?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                <?php }
    ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="sha360">

                </div>
                <div class="section-full bg-white content-inner-2">
                    <div class="container">
                        <div class="section-head text-center">
                            <h2 class="title text-secondry">هيئة التدريس</h2>
                        </div>
                        <div class="client-box2">
                            <div class="client-carousel-3 owl-carousel owl-theme sprite-nav">
                                <?php
while ($fetchteacher = $selectteacher->fetch()) {?>
                                            <div class="item">
                                                <div class="client-box style-2">
                                                    <div class="testimonial-text">
                                                        <p><strong>الاسم : </strong><?php echo $fetchteacher['name']; ?></p>
                                                        <div class="testimonial-detail clearfix">
                                                            <h5 class="testimonial-name m-t0 m-b5">
                                                                <strong>المادة : </strong><?php echo $fetchteacher['subject']; ?></h5>
                                                        </div>
                                                    </div>
                                                    <div class="testimonial-pic">
                                                        <img src="control/<?php echo $fetchteacher['img']; ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                  <?php }
    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content END-->
        <!-- Footer -->
        <footer class="site-footer " id="site_footer ">
            <div class="footer-top ">
                <div class="container ">
                    <div class="row ">
                        <div class="col-md-6 col-sm-6 col-lg-5 footer-col-5 ">
                            <div class="widget widget_getintuch ">
                                <h4 class="footer-title "> بيانات الإتصال </h4>
                                <ul class="info-contact ">
                                    <li>
                                        <span>
                                         العنوان : <?php if (isset($fetch)) {echo $fetch['address'];}?> <i class="fa fa-map-marker "></i>
																</span>
                                    </li>

                                    <li>
                                        <span>
																 الرقم المختصر : <?php if (isset($fetch)) {echo $fetch['number'];}?>	<i class="fa fa-phone "></i>
																</span>
                                    </li>

                                    <li>
                                        <span>
																	 البريد الإلكتروني : <?php if (isset($fetch)) {echo $fetch['email'];}?> <i class="fa fa-envelope-o "></i>
																</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-7 footer-col-7 ">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3476.8640617431547!2d31.16790748557412!3d29.374269256874758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1459915756b1c19b%3A0x899db583bd12a11f!2z2YXYr9ix2LPYqSDZhdmK2K_ZiNmFINin2YTYp9i52K_Yp9iv2YrZhyDYqNmG2YrZhiDZiNio2YbYp9iq!5e0!3m2!1sar!2seg!4v1587581673246!5m2!1sar!2seg "
                                frameborder="0 " style="border:0 " allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="clearfix ">
                        <ul class="full-social-icon row ">
                            <li class="fb col-lg-3 col-md-6 col-sm-6 m-b30 ">
                                <a href="<?php if (isset($fetchsocial)) {echo $fetchsocial['facebook'];}?>"
                                target=_blank><i class="fa fa-facebook "></i> Facebook </a>
                            </li>
                            <li class="tw col-lg-3 col-md-6 col-sm-6 m-b30 ">
                                <a href="<?php if (isset($fetchsocial)) {echo $fetchsocial['tweet'];}?>" target=_blank>
                                <i class="fa fa-twitter "></i> Tweet </a>
                            </li>
                            <li class="gplus col-lg-3 col-md-6 col-sm-6 m-b30 ">
                                <a href="<?php if (isset($fetchsocial)) {echo $fetchsocial['youtube'];}?>" target=_blank>
                                <i class="fa fa-youtube-square "></i> Youtube </a>
                            </li>
                            <li class="linkd col-lg-3 col-md-6 col-sm-6 m-b30 ">
                                <a href="<?php if (isset($fetchsocial)) {echo $fetchsocial['instagram'];}?>" target=_blank>
                                <i class="fa fa-instagram "></i> Instagram </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- footer bottom part -->
            <div class="footer-bottom ">
                <div class="container ">
                    <div class="row ">
                        <div class="col-md-6 col-sm-6 text-right ">Developed by
                            <spam> © <a href='https://www.facebook.com/profile.php?id=100011445331879' target='_blank'>Mahmoud Nasr</a> 2020 </spam>
                        </div>
                        <div class="col-md-6 col-sm-6 text-left ">
                            <ul class="fb-list ">
                                <li><a href="index.php">الصفحة الرئيسية</a></li>
                                <li><a href="about-school.php">عن المدرسة</a></li>
                                <li><a href="version.php">رؤية المدرسة</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer END-->
        <button class="scroltop fa fa-chevron-up "></button>
    </div>
    <!-- JAVASCRIPT FILES ========================================= -->
    <script src="layout/js/jquery.min.js "></script>
    <!-- JQUERY.MIN JS -->
    <script src="layout/js/paperstack.js "></script>
    <script src="layout/plugins/wow/wow.js "></script>
    <!-- WOW JS -->
    <script src="layout/plugins/bootstrap/js/popper.min.js "></script>
    <!-- BOOTSTRAP.MIN JS -->
    <script src="layout/plugins/bootstrap/js/bootstrap.min.js "></script>
    <!-- BOOTSTRAP.MIN JS -->
    <script src="layout/plugins/bootstrap-select/bootstrap-select.min.js "></script>
    <!-- FORM JS -->
    <script src="layout/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js "></script>
    <!-- FORM JS -->
    <script src="layout/plugins/lightgallery/js/lightgallery-all.min.js "></script>
    <!-- LIGHTGALLERY JS -->
    <script src="layout/plugins/magnific-popup/magnific-popup.js "></script>
    <!-- LIGHTGALLERY JS -->
    <script src="layout/plugins/counter/waypoints-min.js "></script>
    <!-- WAYPOINTS JS -->
    <script src="layout/plugins/counter/counterup.min.js "></script>
    <!-- COUNTERUP JS -->
    <script src="layout/plugins/imagesloaded/imagesloaded.js "></script>
    <!-- IMAGESLOADED -->
    <script src="layout/plugins/masonry/masonry-3.1.4.js "></script>
    <!-- MASONRY -->
    <script src="layout/plugins/masonry/masonry.filter.js "></script>
    <!-- MASONRY -->
    <script src="layout/plugins/owl-carousel/owl.carousel.js "></script>
    <!-- OWL SLIDER -->
    <script src="layout/plugins/scroll/scrollbar.min.js "></script>
    <!-- OWL SLIDER -->
    <script src="layout/js/custom.js "></script>
    <!-- CUSTOM FUCTIONS  -->
    <script src="layout/js/dz.carousel.js "></script>
    <!-- SORTCODE FUCTIONS -->
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyBjirg3UoMD5oUiFuZt3P9sErZD-2Rxc68&amp;sensor=false "></script>
    <!-- GOOGLE MAP -->
    <script src='www.google.com/recaptcha/api.html'></script>
    <!-- Google API For Recaptcha  -->
    <script src="layout/js/dz.ajax.js "></script>
    <!-- CONTACT JS  -->
    <script src="layout/plugins/loading/anime.js "></script>
    <!-- LOADING JS -->
    <script src="layout/plugins/loading/anime-app.js "></script>
    <!-- LOADING JS -->
    <script src="layout/js/jquery.marquee.js "></script>
    <!-- LOADING JS -->
    <script>
        $(function() {
            $('.marquee').marquee({
                speed: 100,
                gap: 0,
                delayBeforeStart: 0,
                direction: 'left',
                duplicated: true,
                pauseOnHover: true
            });
            $('.marquee1').marquee({
                speed: 50,
                gap: 0,
                delayBeforeStart: 0,
                direction: 'up',
                duplicated: true,
                pauseOnHover: true
            });
        });
    </script>
</body>

<!-- Mirrored from smartclass.dexignzone.com/xhtml/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 09 Dec 2019 10:02:54 GMT -->

<!-- Mirrored from sha.edu.eg/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Apr 2020 19:34:47 GMT -->

</html>
<?php } else {?>
    <!DOCTYPE html>
    <html>
        <head>
             <title>مدرسة ميدوم الاعدادية بنين</title>
            <link rel="shortcut icon" type="image/png" href="layout/images/logo3.png" />
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="./Contact/css/bootstrap.min.css">
        </head>
        <body style="text-align: center;">
        <div class="sha_news section-full content-inner-2 bg-gray">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="action-box">
                                <img src='layout/images/الصيانة.gif' class='img-fluid' alt='Responsive image'>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script src='layout/js/jquery.min.js'></script>
                <script src='./Contact/js/bootstrap.min.js'></script>

        </body>
    </html>
<?php }
?>
