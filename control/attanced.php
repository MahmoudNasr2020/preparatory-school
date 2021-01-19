<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    ?>
    <div class='group-form' >
        <a href='?action=third'><button type="button" class="btn btn-primary"> غياب الصف الثالث</button></a>
        <a href='?action=second'><button type="button" class="btn btn-info"> غياب الصف الثاني</button></a>
        <a href='?action=first'><button type="button" class="btn btn-danger"> غياب الصف الاول</button></a>
    </div>
    <?php
if (@$_REQUEST['action'] == 'first') {?>
             <div class='group-form'>
             <br><a href='?action=first&type=addclass'><button type="button" class="btn btn-primary"> ادخال فصل جديد</button></a>
             <a href='?action=first&type=showclass'><button type="button" class="btn btn-warning">اظهار الفصول</button></a>
             </div>
        <?php
if (@$_REQUEST['type'] == 'addclass') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $classname = filter_var(trim($_POST['class']), FILTER_SANITIZE_STRING);
            $error = '';
            if ($classname == '') {
                $error = 'يجب ادخال رقم الفصل';
            }
            if (empty($error)) {
                $insertclass = $con->prepare("INSERT INTO classatt1(classnumber) VALUES(?)");
                $insertclass->execute(array($classname));
                $success = 'تم الحفظ بنجاح سيتم توجيهك لصفحة الفصول';
                echo "<meta http-equiv='refresh' content='2;url=?action=first&type=showclass'>";
            }
        }
        ?>
                <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1">رقم الفصل</label>
                            <input type="text" class="form-control" name='class'
                            value=''
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
        if (@$_REQUEST['type'] == 'showclass') {
            $selectclass = $con->prepare("SELECT * FROM classatt1");
            $selectclass->execute();
            $fetchclass = $selectclass->fetchAll();
            if (@$_REQUEST['work'] == 'edit') {
                $idnum = $_GET['id'];
                $updateclassfirst = $con->prepare("SELECT * FROM classatt1 WHERE id='$idnum'");
                $updateclassfirst->execute();
                $fetchclassupdate = $updateclassfirst->fetch();
                if ($idnum == $fetchclassupdate['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $classnameupdate = filter_var(trim($_POST['classupdate']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($classnameupdate == '') {
                            $error = 'يجب ادخال رقم الفصل';
                        }
                        if (empty($error)) {
                            $updateclass = $con->prepare("UPDATE classatt1 SET classnumber=? WHERE id= $idnum");
                            $updateclass->execute(array($classnameupdate));
                            $success = 'تم التعديل بنجاح سيتم توجيهك لصفحة الفصول';
                            echo "<meta http-equiv='refresh' content='2;url=?action=first&type=showclass'>";
                        }
                    }
                    ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل رقم الفصل </label>
                            <input type="text" class="form-control" name='classupdate'
                            value='<?php if (isset($fetchclass)) {echo $fetchclassupdate['classnumber'];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
            <?php }

            }
            if (@$_REQUEST['work'] == 'delete') {
                $idnum = $_GET['id'];
                $delclassfirst = $con->prepare("SELECT * FROM classatt1 WHERE id='$idnum'");
                $delclassfirst->execute();
                $fetchclassdel = $delclassfirst->fetch();
                if ($idnum == $fetchclassdel['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $classdel = filter_var(trim($_POST['classdel']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($classdel == '') {
                            $error = 'يجب ادخال رقم الفصل للحذف';
                        }
                        if (empty($error)) {
                            $delclass = $con->prepare("DELETE FROM classatt1 WHERE id= $idnum");
                            $delclass->execute();
                            $success = 'تم الحذف بنجاح سيتم توجيهك لصفحة الفصول';
                            echo "<meta http-equiv='refresh' content='2;url=?action=first&type=showclass'>";
                        }
                    }
                    ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> حذف رقم الفصل </label>
                            <input type="text" class="form-control" name='classdel'
                            value='<?php if (isset($fetchclass)) {echo $fetchclassdel['classnumber'];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
                        <button type="submit" class="btn btn-danger">حذف</button><br>
                    </form>
            </div>
            <?php }

            }
            if (@$_REQUEST['work'] == 'insert') {
                $idnum = $_GET['classid'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $namestd = filter_var(trim($_POST['namestd']), FILTER_SANITIZE_STRING);
                    $numberstd = filter_var(trim($_POST['numberstd']), FILTER_SANITIZE_STRING);
                    $degree_arabic1 = filter_var(trim($_POST['degree_arabic1']), FILTER_SANITIZE_STRING);
                    $error = '';
                    if ($namestd == '' || $numberstd == '' || $degree_arabic1 == '') {
                        $error = 'يجب اكمال الحقول كامله';
                    }
                    if (empty($error)) {
                        $insertstd1 = $con->prepare("INSERT INTO
                     studentatt(idnumber,name,numberatt,classnumber)
                        VALUES(?,?,?,?)");
                        $insertstd1->execute(array($numberstd, $namestd, $degree_arabic1, $idnum));
                        $success = ' تم اضافة الطالب بنجاح سيتم تحويلك لصفحة الطلاب';
                        echo "<meta http-equiv='refresh' content='2;url=?action=first&work=showstd&classid=$idnum'>";
                    }

                }
                ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                    <?php
if (!empty($error)) {?>
                        <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $error; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                ?>
                <?php
if (isset($success)) {?>
                        <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $success; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                ?>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1">اسم الطالب </label>
                            <input type="text" class="form-control" name='namestd'
                            value='<?php if (!empty($namestd)) {echo $namestd;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> رقم الجلوس </label>
                            <input type="text" class="form-control" name='numberstd'
                            value='<?php if (!empty($numberstd)) {echo $numberstd;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> عدد ايام الغياب </label>
                            <input type="text" class="form-control" name='degree_arabic1'
                            value='<?php if (!empty($degree_arabic1)) {echo $degree_arabic1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة عدد ايام الغياب">
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ</button><br>
                    </form>
            </div>
            <?php

            }
            /****************************uploade first**********************
             * ****************************************************** */
            if (@$_REQUEST['work'] == 'upload') {
                $idnum = $_GET['classid'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $file = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $exe = array('csv');
                    $found = @end(explode('.', $file));
                    $error = '';
                    if (in_array($found, $exe) == false) {
                        $error = 'نوع الملف غير صالح';
                    } else {
                        $handel = fopen($file_tmp, 'r');
                        while ($data = fgetcsv($handel)) {
                            $item1 = $data[0];
                            $item2 = $data[1];
                            $item3 = $data[2];
                            $uplode = $con->prepare("INSERT INTO studentatt(idnumber,name,numberatt,classnumber) VALUES(?,?,?,?)");
                            $uplode->execute(array($item1, $item2, $item3, $idnum));
                            $success = ' تم اضافة الملف بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=first&work=showstd&classid=$idnum'>";
                        }

                    }
                }
                ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> رفع الملف </label>
                            <input type="file" class="form-control" name='file'
                            value=''
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
                        </div>
                        <button type="submit" class="btn btn-primary">رفع</button><br>
                        <?php
if (!empty($error)) {?>
                                <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><?php echo $error; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                           <?php }
                ?>
                        <?php
if (isset($success)) {?>
                                <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><?php echo $success; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                           <?php }
                ?>
                    </form>
            </div>
            <?php }

            /***************************
             * ****************************** */

            foreach ($fetchclass as $class) {?>
                    <br><div class='group-form'>
                            <div class="alert alert-primary" role="alert">
                                <p><strong>رقم الفصل</strong> : <?php echo $class['classnumber']; ?></p>
                                <a href='?action=first&type=showclass&work=delete&id=<?php echo $class['id']; ?>'>
                                <br><div class='btn btn-danger'>حذف</div></a>
                                <a href='?action=first&type=showclass&work=edit&id=<?php echo $class['id']; ?>'>
                                <div class='btn btn-success'>تعديل</div></a>
                                <a href='?action=first&type=showclass&work=upload&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-dark'>رفع الغياب</div></a>
                                <a href='?action=first&type=showclass&work=insert&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-info'>ادخال طالب</div></a>
                                <a href='?action=first&work=showstd&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-primary'>عرض الطلاب</div></a>
                            </div>
                         </div>
                <?php }
        }
        if (@$_REQUEST['work'] == 'showstd') {
            $classid = $_GET['classid'];
            $selectstd1 = $con->prepare("SELECT * FROM studentatt WHERE classnumber=$classid");
            $selectstd1->execute();
            $fetchstd1 = $selectstd1->fetchAll();
            if (@$_REQUEST['workstd'] == 'edit') {
                $idnumber = $_GET['id'];
                $selectres1 = $con->prepare("SELECT * FROM studentatt WHERE id=$idnumber");
                $selectres1->execute();
                $fetchstdres1 = $selectres1->fetch();
                if ($idnumber == $fetchstdres1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestdupdate = filter_var(trim($_POST['namestdupdate']), FILTER_SANITIZE_STRING);
                        $numberstdupdate = filter_var(trim($_POST['numberstdupdate']), FILTER_SANITIZE_STRING);
                        $degreeupdate_arabic1 = filter_var(trim($_POST['degreeupdate_arabic1']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestdupdate == '' || $numberstdupdate == '' || $degreeupdate_arabic1 == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("UPDATE studentatt
                        SET idnumber=?,name=?,numberatt=?
                        WHERE id=$idnumber");
                            $updatestd1->execute(array($numberstdupdate, $namestdupdate, $degreeupdate_arabic1));
                            $success = ' تم التعديل  بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=first&work=showstd&classid=$fetchstdres1[classnumber]'>";
                        }
                    }

                    ?>
                    <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                    <?php
if (!empty($error)) {?>
                        <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $error; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>
                <?php
if (isset($success)) {?>
                        <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $success; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل اسم الطالب </label>
                            <input type="text" class="form-control" name='namestdupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["name"];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تعديل رقم الجلوس </label>
                            <input type="text" class="form-control" name='numberstdupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["idnumber"];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> عدد ايام الغياب</label>
                            <input type="text" class="form-control" name='degreeupdate_arabic1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["numberatt"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل عدد ايام الغياب ">
                        </div>
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
               <?php }
                ?>

        <?php }
            if (@$_REQUEST['workstd'] == 'delete') {
                $idnumber = $_GET['id'];
                $selectresdel1 = $con->prepare("SELECT * FROM studentatt WHERE id=$idnumber");
                $selectresdel1->execute();
                $fetchstdresdel1 = $selectresdel1->fetch();
                if ($idnumber == $fetchstdresdel1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestddel = filter_var(trim($_POST['namestddel']), FILTER_SANITIZE_STRING);
                        $numberstdel = filter_var(trim($_POST['numberstdel']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestddel == '' || $numberstdel == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("DELETE FROM studentatt WHERE id=$idnumber");
                            $updatestd1->execute();
                            $success = ' تم الحذف  بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=first&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
                        }
                    }

                    ?>
                <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1"> حذف اسم الطالب </label>
                        <input type="text" class="form-control" name='namestddel'
                        value='<?php if (isset($fetchstdresdel1)) {echo $fetchstdresdel1["name"];}?>'
                        aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">حذف رقم الجلوس </label>
                        <input type="text" class="form-control" name='numberstdel'
                        value='<?php if (isset($fetchstdresdel1)) {echo $fetchstdresdel1["idnumber"];}?>'
                        aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                    </div>
                    <?php
if (!empty($error)) {?>
                    <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $error; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php }
                    ?>
            <?php
if (isset($success)) {?>
                    <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $success; ?></strong>
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
                ?>

    <?php }
            foreach ($fetchstd1 as $user) {?>
        <div class='group-form'>
              <br><div class="alert alert-primary" role="alert">
                 <p><strong>الاسم : </strong><?php echo $user['name']; ?></p>
                 <p><strong>رقم الجلوس : </strong><?php echo $user['idnumber']; ?></p>
                 <p><strong>رقم الفصل : </strong><?php echo $user['classnumber']; ?></p>
                 <p><strong>ايام الغياب : </strong><?php echo $user['numberatt']; ?></p>
                 <a href='?action=first&work=showstd&classid=<?php echo $user['classnumber']; ?>&id=<?php echo $user['id']; ?>&workstd=delete'>
                 <button type="button" class="btn btn-danger">حذف</button></a>
                 <a href='?action=first&work=showstd&classid=<?php echo $user['classnumber']; ?>&id=<?php echo $user['id']; ?>&workstd=edit'>
                 <button type="button" class="btn btn-success">تعديل</button></a>
                 </div>
              </div>
   <?php }
        }

    }
    ?>

<?php
/* -------------------------------------------------------------------------------------------
    الصف الثاني
    ---------------------------------------------------------------- --------------------------*/
    if (@$_REQUEST['action'] == 'second') {?>
             <div class='group-form'>
             <br><a href='?action=second&type=addclass'><button type="button" class="btn btn-primary"> ادخال فصل جديد</button></a>
             <a href='?action=second&type=showclass'><button type="button" class="btn btn-warning">اظهار الفصول</button></a>
             </div>
        <?php
if (@$_REQUEST['type'] == 'addclass') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $classname = filter_var(trim($_POST['class']), FILTER_SANITIZE_STRING);
            $error = '';
            if ($classname == '') {
                $error = 'يجب ادخال رقم الفصل';
            }
            if (empty($error)) {
                $insertclass = $con->prepare("INSERT INTO classatt2(classnumber) VALUES(?)");
                $insertclass->execute(array($classname));
                $success = 'تم الحفظ بنجاح سيتم توجيهك لصفحة الفصول';
                echo "<meta http-equiv='refresh' content='2;url=?action=second&type=showclass'>";
            }
        }
        ?>
                <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1">رقم الفصل</label>
                            <input type="text" class="form-control" name='class'
                            value=''
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
        if (@$_REQUEST['type'] == 'showclass') {
            $selectclass = $con->prepare("SELECT * FROM classatt2");
            $selectclass->execute();
            $fetchclass = $selectclass->fetchAll();
            if (@$_REQUEST['work'] == 'edit') {
                $idnum = $_GET['id'];
                $updateclassfirst = $con->prepare("SELECT * FROM classatt2 WHERE id='$idnum'");
                $updateclassfirst->execute();
                $fetchclassupdate = $updateclassfirst->fetch();
                if ($idnum == $fetchclassupdate['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $classnameupdate = filter_var(trim($_POST['classupdate']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($classnameupdate == '') {
                            $error = 'يجب ادخال رقم الفصل';
                        }
                        if (empty($error)) {
                            $updateclass = $con->prepare("UPDATE classatt2 SET classnumber=? WHERE id= $idnum");
                            $updateclass->execute(array($classnameupdate));
                            $success = 'تم التعديل بنجاح سيتم توجيهك لصفحة الفصول';
                            echo "<meta http-equiv='refresh' content='2;url=?action=second&type=showclass'>";
                        }
                    }
                    ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل رقم الفصل </label>
                            <input type="text" class="form-control" name='classupdate'
                            value='<?php if (isset($fetchclass)) {echo $fetchclassupdate['classnumber'];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
            <?php }

            }
            if (@$_REQUEST['work'] == 'delete') {
                $idnum = $_GET['id'];
                $delclassfirst = $con->prepare("SELECT * FROM classatt2 WHERE id='$idnum'");
                $delclassfirst->execute();
                $fetchclassdel = $delclassfirst->fetch();
                if ($idnum == $fetchclassdel['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $classdel = filter_var(trim($_POST['classdel']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($classdel == '') {
                            $error = 'يجب ادخال رقم الفصل للحذف';
                        }
                        if (empty($error)) {
                            $delclass = $con->prepare("DELETE FROM classatt2 WHERE id= $idnum");
                            $delclass->execute();
                            $success = 'تم الحذف بنجاح سيتم توجيهك لصفحة الفصول';
                            echo "<meta http-equiv='refresh' content='2;url=?action=second&type=showclass'>";
                        }
                    }
                    ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> حذف رقم الفصل </label>
                            <input type="text" class="form-control" name='classdel'
                            value='<?php if (isset($fetchclass)) {echo $fetchclassdel['classnumber'];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
                        <button type="submit" class="btn btn-danger">حذف</button><br>
                    </form>
            </div>
            <?php }

            }
            if (@$_REQUEST['work'] == 'insert') {
                $idnum = $_GET['classid'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $namestd = filter_var(trim($_POST['namestd']), FILTER_SANITIZE_STRING);
                    $numberstd = filter_var(trim($_POST['numberstd']), FILTER_SANITIZE_STRING);
                    $degree_arabic1 = filter_var(trim($_POST['degree_arabic1']), FILTER_SANITIZE_STRING);
                    $error = '';
                    if ($namestd == '' || $numberstd == '' || $degree_arabic1 == '') {
                        $error = 'يجب اكمال الحقول كامله';
                    }
                    if (empty($error)) {
                        $insertstd1 = $con->prepare("INSERT INTO
                     studentatt2(idnumber,name,numberatt,classnumber)
                        VALUES(?,?,?,?)");
                        $insertstd1->execute(array($numberstd, $namestd, $degree_arabic1, $idnum));
                        $success = ' تم اضافة الطالب بنجاح سيتم تحويلك لصفحة الطلاب';
                        echo "<meta http-equiv='refresh' content='2;url=?action=second&work=showstd&classid=$idnum'>";
                    }

                }
                ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                    <?php
if (!empty($error)) {?>
                        <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $error; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                ?>
                <?php
if (isset($success)) {?>
                        <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $success; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                ?>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1">اسم الطالب </label>
                            <input type="text" class="form-control" name='namestd'
                            value='<?php if (!empty($namestd)) {echo $namestd;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> رقم الجلوس </label>
                            <input type="text" class="form-control" name='numberstd'
                            value='<?php if (!empty($numberstd)) {echo $numberstd;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> عدد ايام الغياب </label>
                            <input type="text" class="form-control" name='degree_arabic1'
                            value='<?php if (!empty($degree_arabic1)) {echo $degree_arabic1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل ايام الغياب ">
                        </div>

                        <button type="submit" class="btn btn-primary">حفظ</button><br>
                    </form>
            </div>
            <?php

            }
            /****************************uploade first**********************
             * ****************************************************** */
            if (@$_REQUEST['work'] == 'upload') {
                $idnum = $_GET['classid'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $file = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $exe = array('csv');
                    $found = @end(explode('.', $file));
                    $error = '';
                    if (in_array($found, $exe) == false) {
                        $error = 'نوع الملف غير صالح';
                    } else {
                        $handel = fopen($file_tmp, 'r');
                        while ($data = fgetcsv($handel)) {
                            $item1 = $data[0];
                            $item2 = $data[1];
                            $item3 = $data[2];
                            $uplode = $con->prepare("INSERT INTO studentatt2(idnumber,name,numberatt,classnumber) VALUES(?,?,?,?)");
                            $uplode->execute(array($item1, $item2, $item3, $idnum));
                            $success = ' تم اضافة الملف بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=second&work=showstd&classid=$idnum'>";
                        }

                    }
                }
                ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> رفع الملف </label>
                            <input type="file" class="form-control" name='file'
                            value=''
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
                        </div>
                        <button type="submit" class="btn btn-primary">رفع</button><br>
                        <?php
if (!empty($error)) {?>
                                <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><?php echo $error; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                           <?php }
                ?>
                        <?php
if (isset($success)) {?>
                                <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><?php echo $success; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                           <?php }
                ?>
                    </form>
            </div>
            <?php }

            /***************************
             * ****************************** */
            foreach ($fetchclass as $class) {?>
                    <br><div class='group-form'>
                            <div class="alert alert-primary" role="alert">
                                <p><strong>رقم الفصل</strong> : <?php echo $class['classnumber']; ?></p>
                                <a href='?action=second&type=showclass&work=delete&id=<?php echo $class['id']; ?>'>
                                <br><div class='btn btn-danger'>حذف</div></a>
                                <a href='?action=second&type=showclass&work=edit&id=<?php echo $class['id']; ?>'>
                                <div class='btn btn-success'>تعديل</div></a>
                                <a href='?action=second&type=showclass&work=upload&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-dark'>رفع الغياب</div></a>
                                <a href='?action=second&type=showclass&work=insert&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-info'>ادخال طالب</div></a>
                                <a href='?action=second&work=showstd&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-primary'>عرض الطلاب</div></a>
                            </div>
                         </div>
                <?php }
        }
        if (@$_REQUEST['work'] == 'showstd') {
            $classid = $_GET['classid'];
            $selectstd1 = $con->prepare("SELECT * FROM studentatt2 WHERE classnumber=$classid");
            $selectstd1->execute();
            $fetchstd1 = $selectstd1->fetchAll();
            if (@$_REQUEST['workstd'] == 'edit') {
                $idnumber = $_GET['id'];
                $selectres1 = $con->prepare("SELECT * FROM studentatt2 WHERE id=$idnumber");
                $selectres1->execute();
                $fetchstdres1 = $selectres1->fetch();
                if ($idnumber == $fetchstdres1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestdupdate = filter_var(trim($_POST['namestdupdate']), FILTER_SANITIZE_STRING);
                        $numberstdupdate = filter_var(trim($_POST['numberstdupdate']), FILTER_SANITIZE_STRING);
                        $degreeupdate_arabic1 = filter_var(trim($_POST['degreeupdate_arabic1']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestdupdate == '' || $numberstdupdate == '' || $degreeupdate_arabic1 == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("UPDATE studentatt2
                        SET idnumber=?,name=?,numberatt=?
                        WHERE id=$idnumber");
                            $updatestd1->execute(array($numberstdupdate, $namestdupdate, $degreeupdate_arabic1));
                            $success = ' تم التعديل  بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=second&work=showstd&classid=$fetchstdres1[classnumber]'>";
                        }
                    }

                    ?>
                    <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                    <?php
if (!empty($error)) {?>
                        <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $error; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>
                <?php
if (isset($success)) {?>
                        <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $success; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل اسم الطالب </label>
                            <input type="text" class="form-control" name='namestdupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["name"];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تعديل رقم الجلوس </label>
                            <input type="text" class="form-control" name='numberstdupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["idnumber"];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> ايام الغياب </label>
                            <input type="text" class="form-control" name='degreeupdate_arabic1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["numberatt"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل عدد ايام الغياب ">
                        </div>
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
               <?php }
                ?>

        <?php }
            if (@$_REQUEST['workstd'] == 'delete') {
                $idnumber = $_GET['id'];
                $selectresdel1 = $con->prepare("SELECT * FROM studentatt2 WHERE id=$idnumber");
                $selectresdel1->execute();
                $fetchstdresdel1 = $selectresdel1->fetch();
                if ($idnumber == $fetchstdresdel1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestddel = filter_var(trim($_POST['namestddel']), FILTER_SANITIZE_STRING);
                        $numberstdel = filter_var(trim($_POST['numberstdel']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestddel == '' || $numberstdel == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("DELETE FROM studentatt2 WHERE id=$idnumber");
                            $updatestd1->execute();
                            $success = ' تم الحذف  بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=second&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
                        }
                    }

                    ?>
                <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1"> حذف اسم الطالب </label>
                        <input type="text" class="form-control" name='namestddel'
                        value='<?php if (isset($fetchstdresdel1)) {echo $fetchstdresdel1["name"];}?>'
                        aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">حذف رقم الجلوس </label>
                        <input type="text" class="form-control" name='numberstdel'
                        value='<?php if (isset($fetchstdresdel1)) {echo $fetchstdresdel1["idnumber"];}?>'
                        aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                    </div>
                    <?php
if (!empty($error)) {?>
                    <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $error; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php }
                    ?>
            <?php
if (isset($success)) {?>
                    <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $success; ?></strong>
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
                ?>

    <?php }
            foreach ($fetchstd1 as $user) {?>
        <div class='group-form'>
              <br><div class="alert alert-primary" role="alert">
                 <p><strong>الاسم : </strong><?php echo $user['name'] ?></p>
                 <p><strong>رقم الجلوس : </strong><?php echo $user['idnumber'] ?></p>
                 <p><strong>رقم الفصل : </strong><?php echo $user['classnumber'] ?></p>
                 <p><strong>ايام الغياب : </strong><?php echo $user['numberatt'] ?></p>
                 <a href='?action=second&work=showstd&classid=<?php echo $user['classnumber']; ?>&id=<?php echo $user['id']; ?>&workstd=delete'>
                 <button type="button" class="btn btn-danger">حذف</button></a>
                 <a href='?action=second&work=showstd&classid=<?php echo $user['classnumber']; ?>&id=<?php echo $user['id']; ?>&workstd=edit'>
                 <button type="button" class="btn btn-success">تعديل</button></a>
                 </div>
              </div>
   <?php }
        }

    }
    ?>
<?php
/* -------------------------------------------------------------------------------------------
    الصف الثالث
    ---------------------------------------------------------------- --------------------------*/
    if (@$_REQUEST['action'] == 'third') {?>
             <div class='group-form'>
             <br><a href='?action=third&type=addclass'><button type="button" class="btn btn-primary"> ادخال فصل جديد</button></a>
             <a href='?action=third&type=showclass'><button type="button" class="btn btn-warning">اظهار الفصول</button></a>
             </div>
        <?php
if (@$_REQUEST['type'] == 'addclass') {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $classname = filter_var(trim($_POST['class']), FILTER_SANITIZE_STRING);
            $error = '';
            if ($classname == '') {
                $error = 'يجب ادخال رقم الفصل';
            }
            if (empty($error)) {
                $insertclass = $con->prepare("INSERT INTO classatt3(classnumber) VALUES(?)");
                $insertclass->execute(array($classname));
                $success = 'تم الحفظ بنجاح سيتم توجيهك لصفحة الفصول';
                echo "<meta http-equiv='refresh' content='2;url=?action=third&type=showclass'>";
            }
        }
        ?>
                <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1">رقم الفصل</label>
                            <input type="text" class="form-control" name='class'
                            value=''
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
        if (@$_REQUEST['type'] == 'showclass') {
            $selectclass = $con->prepare("SELECT * FROM classatt3");
            $selectclass->execute();
            $fetchclass = $selectclass->fetchAll();
            if (@$_REQUEST['work'] == 'edit') {
                $idnum = $_GET['id'];
                $updateclassfirst = $con->prepare("SELECT * FROM classatt3 WHERE id='$idnum'");
                $updateclassfirst->execute();
                $fetchclassupdate = $updateclassfirst->fetch();
                if ($idnum == $fetchclassupdate['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $classnameupdate = filter_var(trim($_POST['classupdate']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($classnameupdate == '') {
                            $error = 'يجب ادخال رقم الفصل';
                        }
                        if (empty($error)) {
                            $updateclass = $con->prepare("UPDATE classatt3 SET classnumber=? WHERE id= $idnum");
                            $updateclass->execute(array($classnameupdate));
                            $success = 'تم التعديل بنجاح سيتم توجيهك لصفحة الفصول';
                            echo "<meta http-equiv='refresh' content='2;url=?action=third&type=showclass'>";
                        }
                    }
                    ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل رقم الفصل </label>
                            <input type="text" class="form-control" name='classupdate'
                            value='<?php if (isset($fetchclass)) {echo $fetchclassupdate['classnumber'];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
            <?php }

            }
            if (@$_REQUEST['work'] == 'delete') {
                $idnum = $_GET['id'];
                $delclassfirst = $con->prepare("SELECT * FROM classatt3 WHERE id='$idnum'");
                $delclassfirst->execute();
                $fetchclassdel = $delclassfirst->fetch();
                if ($idnum == $fetchclassdel['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $classdel = filter_var(trim($_POST['classdel']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($classdel == '') {
                            $error = 'يجب ادخال رقم الفصل للحذف';
                        }
                        if (empty($error)) {
                            $delclass = $con->prepare("DELETE FROM classatt3 WHERE id= $idnum");
                            $delclass->execute();
                            $success = 'تم الحذف بنجاح سيتم توجيهك لصفحة الفصول';
                            echo "<meta http-equiv='refresh' content='2;url=?action=third&type=showclass'>";
                        }
                    }
                    ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> حذف رقم الفصل </label>
                            <input type="text" class="form-control" name='classdel'
                            value='<?php if (isset($fetchclass)) {echo $fetchclassdel['classnumber'];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
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
                        <button type="submit" class="btn btn-danger">حذف</button><br>
                    </form>
            </div>
            <?php }

            }
            if (@$_REQUEST['work'] == 'insert') {
                $idnum = $_GET['classid'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $namestd = filter_var(trim($_POST['namestd']), FILTER_SANITIZE_STRING);
                    $numberstd = filter_var(trim($_POST['numberstd']), FILTER_SANITIZE_STRING);
                    $degree_arabic1 = filter_var(trim($_POST['degree_arabic1']), FILTER_SANITIZE_STRING);
                    $error = '';
                    if ($namestd == '' || $numberstd == '' || $degree_arabic1 == '') {
                        $error = 'يجب اكمال الحقول كامله';
                    }
                    if (empty($error)) {
                        $insertstd1 = $con->prepare("INSERT INTO
                     studentatt3(idnumber,name,numberatt,classnumber)
                        VALUES(?,?,?,?)");
                        $insertstd1->execute(array($numberstd, $namestd, $degree_arabic1, $idnum));
                        $success = ' تم اضافة الطالب بنجاح سيتم تحويلك لصفحة الطلاب';
                        echo "<meta http-equiv='refresh' content='2;url=?action=third&work=showstd&classid=$idnum'>";
                    }

                }
                ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                    <?php
if (!empty($error)) {?>
                        <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $error; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                ?>
                <?php
if (isset($success)) {?>
                        <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $success; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                ?>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1">اسم الطالب </label>
                            <input type="text" class="form-control" name='namestd'
                            value='<?php if (!empty($namestd)) {echo $namestd;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> رقم الجلوس </label>
                            <input type="text" class="form-control" name='numberstd'
                            value='<?php if (!empty($numberstd)) {echo $numberstd;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> عدد ايام الغياب </label>
                            <input type="text" class="form-control" name='degree_arabic1'
                            value='<?php if (!empty($degree_arabic1)) {echo $degree_arabic1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل ايام الغياب ">
                        </div>

                        <button type="submit" class="btn btn-primary">حفظ</button><br>
                    </form>
            </div>
            <?php

            }
            /****************************uploade third**********************
             * ****************************************************** */
            if (@$_REQUEST['work'] == 'upload') {
                $idnum = $_GET['classid'];
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $file = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];
                    $exe = array('csv');
                    $found = @end(explode('.', $file));
                    $error = '';
                    if (in_array($found, $exe) == false) {
                        $error = 'نوع الملف غير صالح';
                    } else {
                        $handel = fopen($file_tmp, 'r');
                        while ($data = fgetcsv($handel)) {
                            $item1 = $data[0];
                            $item2 = $data[1];
                            $item3 = $data[2];
                            $uplode = $con->prepare("INSERT INTO studentatt3(idnumber,name,numberatt,classnumber) VALUES(?,?,?,?)");
                            $uplode->execute(array($item1, $item2, $item3, $idnum));
                            $success = ' تم اضافة الملف بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=third&work=showstd&classid=$idnum'>";
                        }

                    }
                }
                ?>

            <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> رفع الملف </label>
                            <input type="file" class="form-control" name='file'
                            value=''
                            aria-describedby="emailHelp" placeholder="ادخل رقم الفصل">
                        </div>
                        <button type="submit" class="btn btn-primary">رفع</button><br>
                        <?php
if (!empty($error)) {?>
                                <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong><?php echo $error; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                           <?php }
                ?>
                        <?php
if (isset($success)) {?>
                                <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong><?php echo $success; ?></strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                     </div>
                           <?php }
                ?>
                    </form>
            </div>
            <?php }

            /***************************
             * ****************************** */
            foreach ($fetchclass as $class) {?>
                    <br><div class='group-form'>
                            <div class="alert alert-primary" role="alert">
                                <p><strong>رقم الفصل</strong> : <?php echo $class['classnumber']; ?></p>
                                <a href='?action=third&type=showclass&work=delete&id=<?php echo $class['id']; ?>'>
                                <br><div class='btn btn-danger'>حذف</div></a>
                                <a href='?action=third&type=showclass&work=edit&id=<?php echo $class['id']; ?>'>
                                <div class='btn btn-success'>تعديل</div></a>
                                <a href='?action=third&type=showclass&work=upload&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-dark'>رفع الغياب</div></a>
                                <a href='?action=third&type=showclass&work=insert&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-info'>ادخال طالب</div></a>
                                <a href='?action=third&work=showstd&classid=<?php echo $class['classnumber']; ?>'>
                                <div class='btn btn-primary'>عرض الطلاب</div></a>
                            </div>
                         </div>
                <?php }
        }
        if (@$_REQUEST['work'] == 'showstd') {
            $classid = $_GET['classid'];
            $selectstd1 = $con->prepare("SELECT * FROM studentatt3 WHERE classnumber=$classid");
            $selectstd1->execute();
            $fetchstd1 = $selectstd1->fetchAll();
            if (@$_REQUEST['workstd'] == 'edit') {
                $idnumber = $_GET['id'];
                $selectres1 = $con->prepare("SELECT * FROM studentatt3 WHERE id=$idnumber");
                $selectres1->execute();
                $fetchstdres1 = $selectres1->fetch();
                if ($idnumber == $fetchstdres1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestdupdate = filter_var(trim($_POST['namestdupdate']), FILTER_SANITIZE_STRING);
                        $numberstdupdate = filter_var(trim($_POST['numberstdupdate']), FILTER_SANITIZE_STRING);
                        $degreeupdate_arabic1 = filter_var(trim($_POST['degreeupdate_arabic1']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestdupdate == '' || $numberstdupdate == '' || $degreeupdate_arabic1 == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("UPDATE studentatt3
                        SET idnumber=?,name=?,numberatt=?
                        WHERE id=$idnumber");
                            $updatestd1->execute(array($numberstdupdate, $namestdupdate, $degreeupdate_arabic1));
                            $success = ' تم التعديل  بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=third&work=showstd&classid=$fetchstdres1[classnumber]'>";
                        }
                    }

                    ?>
                    <div class='group-form' >
                    <form method="POST" enctype="multipart/form-data">
                    <?php
if (!empty($error)) {?>
                        <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?php echo $error; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>
                <?php
if (isset($success)) {?>
                        <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?php echo $success; ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل اسم الطالب </label>
                            <input type="text" class="form-control" name='namestdupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["name"];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تعديل رقم الجلوس </label>
                            <input type="text" class="form-control" name='numberstdupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["idnumber"];}?>'
                            aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> ايام الغياب </label>
                            <input type="text" class="form-control" name='degreeupdate_arabic1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["numberatt"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل عدد ايام الغياب ">
                        </div>
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
               <?php }
                ?>

        <?php }
            if (@$_REQUEST['workstd'] == 'delete') {
                $idnumber = $_GET['id'];
                $selectresdel1 = $con->prepare("SELECT * FROM studentatt3 WHERE id=$idnumber");
                $selectresdel1->execute();
                $fetchstdresdel1 = $selectresdel1->fetch();
                if ($idnumber == $fetchstdresdel1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestddel = filter_var(trim($_POST['namestddel']), FILTER_SANITIZE_STRING);
                        $numberstdel = filter_var(trim($_POST['numberstdel']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestddel == '' || $numberstdel == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("DELETE FROM studentatt3 WHERE id=$idnumber");
                            $updatestd1->execute();
                            $success = ' تم الحذف  بنجاح سيتم تحويلك لصفحة الطلاب';
                            echo "<meta http-equiv='refresh' content='2;url=?action=third&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
                        }
                    }

                    ?>
                <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1"> حذف اسم الطالب </label>
                        <input type="text" class="form-control" name='namestddel'
                        value='<?php if (isset($fetchstdresdel1)) {echo $fetchstdresdel1["name"];}?>'
                        aria-describedby="emailHelp" placeholder="ادخل اسم الطالب">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">حذف رقم الجلوس </label>
                        <input type="text" class="form-control" name='numberstdel'
                        value='<?php if (isset($fetchstdresdel1)) {echo $fetchstdresdel1["idnumber"];}?>'
                        aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                    </div>
                    <?php
if (!empty($error)) {?>
                    <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><?php echo $error; ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php }
                    ?>
            <?php
if (isset($success)) {?>
                    <br><div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?php echo $success; ?></strong>
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
                ?>

    <?php }
            foreach ($fetchstd1 as $user) {?>
        <div class='group-form'>
              <br><div class="alert alert-primary" role="alert">
                 <p><strong>الاسم : </strong><?php echo $user['name'] ?></p>
                 <p><strong>رقم الجلوس : </strong><?php echo $user['idnumber'] ?></p>
                 <p><strong>رقم الفصل : </strong><?php echo $user['classnumber'] ?></p>
                 <p><strong>ايام الغياب : </strong><?php echo $user['numberatt'] ?></p>
                 <a href='?action=third&work=showstd&classid=<?php echo $user['classnumber']; ?>&id=<?php echo $user['id']; ?>&workstd=delete'>
                 <button type="button" class="btn btn-danger">حذف</button></a>
                 <a href='?action=third&work=showstd&classid=<?php echo $user['classnumber']; ?>&id=<?php echo $user['id']; ?>&workstd=edit'>
                 <button type="button" class="btn btn-success">تعديل</button></a>
                 </div>
              </div>
   <?php }
        }

    }
    include $temp . "footer.php";
} else {
    header("location:index.php");
}
?>

