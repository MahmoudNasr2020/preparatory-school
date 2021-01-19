<?php
include "control/connection.php";
$select = $con->prepare("SELECT * FROM version WHERE id=1");
$select->execute();
$fetch = $select->fetch();
$select1 = $con->prepare("SELECT * FROM settingsite WHERE siteid=1");
$select1->execute();
$fetch1 = $select1->fetch();
$selectres3 = $con->prepare("SELECT * FROM studentres3 WHERE id=1");
$selectres3->execute();
$fetchres3 = $selectres3->fetch();
$selectsocial = $con->prepare("SELECT * FROM social WHERE id=1");
$selectsocial->execute();
$fetchsocial = $selectsocial->fetch();
if ($fetch1['status'] == 1) {?>
    <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from sha.edu.eg/under_work.php by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Apr 2020 19:35:20 GMT -->
<!-- Added by HTTrack -->

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <!-- /Added by HTTrack -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON -->
    <link rel="icon" href="layout/images/logo3.png" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="layout/images/logo3.png" />
    <link href="https://fonts.googleapis.com/css?family=Cairo&amp;display=swap" rel="stylesheet" />
    <!-- PAGE TITLE HERE -->
    <title>رؤية المدرسة </title>

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
                                <li><a href="index.php">الصفحة الرئيسية <i class="fa"></i></a></li>

                                <li><a href="about-school.php">عن المدرسة</a></li>
                                <li class="active"><a href="">رؤية المدرسة</a></li>
                                <li><a href="#">النتيجة<i class="fa fa-chevron-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="./result/result.php" target="_blank">نتيجة الصف الاول</a></li>
                                        <li><a href="./result/result.php" target="_blank">نتيجة الصف الثاني</a></li>
                                        <li><a href="<?php if (isset($fetchres3)) {echo $fetchres3['link'];}?>" target="_blank">نتيجة الصف الثالث</a></li>
                                    </ul>
                                </li>

                                <li><a href="Contact/contact.php" target="_blank"> اتصل بنا </a></li>
                            </ul>
                        </div>
                        <!-- website logo -->
                        <div class="logo-header mostion">
                            <a href="index.html" class="dez-page"><img src="layout/images/logo3.png" alt=""></a>
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
        <div class="page-content">
            <!-- inner page banner -->
            <div class="section-full bg-white content-inner-2" style="background-image:url(layout/images/pattern/pt1.png);">
                <div class="container">
                    <div class="section-head text-center">
                        <h3 class="title"><?php if (isset($fetch)) {echo $fetch['textaddress'];}?></h3>
                    </div>
                    <div class="row align-items-center about-bx2">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="about-box">
                                <p class="ext"><?php if (isset($fetch)) {echo $fetch['text'];}?></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                            <img src="control/<?php if (isset($fetch)) {echo $fetch['img'];}?>" class="img" alt="" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="site-footer" id="site_footer">
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-5 footer-col-5">
                                <div class="widget widget_getintuch">
                                    <h4 class="footer-title"> بيانات الإتصال </h4>
                                    <ul class="info-contact">
                                         <li>
                                        <span>
                                        العنوان : <?php if (isset($fetch1)) {echo $fetch1['address'];}?> <i class="fa fa-map-marker "></i>
																</span>
                                    </li>

                                    <li>
                                        <span>
																 الرقم المختصر : <?php if (isset($fetch1)) {echo $fetch1['number'];}?>	<i class="fa fa-phone "></i>
																</span>
                                    </li>

                                    <li>
                                        <span>
																	 البريد الإلكتروني : <?php if (isset($fetch1)) {echo $fetch1['email'];}?> <i class="fa fa-envelope-o "></i>
																</span>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-lg-7 footer-col-7">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3476.8640617431547!2d31.16790748557412!3d29.374269256874758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1459915756b1c19b%3A0x899db583bd12a11f!2z2YXYr9ix2LPYqSDZhdmK2K_ZiNmFINin2YTYp9i52K_Yp9iv2YrZhyDYqNmG2YrZhiDZiNio2YbYp9iq!5e0!3m2!1sar!2seg!4v1587581673246!5m2!1sar!2seg"
                                    frameborder="0" style="border:0" allowfullscreen></iframe>
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
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 text-right ">Developed by
                                <spam> © <a href='https://www.facebook.com/profile.php?id=100011445331879' target='_blank'>Mahmoud Nasr</a> 2020 </spam>
                            </div>
                            <div class="col-md-6 col-sm-6  text-left">
                                <ul class="fb-list">
                                    <li><a href="index.php">الصفحة الرئيسية</a></li>
                                    <li><a href="about-school.php">عن المدرسة</a></li>
                                    <li><a href="#">رؤية المدرسة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer END-->
            <button class="scroltop fa fa-chevron-up"></button>
        </div>
        <!-- JAVASCRIPT FILES ========================================= -->
        <script src="layout/js/jquery.min.js"></script>
        <!-- JQUERY.MIN JS -->
        <script src="layout/js/paperstack.js"></script>
        <script src="layout/plugins/wow/wow.js"></script>
        <!-- WOW JS -->
        <script src="layout/plugins/bootstrap/js/popper.min.js"></script>
        <!-- BOOTSTRAP.MIN JS -->
        <script src="layout/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- BOOTSTRAP.MIN JS -->
        <script src="layout/plugins/bootstrap-select/bootstrap-select.min.js"></script>
        <!-- FORM JS -->
        <script src="layout/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
        <!-- FORM JS -->
        <script src="layout/plugins/lightgallery/js/lightgallery-all.min.js"></script>
        <!-- LIGHTGALLERY JS -->
        <script src="layout/plugins/magnific-popup/magnific-popup.js"></script>
        <!-- LIGHTGALLERY JS -->
        <script src="layout/plugins/counter/waypoints-min.js"></script>
        <!-- WAYPOINTS JS -->
        <script src="layout/plugins/counter/counterup.min.js"></script>
        <!-- COUNTERUP JS -->
        <script src="layout/plugins/imagesloaded/imagesloaded.js"></script>
        <!-- IMAGESLOADED -->
        <script src="layout/plugins/masonry/masonry-3.1.4.js"></script>
        <!-- MASONRY -->
        <script src="layout/plugins/masonry/masonry.filter.js"></script>
        <!-- MASONRY -->
        <script src="layout/plugins/owl-carousel/owl.carousel.js"></script>
        <!-- OWL SLIDER -->
        <script src="layout/plugins/scroll/scrollbar.min.js"></script>
        <!-- OWL SLIDER -->
        <script src="layout/js/custom.js"></script>
        <!-- CUSTOM FUCTIONS  -->
        <script src="layout/js/dz.carousel.js"></script>
        <!-- SORTCODE FUCTIONS -->
        <script src="https://maps.google.com/maps/api/js?key=AIzaSyBjirg3UoMD5oUiFuZt3P9sErZD-2Rxc68&amp;sensor=false"></script>
        <!-- GOOGLE MAP -->
        <script src='www.google.com/recaptcha/api.html'></script>
        <!-- Google API For Recaptcha  -->
        <script src="layout/js/dz.ajax.js"></script>
        <!-- CONTACT JS  -->
        <script src="layout/plugins/loading/anime.js"></script>
        <!-- LOADING JS -->
        <script src="layout/plugins/loading/anime-app.js"></script>
        <!-- LOADING JS -->
        <script src="layout/js/jquery.marquee.js"></script>
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

<!-- Mirrored from sha.edu.eg/under_work.php by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Apr 2020 19:35:20 GMT -->

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

