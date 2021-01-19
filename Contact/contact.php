<?php
include "../control/connection.php";
use PHPMailer\PHPMailer\PHPMailer;
$select = $con->prepare("SELECT * FROM settingsite WHERE siteid='1'");
$select->execute();
$fetch = $select->fetch();
if ($fetch['status'] == 1) {
    $select = $con->prepare("SELECT * FROM settingsite WHERE siteid='1'");
    $select->execute();
    $fetch = $select->fetch();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $mess = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
        $emailmy = $fetch['email'];
        $error = '';
        if (strlen($name) < 3 || strlen($mess) < 5 || $email != true) {
            $error = 'من فضلك ادخل البيانات بشكل صحيح';
        }
        if (empty($error) && $email == true) {
            $to = $emailmy;
            $subject = "contact us";
            $message = "
            <html>
            <head>
            <title>HTML email</title>
            </head>
            <body>
            <p style='color: red;font-size: 19px;margin-left: 364px;'>خدمه اتصل بنا </p>
            <table style='width:80%;border:1px solid black;direction: rtl;font-size: 18px;'>
            <tr>
            <th style='width: 227px;;border:1px solid black;color:rebeccapurple'>الاسم</th>
            <th style='border:1px solid black;color:rebeccapurple'>الرساله</th>
            </tr>
            <tr>
            <td style='border:1px solid black;text-align:center;'>$name</td>
            <td style='border:1px solid black'>$mess</td>
            </tr>
            </table>
            </body>
            </html>
            ";
            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
            $mail=new PHPMailer();
            //smtp settings
            $mail->isSMTP();
            $mail->Host="smtp.gmail.com";
            $mail->SMTPAuth=true;
            $mail->Username='mmmnnn2016161515@gmail.com';
            $mail->Password='Asas123654';
            $mail->Port=465;
            $mail->SMTPSecure="ssl";
            //send setting
            $mail->isHTML();
            $mail->setFrom($email,$name);
            $mail->addAddress($to);
            $mail->Subject=$subject;
            $mail->Body=$message;
            if($mail->send()){
                $success = 'تم الارسال بنجاح';
            }
           
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>اتصل بنا</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->
        <link rel="shortcut icon" type="image/png" href="../layout/images/logo3.png" />
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrapedit.css">
        <!--===============================================================================================-->
    </head>

    <body>
        <div class="container-contact100">
            <div class="wrap-contact100">
                <form class="contact100-form validate-form" method='POST' action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <span class="contact100-form-title">
                        مدرسة ميدوم الاعدادية بنين ترحب بكم
                    </span>
                    <?php
if (!empty($error)) {?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?php echo $error; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php }
    ?>
                    <?php
if (isset($success)) {?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $success; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php }
    ?>
                    <div class="wrap-input100 validate-input" data-validate="Name is required">
                        <span class="label-input100"><strong>الاسم</strong></span>
                        <input class="input100 name" type="text" name="name"
                        value='<?php if (!empty($name)) {echo $name;}?>' placeholder="ادخل الاسم">
                        <span class="focus-input100"></span>
                        <br><div class="alert alert-danger  alert-dismissible fade show alert-error1" role="alert">
                                <strong> الاسم صغير جدا</strong>
                            </div>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <span class="label-input100"><strong>الايميل</strong></span>
                        <input class="input100 email" type="email" name="email"
                        value='<?php if (!empty($email)) {echo $email;}?>' placeholder="ادخل الايميل">
                        <span class="focus-input100"></span>
                        <br><div class="alert alert-danger  alert-dismissible fade show alert-error2" role="alert">
                                <strong> الايميل غير صالح</strong>
                            </div>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Message is required">
                        <span class="label-input100"><strong>رسالتك</strong></span>
                        <textarea class="input100 mess" name="message" placeholder="...ادخل الرساله"><?php if (!empty($mess)) {echo $mess;}?></textarea>
                        <span class="focus-input100"></span>
                        <br><div class="alert alert-danger  alert-dismissible fade show alert-error3" role="alert">
                                <strong> الرساله قصيره جدا</strong>
                            </div>
                    </div>

                    <div class="container-contact100-form-btn">
                        <div class="wrap-contact100-form-btn">
                            <div class="contact100-form-bgbtn"></div>
                            <button class="contact100-form-btn">
                                <span>
                                    ارسال
                                    <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>



        <div id="dropDownSelect1"></div>

        <script src='js/jquery-3.4.1.min.js'></script>
        <script src='js/bootstrap.min.js'></script>
        <script src='js/main.js'></script>
    </body>

    </html>

<?php } else {?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>مدرسة ميدوم الاعدادية بنين</title>
            <link rel="shortcut icon" type="image/png" href="../layout/images/logo3.png" />
            <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
                <script src='js/jquery-3.4.1.min.js'></script>
                <script src='js/bootstrap.min.js'></script>
                <script src='js/main.js'></script>
        </body>
    </html>

<?php }?>
