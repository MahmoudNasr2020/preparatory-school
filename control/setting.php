<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = filter_var(trim($_POST['sitename']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $number = filter_var(trim($_POST['number']), FILTER_SANITIZE_NUMBER_INT);
        $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
        $status = filter_var(trim($_POST['status']), FILTER_SANITIZE_NUMBER_INT);
        $error = '';
        if ($name == '' || $email == '' || $number == '' || $address == '' || $status == '') {
            $error = ' برجاء اكمال البيانات وعدم ترك حقل فارغ';
        }
        if ($email == false) {
            $error = 'برجاء ادخال ايميل صالح';
        }
        if ($error == '') {
            $update = $con->prepare("UPDATE settingsite
            SET sitename=?,email=?,number=?,address=?,status=?
             WHERE siteid='1'");
            $update->execute(array($name, $email, $number, $address, $status));
            $success = 'تم التعديل بنجاح';
            echo "<meta http-equiv='refresh' content='2;url=setting.php'>";
        }
    }
    $select = $con->prepare("SELECT * FROM settingsite WHERE siteid='1'");
    $select->execute();
    $fetch = $select->fetch();?>
            <div class='group-form' >
            <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الموقع</label>
                    <input type="text" class="form-control" name='sitename' value='<?php if (isset($fetch)) {
        echo $fetch['sitename'];
    }?>'  aria-describedby="emailHelp" placeholder="ادخل اسم الموقع">
                </div>
                <div class="form-group">
                    <label for="">الايميل</label>
                    <input type="email" class="form-control" name='email' value='<?php if (isset($fetch)) {
        echo $fetch['email'];
    }?>'  placeholder="ادخل الايميل">
                </div>
                <div class="form-group">
                    <label for="">الرقم</label>
                    <input type="number" class="form-control" name='number'  value='<?php if (isset($fetch)) {
        echo $fetch['number'];
    }?>' placeholder="ادخل الرقم">
                </div>
                <div class="form-group">
                    <label for="">العنوان</label>
                    <input type="text" class="form-control" name='address' value='<?php if (isset($fetch)) {
        echo $fetch['address'];
    }?>' placeholder="ادخل العنوان">
                </div>
                <?php
if (isset($fetch)) {
        if ($fetch['status'] == 1) {?>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">حالة الموقع</label>
                                <select class="form-control" id="exampleFormControlSelect1" name='status'>
                                    <option value=1>مفتوح</option>
                                    <option value=2>مغلق</option>
                                </select>
                            </div>
                        <?php } else {?>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">حالة الموقع</label>
                                <select class="form-control" id="exampleFormControlSelect1" name='status'>
                                <option value=2>مغلق</option>
                                    <option value=1>مفتوح</option>
                                </select>
                            </div>
                        <?php }
    }?>
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

