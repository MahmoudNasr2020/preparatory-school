<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $facebook = filter_var(trim($_POST['facebook']), FILTER_SANITIZE_STRING);
        $tweet = filter_var(trim($_POST['tweet']), FILTER_SANITIZE_STRING);
        $youtube = filter_var(trim($_POST['youtube']), FILTER_SANITIZE_STRING);
        $instagram = filter_var(trim($_POST['instagram']), FILTER_SANITIZE_STRING);
        $error = '';
        if ($error == '') {
            $update = $con->prepare("UPDATE social
            SET facebook=?,tweet=?,youtube=?,instagram=?
             WHERE id='1'");
            $update->execute(array($facebook, $tweet, $youtube, $instagram));
            $success = 'تم التعديل بنجاح';
            echo "<meta http-equiv='refresh' content='2;url=social.php'>";
        }
    }
    $select = $con->prepare("SELECT * FROM social WHERE id='1'");
    $select->execute();
    $fetch = $select->fetch();?>
            <div class='group-form' >
            <form method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">فيس بوك</label>
                    <input type="text" class="form-control" name='facebook' value='<?php if (isset($fetch)) {
        echo $fetch['facebook'];
    }?>'  aria-describedby="emailHelp" placeholder="ادخل لينك الموقع">
                </div>
                <div class="form-group">
                    <label for="">تويتر</label>
                    <input type="text" class="form-control" name='tweet' value='<?php if (isset($fetch)) {
        echo $fetch['tweet'];
    }?>'  placeholder="ادخل لينك الموقع">
                </div>
                <div class="form-group">
                    <label for="">اليوتيوب</label>
                    <input type="text" class="form-control" name='youtube'  value='<?php if (isset($fetch)) {
        echo $fetch['youtube'];
    }?>' placeholder="ادخل لينك الموقع">
                </div>
                <div class="form-group">
                    <label for="">الانستغرام</label>
                    <input type="text" class="form-control" name='instagram' value='<?php if (isset($fetch)) {
        echo $fetch['instagram'];
    }?>' placeholder="ادخل لينك الموقع">
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

