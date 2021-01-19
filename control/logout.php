<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    session_unset();
    session_destroy();
    header('location:index.php');
}
