<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    ?>
    <div class='group-form'>
        <a href='?action=third'><div class='btn btn-danger'>الصف الثالث </div></a>
        <a href='?action=second'><div class='btn btn-info'>الصف الثاني </div></a>
        <a href='?action=first'><div class='btn btn-primary'>الصف الاول </div></a>
    </div>
    <?php
if (@$_REQUEST['action'] == 'first') {
        $select = $con->prepare("SELECT * FROM goals WHERE id=1");
        $select->execute();
        $fetch = $select->fetch();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $textaddress = filter_var(trim($_POST['textaddress']), FILTER_SANITIZE_STRING);
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $folder = 'layout/img/goals/' . $image;
            move_uploaded_file($tmp, $folder);
            $error = '';
            if ($textaddress == '' || $text == '') {
                $error = 'برجاء عدم ترك حقول فارغة';
            }
            if (empty($error)) {
                if ($image == '') {
                    $folder = $fetch['img'];
                } else {
                    $folder = "layout/img/goals/" . $image;
                }
                $update = $con->prepare("UPDATE goals SET address=?,text=?,img=? WHERE id=1");
                $update->execute(array($textaddress, $text, $folder));
                $success = 'تم التعديل بنجاح';
                echo "<meta http-equiv='refresh' content='2;url=?action=first'>";
            }
        }?>
    <div class='group-form' >
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <br><label for="exampleInputEmail1">عنوان النص</label>
                <input type="text" class="form-control" name='textaddress'
                value='<?php if (isset($fetch)) {
            echo $fetch['address'];
        }?>'
                aria-describedby="emailHelp" placeholder="ادخل عنوان النص">
            </div>
            <div class="form-group">
                <label for="">النص</label><br>
                <textarea name='text'><?php if (isset($fetch)) {
            echo $fetch['text'];
        }?></textarea>
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
            <button type="submit" class="btn btn-primary">حفظ</button><br>
            <br><div class="alert alert-primary" role="alert">
                        <p><strong> عنوان النص : </strong><?php echo $fetch['address']; ?></p>
                        <p><strong>  النص : </strong><?php echo $fetch['text']; ?></p>
                        <img src='<?php echo $fetch['img']; ?>' class='img-silder'>
                    </div>
        </form>
        </div>
<?php
}

    if (@$_REQUEST['action'] == 'second') {
        $select2 = $con->prepare("SELECT * FROM goals WHERE id=2");
        $select2->execute();
        $fetch2 = $select2->fetch();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $textaddress = filter_var(trim($_POST['textaddress']), FILTER_SANITIZE_STRING);
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $folder = 'layout/img/goals/' . $image;
            move_uploaded_file($tmp, $folder);
            $error = '';
            if ($textaddress == '' || $text == '') {
                $error = 'برجاء عدم ترك حقول فارغة';
            }
            if (empty($error)) {
                if ($image == '') {
                    $folder = $fetch2['img'];
                } else {
                    $folder = "layout/img/goals/" . $image;
                }
                $update = $con->prepare("UPDATE goals SET address=?,text=?,img=? WHERE id=2");
                $update->execute(array($textaddress, $text, $folder));
                $success = 'تم التعديل بنجاح';
                echo "<meta http-equiv='refresh' content='2;url=?action=second'>";
            }
        }?>
    <div class='group-form'>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <br><label for="exampleInputEmail1">عنوان النص</label>
                <input type="text" class="form-control" name='textaddress'
                value='<?php if (isset($fetch2)) {
            echo $fetch2['address'];
        }?>'
                aria-describedby="emailHelp" placeholder="ادخل عنوان النص">
            </div>
            <div class="form-group">
                <label for="">النص</label><br>
                <textarea name='text'><?php if (isset($fetch2)) {
            echo $fetch2['text'];
        }?></textarea>
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
            <button type="submit" class="btn btn-primary">حفظ</button><br>
            <br><div class="alert alert-primary" role="alert">
                        <p><strong> عنوان النص : </strong><?php echo $fetch2['address']; ?></p>
                        <p><strong>  النص : </strong><?php echo $fetch2['text']; ?></p>
                        <img src='<?php echo $fetch2['img']; ?>' class='img-silder'>
                    </div>
        </form>
        </div>
<?php
}
    if (@$_REQUEST['action'] == 'third') {
        $select3 = $con->prepare("SELECT * FROM goals WHERE id=3");
        $select3->execute();
        $fetch3 = $select3->fetch();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $textaddress = filter_var(trim($_POST['textaddress']), FILTER_SANITIZE_STRING);
            $text = filter_var(trim($_POST['text']), FILTER_SANITIZE_STRING);
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $folder = 'layout/img/goals/' . $image;
            move_uploaded_file($tmp, $folder);
            $error = '';
            if ($textaddress == '' || $text == '') {
                $error = 'برجاء عدم ترك حقول فارغة';
            }
            if (empty($error)) {
                if ($image == '') {
                    $folder = $fetch3['img'];
                } else {
                    $folder = "layout/img/goals/" . $image;
                }
                $update = $con->prepare("UPDATE goals SET address=?,text=?,img=? WHERE id=3");
                $update->execute(array($textaddress, $text, $folder));
                $success = 'تم التعديل بنجاح';
                echo "<meta http-equiv='refresh' content='2;url=?action=third'>";
            }
        }?>
    <div class='group-form' >
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <br><label for="exampleInputEmail1">عنوان النص</label>
                <input type="text" class="form-control" name='textaddress'
                value='<?php if (isset($fetch3)) {
            echo $fetch3['address'];
        }?>'
                aria-describedby="emailHelp" placeholder="ادخل عنوان النص">
            </div>
            <div class="form-group">
                <label for="">النص</label><br>
                <textarea name='text'><?php if (isset($fetch3)) {
            echo $fetch3['text'];
        }?></textarea>
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
            <button type="submit" class="btn btn-primary">حفظ</button><br>
            <br><div class="alert alert-primary" role="alert">
                        <p><strong> عنوان النص : </strong><?php echo $fetch3['address']; ?></p>
                        <p><strong>  النص : </strong><?php echo $fetch3['text']; ?></p>
                        <img src='<?php echo $fetch3['img']; ?>' class='img-silder'>
                    </div>
        </form>
        </div>
<?php
}
    include "include/templates/footer.php";

} else {
    header("location:index.php");
}
?>
