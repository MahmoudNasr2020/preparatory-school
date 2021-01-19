<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    $select = $con->prepare("SELECT * FROM login WHERE id='1'");
    $select->execute();
    $fetch = $select->fetch();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = filter_var(trim($_POST['sitename']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING);
        $pass1 = filter_var(trim($_POST['pass1']), FILTER_SANITIZE_STRING);
        $error = '';
        if ($name == '' || $email == '' || $email != true || $pass != $pass1) {
            $error = ' برجاء اكمال البيانات والتاكد من صحتها';
        }
        if (empty($error) && $pass == $pass1) {
            if ($pass == '') {
                $pass = $fetch['password'];
            } else {
                $pass = sha1($pass);
            }

            $update = $con->prepare("UPDATE login
            SET username=?,email=?,password=?
             WHERE id='1'");
            $update->execute(array($name, $email, $pass));
            $success = 'تم التعديل بنجاح';
            echo "<meta http-equiv='refresh' content='2;url=acount.php'>";
        }
    }
    ?>
            <div class='group-form' >
            <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">الاسم</label>
                    <input type="text" class="form-control" name='sitename' value='<?php if ($fetch) {echo $fetch['username'];}?>'
                     autocomplete="off" aria-describedby="emailHelp" placeholder="ادخل الاسم الجديد">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">الايميل</label>
                    <input type="email" class="form-control" name='email' value='<?php if ($fetch) {echo $fetch['email'];}?>'
                     autocomplete="off" aria-describedby="emailHelp" placeholder="ادخل الايميل الجديد">
                </div>
                <div class="form-group">
                    <label for="">كلمة السر</label>
                    <input type="password" class="form-control" name='pass' value=''  placeholder="ادخل كلمة السر الجديده">
                </div>
                <div class="form-group">
                    <label for="">تاكيد كلمة السر </label>
                    <input type="password" class="form-control" name='pass1' value=''  placeholder="تاكيد كلمة السر ">
                </div>

                 <?php
if (!empty($error)) {?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <?php }?>
        <?php
if (isset($success)) {?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $success; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <?php }?>

                <button type="submit" class="btn btn-primary">حفظ</button>
            </form>
            </div>
       <?php
include $temp . "footer.php";

} else {
    header('location:index.php');
}

?>

