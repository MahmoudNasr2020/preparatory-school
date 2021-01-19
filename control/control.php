<?php
session_start();
session_regenerate_id();
if ($_SESSION['username']) {
    include "init.php";
    ?>
<div class='group-form'>
    <h3>لوحة التحكم </h3>
    <img src='layout/img/panal.png' class='img-control'>
</div>

<?php
include "include/templates/footer.php";
} else {
    header('location:index.php');
}
?>


