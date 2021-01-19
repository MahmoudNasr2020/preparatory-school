<?php
use PHPMailer\PHPMailer\PHPMailer;
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])) {
    include "connection.php";
    $select = $con->prepare("SELECT * FROM login WHERE id=1");
    $select->execute();
    $fetch = $select->fetch();
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        if ($email == $fetch['email']) {
            $_SESSION['email'] = $email;
            $to = $email;
            $msg = rand();
            $updatepass = $con->prepare("UPDATE login SET password=?");
            $updatepass->execute(array(sha1($msg)));
            $subject = "Change Password";
            $message = "
            <html>
            <head>
            <title >HTML email</title>
            </head>
            <body>
            <strong><p style='color:red;margin-left: 178px;font-size: 17px'>
            كلمة السر الخاصه بك</p></strong>
            <table style='border:1px solid black;width:50%'>
            <tr>
            <th style='border-bottom:1px solid black'><strong>كلمة السر</strong></th>
            </tr>
            <tr>
            <td style='text-align:center'><strong>$msg</strong></td>
            </tr>
            </table>
            </body>
            </html>
            ";
            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
            $mail = new PHPMailer();
            //stmp settings
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'mmmnnn2016161515@gmail.com';
            $mail->Password = 'Asas123654';
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";
            //send setting
            $mail->isHTML();
            $mail->setFrom($to, "School Settings");
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;
            if ($mail->send()) {
                $success = "تم ارسال كلمة السر الي الايميل";
                echo "<meta http-equiv='refresh' content='2.5;url=index.php'>";
            }
        } else {
            $error = 'هذا الايميل غير مسجل لدينا';
        }

    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Control Panel</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="Login/images/icons/icon.png"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login/vendor/animate/animate.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login/css/util.css">
        <link rel="stylesheet" type="text/css" href="Login/css/main.css">
    <!--===============================================================================================-->
    </head>
    <body>

        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="Login/images/img-01.png" alt="IMG">
                    </div>

                    <form class="login100-form validate-form" method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                        <span class="login100-form-title">
                             الدخول الي لوحة التحكم
                        </span>
                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100" type="email" name="email"
                            placeholder="Enter Email" autocomplete='off' value=''>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Send
                            </button>
                        </div>
                        <?php
if (isset($success)) {?>
                                <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><?php echo $success; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                            <?php }
    ?>
                         <?php
if (isset($error)) {?>
                                <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><?php echo $error; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                            <?php }
    ?>
                    </form>
                </div>
            </div>
        </div>




    <!--===============================================================================================-->
        <script src="Login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="Login/vendor/bootstrap/js/popper.js"></script>
        <script src="Login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="Login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
        <script src="Login/vendor/tilt/tilt.jquery.min.js"></script>
        <script >
            $('.js-tilt').tilt({
                scale: 1.1
            })
        </script>
    <!--===============================================================================================-->
        <script src="Login/js/main.js"></script>

    </body>
    </html>

<?php } else {
    header('location:control.php');
}?>

