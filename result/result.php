<?php
include "../control/connection.php";
$select = $con->prepare("SELECT * FROM settingsite WHERE siteid='1'");
$select->execute();
$fetch = $select->fetch();
if ($fetch['status'] == 1) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name1 = $_POST['name_std'];
        $select1 = $_POST['select_std'];
        if ($select1 == 1) {
            $selectstd1 = $con->prepare("SELECT * FROM studentres WHERE idnumber=$name1");
            $selectstd1->execute();
            $row1 = $selectstd1->rowCount();
            if ($row1 > 0) {
                $fetch1 = $selectstd1->fetch();
                $sucess = 'success';
            } else {
                $error = 'رقم الجلوس غير موجود';
            }
        }
        if ($select1 == 2) {
            $selectstd2 = $con->prepare("SELECT * FROM studentres2 WHERE idnumber=$name1");
            $selectstd2->execute();
            $row2 = $selectstd2->rowCount();
            if ($row2 > 0) {
                $fetch2 = $selectstd2->fetch();
                $sucess2 = 'success';
            } else {
                $error2 = 'رقم الجلوس غير موجود';
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html>

    <!-- Mirrored from www.cairogovresults.com/Results/PreparatoryCertificate by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Apr 2020 21:39:41 GMT -->
    <!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <!-- /Added by HTTrack -->

    <head>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>النتيجة</title>
        <!-- Global site tag (gtag.js) - Google Analytics -->

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="Content/logo2.png">

        <!-- === webfont=== -->
        <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
        <!--Font awesome css-->
        <link rel="stylesheet" href="Content/css/font-awesome.min.css">
        <!--Bootstrap-->
        <link href="Content/css/bootstrap.min.css" rel="stylesheet">
        <!--UI css-->
        <link rel="stylesheet" href="Content/css/jquery-ui.css">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="Content/css/venobox.css">
        <!--Owl Carousel css-->
        <link href="Content/css/owl.carousel.css" rel="stylesheet">
        <link href="Content/css/owl.theme.css" rel="stylesheet">
        <!--Animate css-->
        <link href="Content/css/animate.css" rel="stylesheet">

        <link href="Content/css/style.css" rel="stylesheet">

        <link href="Content/css/responsive.css" rel="stylesheet">

        <link href="Content/css/arabic.css" rel="stylesheet">

        <style>
            .mainmenu li a {
                font-size: 17px;
                padding: 28px 4px;
            }

            .fc-pink a {
                color: #e83e8c;
            }
        </style>

        <link href="Content/css/customScreens.css" rel="stylesheet" />
        <style>
            .form-group {
                margin-bottom: inherit;
            }

            .lblTitle {
                color: black;
                font-weight: bold;
                font-size: 15px;
            }

            .lblErrorMessage {
                color: red;
                font-size: 13px;
                font-weight: normal;
            }
        </style>


    </head>

    <body>


        <div id="body">



            <div class="row" id="sidebar" style="top:65%; bottom:0px; position:fixed; z-index:5; display:none">
                <div class="col-lg-1"></div>
                <div class="col-lg-10" style="padding:20px">
                    <div class="bg-red" style="border-radius:5px; opacity:0.9; padding:20px">
                        <div style="text-align:left">
                            <button class="btn btn-default" id="btnClose" style="cursor:pointer"><span class="fa fa-lg fa-close"></span></button>
                        </div>
                        <div style="text-align: center">
                            <h2 style="color:white; font-weight:bold" id="resultAdvertisement"></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>

            <section class="choose-class-area bg-white">

                <div class="container-fluid custom-container">

                    <div class="row">
                        <div class="col-md-12" style='margin-top: -36px;'>
                            <h2 class="area-heading font-orange ">مدرسة ميدوم الاعدادية بنين ترحب بكم</h2>
                            <h2 class="area-heading font-orange st-two">النتيجة</h2>
                        </div>
                    </div>

                    <div class="row justify-content-center">

                        <div class="col-md-8" style="text-align:right">
                        <form method='post'>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <select class="form-control" name="select_std" style="display:inline; padding:inherit" id="ddlStages">
                                        <option value="0" selected="selected">----- اختر المرحلة -----</option>
                                        <option value="1" >----- الصف الاول الاعدادي -----</option>
                                        <option value="2" >----- الصف الثاني الاعدادي -----</option>
                                    </select>
                                    <span class="lblErrorMessage" id="lblError_Stage"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" class="form-control"  name="name_std" placeholder="ادخل رقم الجلوس" style="display:inline" />
                                    <span class="lblErrorMessage" id="lblError_SeatNumber"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <button class="btn btn-info" id="btnDisplay" style="cursor:pointer">عرض النتيجة</button><br>
                                    <?php
if (isset($error)) {?>
                                    <br><div class="alert alert-danger" role="alert">
                                         <strong><?php echo $error; ?></strong>
                                    </div>
                                <?php }
    ?>
                                   <?php
if (isset($error2)) {?>
                                    <br><div class="alert alert-danger" role="alert">
                                         <strong><?php echo $error2; ?></strong>
                                    </div>
                                <?php }
    ?>
                                </div>
                            </div>

                            <?php
if (isset($sucess)) {?>
                            <br><table class="table table-dark">
                                    <tbody>
                                        <tr>
                                        <th scope="row">مديرية التربيه والتعليم</th>
                                        <td>محافظة بني سويف</td>

                                        </tr>
                                        <tr>
                                        <th scope="row">الاداره التعليمية</th>
                                        <td>الواسطي</td>

                                        </tr>
                                        <tr>
                                        <th scope="row">مدرسة</th>
                                        <td>ميدوم الاعدادية بنين</td>
                                        </tr>
                                        <tr>
                                    <th scope="row">الصف</th>
                                    <td>الاول الاعدادي</td>
                                    </tr>
                                        <tr>
                                    <th scope="row">اسم الطالب</th>
                                    <td><?php echo $fetch1['name']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">رقم الجلوس</th>
                                    <td><?php echo $fetch1['idnumber']; ?></td>
                                    </tr>

                                    </tbody>
                                </table>
                                <table class="table table-dark">
                                    <tbody>
                                    <tr>
                                    <th scope="row">اللغة العربية</th>
                                    <td><?php echo $fetch1['arabic']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">اللغة الانجليزية</th>
                                    <td><?php echo $fetch1['english']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">الرياضيات</th>
                                    <td><?php echo $fetch1['math']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">الدراسات الاجتماعية</th>
                                    <td><?php echo $fetch1['studies']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">العلوم</th>
                                    <td><?php echo $fetch1['Sciences']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">نشاط 1</th>
                                    <td><?php echo $fetch1['activity1']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">نشاط 2</th>
                                    <td><?php echo $fetch1['activity2']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">المجموع</th>
                                    <td><?php echo $fetch1['arabic'] + $fetch1['english'] + $fetch1['math'] +
            $fetch1['studies'] + $fetch1['Sciences'] + $fetch1['activity1'] + $fetch1['activity2']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">التربية الدينية</th>
                                    <td><?php echo $fetch1['religious']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">التربية الفنية</th>
                                    <td><?php echo $fetch1['art']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">حاسب الي</th>
                                    <td><?php echo $fetch1['computer']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                         <?php }
    ?>

    <?php
if (isset($sucess2)) {?>
                            <br><table class="table table-dark">
                                    <tbody>
                                        <tr>
                                        <th scope="row">مديرية التربيه والتعليم</th>
                                        <td>محافظة بني سويف</td>

                                        </tr>
                                        <tr>
                                        <th scope="row">الاداره التعليمية</th>
                                        <td>الواسطي</td>

                                        </tr>
                                        <tr>
                                        <th scope="row">مدرسة</th>
                                        <td>ميدوم الاعدادية بنين</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">الصف</th>
                                            <td>الثاني الاعدادي</td>
                                            </tr>
                                        <tr>
                                        <th scope="row">اسم الطالب</th>
                                    <td><?php echo $fetch2['name']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">رقم الجلوس</th>
                                    <td><?php echo $fetch2['idnumber']; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table class="table table-dark">
                                    <tbody>
                                    <tr>
                                    <tr>
                                    <th scope="row">اللغة العربية</th>
                                    <td><?php echo $fetch2['arabic']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">اللغة الانجليزية</th>
                                    <td><?php echo $fetch2['english']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">الرياضيات</th>
                                    <td><?php echo $fetch2['math']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">الدراسات الاجتماعية</th>
                                    <td><?php echo $fetch2['studies']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">العلوم</th>
                                    <td><?php echo $fetch2['Sciences']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">نشاط 1</th>
                                    <td><?php echo $fetch2['activity1']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">نشاط 2</th>
                                    <td><?php echo $fetch2['activity2']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">المجموع</th>
                                    <td><?php echo $fetch2['arabic'] + $fetch2['english'] + $fetch2['math'] +
            $fetch2['studies'] + $fetch2['Sciences'] + $fetch2['activity1'] + $fetch2['activity2']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">التربية الدينية</th>
                                    <td><?php echo $fetch2['religious']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">التربية الفنية</th>
                                    <td><?php echo $fetch2['art']; ?></td>
                                    </tr>
                                    <tr>
                                    <th scope="row">حاسب الي</th>
                                    <td><?php echo $fetch2['computer']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                         <?php }
    ?>

                                </div>
                            </div>

                    </form>

                        </div>

                    </div>

                </div>

            </section>
        </div>


    </body>

    <!-- Mirrored from www.cairogovresults.com/Results/PreparatoryCertificate by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Apr 2020 21:39:49 GMT -->

    </html>

    <?php } else {?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>مدرسة ميدوم الاعدادية بنين</title>
            <link rel="shortcut icon" type="image/png" href="../layout/images/logo3.png" />
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="../Contact/css/bootstrap.min.css">
        </head>
        <body style="text-align: center;">
        <div class="sha_news section-full content-inner-2 bg-gray">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="action-box">
                                <img src='../layout/images/الصيانة.gif' class='img-fluid' alt='Responsive image'>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script src='../layout/js/jquery.min.js'></script>
                <script src='../Contact/js/bootstrap.min.js'></script>

        </body>
    </html>
<?php }
?>