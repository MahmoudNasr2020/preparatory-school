<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    ?>
    <div class='group-form' >
    <a href='?action=add'><button type="button" class="btn btn-primary">اضافة سليدر</button></a>
    <a href='?action=show'><button type="button" class="btn btn-warning">اظهار الاسليدر</button></a>
    </div>
    <?php
if (@$_REQUEST['action'] == 'add') {?>

       <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $textaddress = filter_var(trim($_POST['textaddress']), FILTER_SANITIZE_STRING);
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $folder = 'layout/img/slider/' . $image;
            move_uploaded_file($tmp, $folder);
            $date = date("Y:m:d h:i:s");
            $error = '';
            if ($textaddress == '' || $image == '') {
                $error = 'برجاء عدم ترك حقول فارغة';
            }
            if (empty($error)) {
                $insert_silder = $con->prepare("INSERT INTO silder(adress,img,date) VALUES(?,?,?)");
                $insert_silder->execute(array($textaddress, $folder, $date));
                $sucess = 'تم الحفظ بنجاح سيتم توجيهك لصفحة الاسليدر';
                echo "<meta http-equiv='refresh' content='2;url=slider.php?action=show'>";
            }
        }?>
<div class='group-form' >
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <br><label for="exampleInputEmail1">عنوان الاسليدر</label>
        <input type="text" class="form-control" name='textaddress' value=''
        aria-describedby="emailHelp" placeholder="ادخل عنوان الاسليدر">
    </div>
    <div class="form-group">
        <label for="">الصورة</label><br>
        <input type="file"  name='image' value='' placeholder="ادخل الصورة">
    </div>
    <?php if (!empty($error)) {?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $error; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php }?>
<?php if (isset($sucess)) {?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $sucess; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
<?php }?>
    <button type="submit" class="btn btn-primary">حفظ</button><br>

</form>
</div>
        <?php }
    if (@$_REQUEST['action'] == 'show') {
        $select_slider = $con->prepare("SELECT * FROM silder");
        $select_slider->execute();
        $fetch_slider = $select_slider->fetch();
        if (@$_REQUEST['type'] == 'update') {
            $idupdate = $_GET['id'];
            $select_info = $con->prepare("SELECT * FROM silder WHERE id='$idupdate'");
            $select_info->execute();
            $fetch_info = $select_info->fetch();
            if ($idupdate == $fetch_info['id']) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $textaddressupdate = filter_var(trim($_POST['textaddressupdate']), FILTER_SANITIZE_STRING);
                    $imageupdate = $_FILES['imageupdate']['name'];
                    $tmpupdate = $_FILES['imageupdate']['tmp_name'];
                    $folderupdate = 'layout/img/slider/' . $imageupdate;
                    move_uploaded_file($tmpupdate, $folderupdate);
                    $error = '';
                    if ($textaddressupdate == '') {
                        $error = 'برجاء عدم ترك حقل فارغ';
                    }
                    if ($imageupdate == '') {
                        $folderupdate = $fetch_info['img'];
                    } else {
                        $folderupdate = 'layout/img/slider/' . $imageupdate;
                    }
                    if (empty($error)) {
                        $dateupdate = date("Y:m:d h:i:s");
                        $update_silder = $con->prepare("UPDATE silder
                                SET adress=?,img=?,date=?
                                WHERE id='$idupdate'");
                        $update_silder->execute(array($textaddressupdate, $folderupdate, $dateupdate));
                        $sucess_update = "تم التعديل بنجاح سيتم توجيهك لصفحة الاسليدر";
                        echo "<meta http-equiv='refresh' content='2;url=slider.php?action=show'>";
                    }
                }
                ?>
                        <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل عنوان الاسليدر </label>
                            <input type="text" class="form-control" name='textaddressupdate'
                            value='<?php echo $fetch_info['adress']; ?>'
                            aria-describedby="emailHelp" placeholder="ادخل عنوان الاسليدر">
                        </div>
                        <div class="form-group">
                            <label for="">الصورة</label><br>
                            <input type="file"  name='imageupdate' value='' placeholder="ادخل الصورة">
                        </div>
                        <?php if (!empty($error)) {?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }?>
                       <?php if (isset($sucess_update)) {?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $sucess_update; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }?>
                        <button type="submit" class="btn btn-success">تعديل</button><br>

                    </form>
                    </div>

               <?php }
        }
        /***********************الحذف********************************************* */
        if (@$_REQUEST['type'] == 'delete') {
            $iddelete = $_GET['id'];
            $select_info = $con->prepare("SELECT * FROM silder WHERE id='$iddelete'");
            $select_info->execute();
            $fetch_info = $select_info->fetch();
            if ($iddelete == $fetch_info['id']) {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $textaddressdel = filter_var(trim($_POST['textaddressdel']), FILTER_SANITIZE_STRING);

                    $error = '';
                    if (empty($error)) {
                        $update_silder = $con->prepare("DELETE FROM silder
                                WHERE id='$iddelete'");
                        $update_silder->execute();
                        $sucess_del = " تم الحذف بنجاح سيتم توجيهك لصفحة الاسليدر";
                        echo "<meta http-equiv='refresh' content='2;url=slider.php?action=show'>";
                    }
                }
                ?>
                        <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> حذف الاسليدر </label>
                            <input type="text" class="form-control" name='textaddressdel'
                            value='<?php echo $fetch_info['adress']; ?>'
                            aria-describedby="emailHelp" placeholder="ادخل عنوان الاسليدر">
                        </div>
                        <div class="form-group">

                            <input type="hidden"  name='imagedel' value='' placeholder="ادخل الصورة" >
                        </div>
                        <?php if (!empty($error)) {?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }?>
                       <?php if (isset($sucess_del)) {?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $sucess_del; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }?>
                        <button type="submit" class="btn btn-danger">حذف</button><br>

                    </form>
                    </div>

               <?php }
        }
        while ($fetch_slider = $select_slider->fetch()) {?>
                      <div class='group-form'>
                      <br><div class="alert alert-primary" role="alert">
                         <p>عنوان الاسليدر : <?php echo $fetch_slider['adress']; ?></p>
                        <img src='<?php echo $fetch_slider['img']; ?>' class='img-silder'>
                        <p>التاريخ: <?php echo $fetch_slider['date']; ?></p>
                        <a href='?action=show&type=delete&id=<?php echo $fetch_slider['id'] ?>'><button type="button" class="btn btn-danger">حذف</button></a>
                        <a href='?action=show&type=update&id=<?php echo $fetch_slider['id'] ?>'><button type="button" class="btn btn-success">تعديل</button></a>
                        </div>
                      </div>
                        <?php }
        ?>
      <?php

    }

    include $temp . "footer.php";

} else {
    header("location:index.php");
}
?>