<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    $select = $con->prepare("SELECT * FROM version WHERE id=1");
    $select->execute();
    $fetch = $select->fetch();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $textaddress = filter_var(trim($_POST['textaddress']), FILTER_SANITIZE_STRING);
        $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        $folder = 'layout/img/versionschool/' . $image;
        move_uploaded_file($tmp, $folder);
        $error = '';
        if ($textaddress == '' || $text == '') {
            $error = 'برجاء عدم ترك حقول فارغة';
        }
        if (empty($error)) {

            if ($image == '') {
                $folder = $fetch['img'];
            } else {
                $folder = "layout/img/versionschool/" . $image;
            }
            $update = $con->prepare("UPDATE version SET textaddress=?,text=?,img=?");
            $update->execute(array($textaddress, $text, $folder));
            $success = 'تم التعديل بنجاح';
            echo "<meta http-equiv='refresh' content='2;url=about-school.php'>";
        }
    }
    ?>
        <div class='group-form' >
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">عنوان النص</label>
                <input type="text" class="form-control" name='textaddress' value='<?php if (isset($fetch)) {echo $fetch['textaddress'];}?>'  aria-describedby="emailHelp" placeholder="ادخل اسم الموقع">
            </div>
            <div class="form-group">
                <label for="">النص</label><br>
                <textarea name='text'><?php if (isset($fetch)) {echo $fetch['text'];}?></textarea>
            </div>
            <div class="form-group">
                <label for="">الصورة</label><br>
                <input type="file"  name='image' value='' placeholder="ادخل الصورة">
            </div>
            <?php
if (!empty($error)) {?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php }
    ?>
            <?php
if (isset($success)) {?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $success; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php }
    ?>
            <button type="submit" class="btn btn-primary">حفظ</button><br>
            <br><div class="alert alert-primary" role="alert">
                        <p><strong>عنوان النص : </strong><?php echo $fetch['textaddress']; ?></p>
                        <p><strong> النص : </strong><?php echo $fetch['text']; ?></p>
                        <img src='<?php echo $fetch['img']; ?>' class='img-silder'>
                    </div>
        </form>
        </div>
   <?php
include $temp . "footer.php";
} else {
    header("location:index.php");
}
?>
