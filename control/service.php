<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    ?>
           <div class='group-form' >
            <a href='?action=add'><button type="button" class="btn btn-primary">اضافة خدمة</button></a>
            <a href='?action=show'><button type="button" class="btn btn-warning">عرض الخدمات</button></a>
        </div>
        <?php
if (@$_REQUEST['action'] == 'add') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $addressnews = filter_var(trim($_POST['addressnews']), FILTER_SANITIZE_STRING);
            $news = filter_var(trim($_POST['news']), FILTER_SANITIZE_STRING);
            $image = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $folder = 'layout/img/service/' . $image;
            move_uploaded_file($tmp, $folder);
            $error = '';
            if ($addressnews == '' || $news == '' || $image == '') {
                $error = 'برجاء عدم ترك حقول فارغة';
            }
            if (empty($error)) {
                $insert = $con->prepare("INSERT INTO service(adressnews,news,img) VALUES(?,?,?)");
                $insert->execute(array($addressnews, $news, $folder));
                $success = 'تم الحفظ بنجاح سيتم توجيهك لصفحة الخدمات';
                echo "<meta http-equiv='refresh' content='2;url=service.php?action=show'>";
            }
        }
        ?>
            <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1">عنوان الخدمة</label>
                        <input type="text" class="form-control" name='addressnews'
                        value='<?php if (!empty($addressnews)) {echo $addressnews;}?>'
                        aria-describedby="emailHelp" placeholder="ادخل عنوان الخدمة">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> رابط موقع الخدمة</label>
                        <input type="text" class="form-control" name='news'
                        value='<?php if (!empty($news)) {echo $news;}?>'
                        aria-describedby="emailHelp" placeholder="ادخل رابط موقع الخدمة">
                    </div>
                    <div class="form-group">
                        <label for="">ارفع الصورة</label><br>
                        <input type="file"  name='image' value='' placeholder="ارفع الصورة">
                    </div>
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

                    <button type="submit" class="btn btn-primary">حفظ</button><br>
                </form>
            </div>
          <?php }
    ?>
    <?php
if (@$_REQUEST['action'] == 'show') {
        $select = $con->prepare("SELECT * FROM service");
        $select->execute();
        $fetch = $select->fetch();
        if (@$_REQUEST['type'] == 'edit') {
            $idupdate = $_GET['id'];
            $selupdate = $con->prepare("SELECT * FROM service WHERE id='$idupdate'");
            $selupdate->execute();
            $fetchupdate = $selupdate->fetch();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $updateaddressnews = filter_var(trim($_POST['updateaddressnews']), FILTER_SANITIZE_STRING);
                $updatenews = filter_var(trim($_POST['updatenews']), FILTER_SANITIZE_STRING);
                $updateimage = $_FILES['updateimage']['name'];
                $tmp = $_FILES['updateimage']['tmp_name'];
                $folder = 'layout/img/service/' . $updateimage;
                move_uploaded_file($tmp, $folder);
                $errorupdate = '';
                if ($updateaddressnews == '' || $updatenews == '') {
                    $errorupdate = 'برجاء تعديل الحقل وعدم ترك حقول فارغة';
                }
                if ($updateimage == '') {
                    $folder = $fetchupdate['img'];
                } else {
                    $folder = 'layout/img/service/' . $updateimage;
                }
                if (empty($errorupdate)) {
                    $updatesql = $con->prepare("UPDATE service
                    SET adressnews=?,news=?,img=?
                     WHERE id='$idupdate'");
                    $updatesql->execute(array($updateaddressnews, $updatenews, $folder));
                    $success_update = "تم التعديل بنجاح سيتم تحويلك لصفحة الخدمات";
                    echo "<meta http-equiv='refresh' content='2;url=service.php?action=show'>";
                }
            }
            if ($idupdate = $fetchupdate['id']) {?>
                   <div class='group-form' >
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <br><label for="exampleInputEmail1"> تعديل عنوان الخدمة </label>
                                <input type="text" class="form-control" name='updateaddressnews'
                                value='<?php echo $fetchupdate['adressnews']; ?>'
                                aria-describedby="emailHelp" placeholder="عدل عنوان الخدمة">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">تعديل الرابط</label>
                                <input type="text" class="form-control" name='updatenews'
                                value='<?php echo $fetchupdate['news']; ?>'
                                aria-describedby="emailHelp" placeholder="عدل الرابط">
                            </div>
                            <div class="form-group">
                                <label for=""> تعديل الصورة</label><br>
                                <input type="file"  name='updateimage' value='' placeholder="تعديل الصورة">
                            </div>
                            <?php
if (!empty($errorupdate)) {?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><?php echo $errorupdate; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }
                ?>
                            <?php
if (isset($success_update)) {?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><?php echo $success_update; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }
                ?>
                            <button type="submit" class="btn btn-success">تعديل</button><br>
                        </form>
                    </div>
               <?php }
        }
        if (@$_REQUEST['type'] == 'delete') {
            $iddel = $_GET['id'];
            $seldel = $con->prepare("SELECT * FROM service WHERE id='$iddel'");
            $seldel->execute();
            $fetchdel = $seldel->fetch();
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $delenews = filter_var(trim($_POST['delenews']), FILTER_SANITIZE_STRING);
                $errordel = '';
                if ($delenews == '') {
                    $errordel = 'برجاء عدم ترك الحقل فارغ';
                }
                if (empty($errordel)) {
                    $delsql = $con->prepare("DELETE FROM service WHERE id='$iddel'");
                    $delsql->execute();
                    $success_del = "تم الحذف بنجاح سيتم تحويلك لصفحة الخدمات";
                    echo "<meta http-equiv='refresh' content='2;url=service.php?action=show'>";
                }
            }
            if ($iddel = $fetchdel['id']) {?>
                   <br><div class='group-form' >
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">حذف الخدمة</label>
                                <input type="text" class="form-control" name='delenews'
                                value='<?php echo $fetchdel['adressnews']; ?>'
                                aria-describedby="emailHelp" placeholder="حذف الخدمة">
                            </div>
                            <?php
if (!empty($errordel)) {?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><?php echo $errordel; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }
                ?>
                            <?php
if (isset($success_del)) {?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><?php echo $success_del; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }
                ?>
                            <button type="submit" class="btn btn-danger">حذف</button><br>
                        </form>
                    </div>
               <?php }
        }
        while ($fetch = $select->fetch()) {?>
            <br><div class='group-form'>
                <div class="alert alert-primary" role="alert">
                    <p><strong>عنوان الخدمة</strong> : <?php echo $fetch['adressnews']; ?></p>
                    <p><?php echo $fetch['news']; ?><strong> : رابط الخدمة</strong></p>
                    <img src='<?php echo $fetch['img']; ?>' class='img-silder'><br>
                    <a href='?action=show&type=delete&id=<?php echo $fetch["id"]; ?>'>
                    <br><div class='btn btn-danger'>حذف</div></a>
                    <a href='?action=show&type=edit&id=<?php echo $fetch["id"]; ?>'>
                    <div class='btn btn-success'>تعديل</div></a>
                </div>
            </div>
        <?php }
    }
    ?>
    <?php
include $temp . "footer.php";

} else {
    header("location:index.php");
}
?>
