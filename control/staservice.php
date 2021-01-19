<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    ?>
        <div class='group-form' >
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">رابط خدمة الغياب</label>
                <input type="text" class="form-control" name='textaddress'
                value='result/attanced.php'
                aria-describedby="emailHelp" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">رابط خدمة النتيجة</label>
                <input type="text" class="form-control" name='textaddress'
                value='result/result.php'
                aria-describedby="emailHelp" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">رابط خدمة اتصل بنا</label>
                <input type="text" class="form-control" name='textaddress'
                value='Contact/contact.php'
                aria-describedby="emailHelp" readonly>
            </div>
        </form>
        </div>
   <?php
include $temp . "footer.php";
} else {
    header("location:index.php");
}
?>