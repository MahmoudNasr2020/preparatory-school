<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    ?>
    <div class='group-form' >
        <html>
            <head>
                <meta charset="utf-8">
            </head>
        </html>
        <a href='?action=third'><button type="button" class="btn btn-primary">نتيجة الصف الثالث</button></a>
        <a href='?action=second'><button type="button" class="btn btn-info"> نتيجة الصف الثاني</button></a>
        <a href='?action=first'><button type="button" class="btn btn-danger"> نتيجة الصف الاول</button></a>
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
                $insertclass = $con->prepare("INSERT INTO class(classnumber) VALUES(?)");
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
            $selectclass = $con->prepare("SELECT * FROM class");
            $selectclass->execute();
            $fetchclass = $selectclass->fetchAll();
            if (@$_REQUEST['work'] == 'edit') {
                $idnum = $_GET['id'];
                $updateclassfirst = $con->prepare("SELECT * FROM class WHERE id='$idnum'");
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
                            $updateclass = $con->prepare("UPDATE class SET classnumber=? WHERE id= $idnum");
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
                $delclassfirst = $con->prepare("SELECT * FROM class WHERE id='$idnum'");
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
                            $delclass = $con->prepare("DELETE FROM class WHERE id= $idnum");
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
                    $degree_eng1 = filter_var(trim($_POST['degree_eng1']), FILTER_SANITIZE_STRING);
                    $degree_math1 = filter_var(trim($_POST['degree_math1']), FILTER_SANITIZE_STRING);
                    $degree_studies1 = filter_var(trim($_POST['degree_studies1']), FILTER_SANITIZE_STRING);
                    $degree_Sciences1 = filter_var(trim($_POST['degree_Sciences1']), FILTER_SANITIZE_STRING);
                    $degree_activity1 = filter_var(trim($_POST['degree_activity1']), FILTER_SANITIZE_STRING);
                    $degree_activity2 = filter_var(trim($_POST['degree_activity2']), FILTER_SANITIZE_STRING);
                    $religious_education = filter_var(trim($_POST['Religious_education']), FILTER_SANITIZE_STRING);
                    $art_education = filter_var(trim($_POST['Art_education']), FILTER_SANITIZE_STRING);
                    $computer = filter_var(trim($_POST['computer']), FILTER_SANITIZE_STRING);
                    $error = '';
                    if ($namestd == '' || $numberstd == '' || $degree_arabic1 == '' || $degree_eng1 == '' || $degree_math1 == ''
                        || $degree_studies1 == '' || $degree_Sciences1 == '' || $degree_activity1 == '' || $degree_activity2 == ''
                        || $religious_education == '' || $art_education == '' || $computer == '') {
                        $error = 'يجب اكمال الحقول كامله';
                    }
                    if (empty($error)) {
                        $insertstd1 = $con->prepare("INSERT INTO
                     studentres(idnumber,name,arabic,english,math,studies,Sciences,
                     activity1,activity2,religious,art,computer,classnumber)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $insertstd1->execute(array($numberstd, $namestd, $degree_arabic1,
                            $degree_eng1, $degree_math1, $degree_studies1, $degree_Sciences1, $degree_activity1,
                            $degree_activity2, $religious_education, $art_education, $computer, $idnum));
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
                            <br><label for="exampleInputEmail1"> درجة اللغة العربية </label>
                            <input type="text" class="form-control" name='degree_arabic1'
                            value='<?php if (!empty($degree_arabic1)) {echo $degree_arabic1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة اللغة العربية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة اللغة الانجليزية</label>
                            <input type="text" class="form-control" name='degree_eng1'
                            value='<?php if (!empty($degree_eng1)) {echo $degree_eng1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة اللغة الانجليزية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة الرياضيات</label>
                            <input type="text" class="form-control" name='degree_math1'
                            value='<?php if (!empty($degree_math1)) {echo $degree_math1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة الرياضيات">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة الدراسات الاجتماعية </label>
                            <input type="text" class="form-control" name='degree_studies1'
                            value='<?php if (!empty($degree_studies1)) {echo $degree_studies1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة الدراسات الاجتماعية  ">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة العلوم  </label>
                            <input type="text" class="form-control" name='degree_Sciences1'
                            value='<?php if (!empty($degree_Sciences1)) {echo $degree_Sciences1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة العلوم">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة نشاط 1  </label>
                            <input type="text" class="form-control" name='degree_activity1'
                            value='<?php if (!empty($degree_activity1)) {echo $degree_activity1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة نشاط 1">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة نشاط 2  </label>
                            <input type="text" class="form-control" name='degree_activity2'
                            value='<?php if (!empty($degree_activity1)) {echo $degree_activity2;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة نشاط 2">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة التربية الدينية  </label>
                            <input type="text" class="form-control" name='Religious_education'
                            value='<?php if (!empty($religious_education)) {echo $religious_education;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة التربية الدينية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة التربية الفنية  </label>
                            <input type="text" class="form-control" name='Art_education'
                            value='<?php if (!empty($art_education)) {echo $art_education;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة التربية الفنية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة الحاسب الالي  </label>
                            <input type="text" class="form-control" name='computer'
                            value='<?php if (!empty($computer)) {echo $computer;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة الحاسب الالي">
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
                            $item4 = $data[3];
                            $item5 = $data[4];
                            $item6 = $data[5];
                            $item7 = $data[6];
                            $item8 = $data[7];
                            $item9 = $data[8];
                            $item10 = $data[9];
                            $item11 = $data[10];
                            $item12 = $data[11];
                            $uplode = $con->prepare("INSERT INTO studentres(idnumber,name,arabic,english,math,studies,Sciences,activity1,activity2,religious,art,computer,classnumber) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                            $uplode->execute(array($item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9, $item10, $item11, $item12, $idnum));
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
                                <div class='btn btn-dark'>رفع النتيجة</div></a>
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
            $selectstd1 = $con->prepare("SELECT * FROM studentres WHERE classnumber=$classid");
            $selectstd1->execute();
            $fetchstd1 = $selectstd1->fetchAll();
            if (@$_REQUEST['workstd'] == 'edit') {
                $idnumber = $_GET['id'];
                $selectres1 = $con->prepare("SELECT * FROM studentres WHERE id=$idnumber");
                $selectres1->execute();
                $fetchstdres1 = $selectres1->fetch();
                if ($idnumber == $fetchstdres1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestdupdate = filter_var(trim($_POST['namestdupdate']), FILTER_SANITIZE_STRING);
                        $numberstdupdate = filter_var(trim($_POST['numberstdupdate']), FILTER_SANITIZE_STRING);
                        $degreeupdate_arabic1 = filter_var(trim($_POST['degreeupdate_arabic1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_eng1 = filter_var(trim($_POST['degreeupdate_eng1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_math1 = filter_var(trim($_POST['degreeupdate_math1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_studies1 = filter_var(trim($_POST['degreeupdate_studies1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_Sciences1 = filter_var(trim($_POST['degreeupdate_Sciences1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_activity1 = filter_var(trim($_POST['degreeupdate_activity1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_activity2 = filter_var(trim($_POST['degreeupdate_activity2']), FILTER_SANITIZE_STRING);
                        $religious_educationupdate = filter_var(trim($_POST['Religious_educationupdate']), FILTER_SANITIZE_STRING);
                        $art_educationupdate = filter_var(trim($_POST['Art_educationupdate']), FILTER_SANITIZE_STRING);
                        $computerupdate = filter_var(trim($_POST['computerupdate']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestdupdate == '' || $numberstdupdate == '' || $degreeupdate_arabic1 == ''
                            || $degreeupdate_eng1 == '' || $degreeupdate_math1 == '' || $degreeupdate_studies1 == ''
                            || $degreeupdate_Sciences1 == '' || $degreeupdate_activity1 == '' || $degreeupdate_activity2 == ''
                            || $religious_educationupdate == '' || $art_educationupdate == '' || $computerupdate == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("UPDATE studentres
                        SET idnumber=?,name=?,arabic=?,english=?,math=?,studies=?,Sciences=?,activity1=?,activity2=?,religious=?,art=?,computer=?
                        WHERE id=$idnumber");
                            $updatestd1->execute(array($numberstdupdate, $namestdupdate, $degreeupdate_arabic1,
                                $degreeupdate_eng1, $degreeupdate_math1, $degreeupdate_studies1,
                                $degreeupdate_Sciences1, $degreeupdate_activity1, $degreeupdate_activity2, $religious_educationupdate,
                                $art_educationupdate, $computerupdate));
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
                            <br><label for="exampleInputEmail1"> درجة اللغة العربية </label>
                            <input type="text" class="form-control" name='degreeupdate_arabic1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["arabic"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة اللغة العربية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة اللغة الانجليزية</label>
                            <input type="text" class="form-control" name='degreeupdate_eng1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["english"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة اللغة الانجليزية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة الرياضيات</label>
                            <input type="text" class="form-control" name='degreeupdate_math1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["math"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة الرياضيات">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة الدراسات الاجتماعية </label>
                            <input type="text" class="form-control" name='degreeupdate_studies1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["studies"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة الدراسات الاجتماعية  ">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة العلوم  </label>
                            <input type="text" class="form-control" name='degreeupdate_Sciences1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["Sciences"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة العلوم">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة نشاط 1  </label>
                            <input type="text" class="form-control" name='degreeupdate_activity1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["activity1"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة نشاط 1">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعدل درجة نشاط 2  </label>
                            <input type="text" class="form-control" name='degreeupdate_activity2'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["activity2"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة نشاط 2">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة التربية الدينية  </label>
                            <input type="text" class="form-control" name='Religious_educationupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["religious"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة التربية الدينية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة التربية الفنية  </label>
                            <input type="text" class="form-control" name='Art_educationupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["art"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة التربية الفنية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة الحاسب الالي  </label>
                            <input type="text" class="form-control" name='computerupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["computer"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة الحاسب الالي">
                        </div>
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
               <?php }
                ?>

        <?php }
            if (@$_REQUEST['workstd'] == 'delete') {
                $idnumber = $_GET['id'];
                $selectresdel1 = $con->prepare("SELECT * FROM studentres WHERE id=$idnumber");
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
                            $updatestd1 = $con->prepare("DELETE FROM studentres WHERE id=$idnumber");
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
                 <p><strong>الاسم : </strong><?php echo $user['name'] ?></p>
                 <p><strong>رقم الجلوس : </strong><?php echo $user['idnumber'] ?></p>
                 <p><strong>رقم الفصل : </strong><?php echo $user['classnumber'] ?></p>
                 <p><strong>اللغة العربية : </strong><?php echo $user['arabic'] ?></p>
                 <p><strong>اللغة الانجليزية : </strong><?php echo $user['english'] ?></p>
                 <p><strong>الرياضيات  : </strong><?php echo $user['math'] ?></p>
                 <p><strong>الدراسات الاجتماعية : </strong><?php echo $user['studies'] ?></p>
                 <p><strong>العلوم : </strong><?php echo $user['Sciences'] ?></p>
                 <p><strong>نشاط 1  : </strong><?php echo $user['activity1'] ?></p>
                 <p><strong>نشاط 2  : </strong><?php echo $user['activity2'] ?></p>
                 <p><strong>المجموع : </strong><?php echo $user['arabic'] + $user['english'] + $user['math'] + $user['studies'] + $user['Sciences'] + $user['activity1'] + $user['activity2'] ?></p>
                 <p><strong>التربية الدينية : </strong><?php echo $user['religious'] ?></p>
                 <p><strong>التربية الفنية : </strong><?php echo $user['art'] ?></p>
                 <p><strong>الحاسب الالي : </strong><?php echo $user['computer'] ?></p>
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
                $insertclass = $con->prepare("INSERT INTO class2(classnumber) VALUES(?)");
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
            $selectclass = $con->prepare("SELECT * FROM class2");
            $selectclass->execute();
            $fetchclass = $selectclass->fetchAll();
            if (@$_REQUEST['work'] == 'edit') {
                $idnum = $_GET['id'];
                $updateclassfirst = $con->prepare("SELECT * FROM class2 WHERE id='$idnum'");
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
                            $updateclass = $con->prepare("UPDATE class2 SET classnumber=? WHERE id= $idnum");
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
                $delclassfirst = $con->prepare("SELECT * FROM class2 WHERE id='$idnum'");
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
                            $delclass = $con->prepare("DELETE FROM class2 WHERE id= $idnum");
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
                    $degree_eng1 = filter_var(trim($_POST['degree_eng1']), FILTER_SANITIZE_STRING);
                    $degree_math1 = filter_var(trim($_POST['degree_math1']), FILTER_SANITIZE_STRING);
                    $degree_studies1 = filter_var(trim($_POST['degree_studies1']), FILTER_SANITIZE_STRING);
                    $degree_Sciences1 = filter_var(trim($_POST['degree_Sciences1']), FILTER_SANITIZE_STRING);
                    $degree_activity1 = filter_var(trim($_POST['degree_activity1']), FILTER_SANITIZE_STRING);
                    $degree_activity2 = filter_var(trim($_POST['degree_activity2']), FILTER_SANITIZE_STRING);
                    $religious_education = filter_var(trim($_POST['Religious_education']), FILTER_SANITIZE_STRING);
                    $art_education = filter_var(trim($_POST['Art_education']), FILTER_SANITIZE_STRING);
                    $computer = filter_var(trim($_POST['computer']), FILTER_SANITIZE_STRING);
                    $error = '';
                    if ($namestd == '' || $numberstd == '' || $degree_arabic1 == '' || $degree_eng1 == '' || $degree_math1 == ''
                        || $degree_studies1 == '' || $degree_Sciences1 == '' || $degree_activity1 == '' || $degree_activity2 == ''
                        || $religious_education == '' || $art_education == '' || $computer == '') {
                        $error = 'يجب اكمال الحقول كامله';
                    }
                    if (empty($error)) {
                        $insertstd1 = $con->prepare("INSERT INTO
                     studentres2(idnumber,name,arabic,english,math,studies,Sciences,
                     activity1,activity2,religious,art,computer,classnumber)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $insertstd1->execute(array($numberstd, $namestd, $degree_arabic1,
                            $degree_eng1, $degree_math1, $degree_studies1, $degree_Sciences1, $degree_activity1,
                            $degree_activity2, $religious_education, $art_education, $computer, $idnum));
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
                            <br><label for="exampleInputEmail1"> درجة اللغة العربية </label>
                            <input type="text" class="form-control" name='degree_arabic1'
                            value='<?php if (!empty($degree_arabic1)) {echo $degree_arabic1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة اللغة العربية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة اللغة الانجليزية</label>
                            <input type="text" class="form-control" name='degree_eng1'
                            value='<?php if (!empty($degree_eng1)) {echo $degree_eng1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة اللغة الانجليزية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة الرياضيات</label>
                            <input type="text" class="form-control" name='degree_math1'
                            value='<?php if (!empty($degree_math1)) {echo $degree_math1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة الرياضيات">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة الدراسات الاجتماعية </label>
                            <input type="text" class="form-control" name='degree_studies1'
                            value='<?php if (!empty($degree_studies1)) {echo $degree_studies1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة الدراسات الاجتماعية  ">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة العلوم  </label>
                            <input type="text" class="form-control" name='degree_Sciences1'
                            value='<?php if (!empty($degree_Sciences1)) {echo $degree_Sciences1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة العلوم">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة نشاط 1  </label>
                            <input type="text" class="form-control" name='degree_activity1'
                            value='<?php if (!empty($degree_activity1)) {echo $degree_activity1;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة نشاط 1">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة نشاط 2  </label>
                            <input type="text" class="form-control" name='degree_activity2'
                            value='<?php if (!empty($degree_activity1)) {echo $degree_activity2;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة نشاط 2">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة التربية الدينية  </label>
                            <input type="text" class="form-control" name='Religious_education'
                            value='<?php if (!empty($religious_education)) {echo $religious_education;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة التربية الدينية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة التربية الفنية  </label>
                            <input type="text" class="form-control" name='Art_education'
                            value='<?php if (!empty($art_education)) {echo $art_education;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة التربية الفنية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> درجة الحاسب الالي  </label>
                            <input type="text" class="form-control" name='computer'
                            value='<?php if (!empty($computer)) {echo $computer;}?>'
                            aria-describedby="emailHelp" placeholder="ادخل درجة الحاسب الالي">
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ</button><br>
                    </form>
            </div>
            <?php

            }
            /****************************uploade second**********************
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
                            $item4 = $data[3];
                            $item5 = $data[4];
                            $item6 = $data[5];
                            $item7 = $data[6];
                            $item8 = $data[7];
                            $item9 = $data[8];
                            $item10 = $data[9];
                            $item11 = $data[10];
                            $item12 = $data[11];
                            $uplode = $con->prepare("INSERT INTO studentres2(idnumber,name,arabic,english,math,studies,Sciences,activity1,activity2,religious,art,computer,classnumber) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
                            $uplode->execute(array($item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9, $item10, $item11, $item12, $idnum));
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
                                <div class='btn btn-dark'>رفع النتيجة</div></a>
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
            $selectstd1 = $con->prepare("SELECT * FROM studentres2 WHERE classnumber=$classid");
            $selectstd1->execute();
            $fetchstd1 = $selectstd1->fetchAll();
            if (@$_REQUEST['workstd'] == 'edit') {
                $idnumber = $_GET['id'];
                $selectres1 = $con->prepare("SELECT * FROM studentres2 WHERE id=$idnumber");
                $selectres1->execute();
                $fetchstdres1 = $selectres1->fetch();
                if ($idnumber == $fetchstdres1['id']) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $namestdupdate = filter_var(trim($_POST['namestdupdate']), FILTER_SANITIZE_STRING);
                        $numberstdupdate = filter_var(trim($_POST['numberstdupdate']), FILTER_SANITIZE_STRING);
                        $degreeupdate_arabic1 = filter_var(trim($_POST['degreeupdate_arabic1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_eng1 = filter_var(trim($_POST['degreeupdate_eng1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_math1 = filter_var(trim($_POST['degreeupdate_math1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_studies1 = filter_var(trim($_POST['degreeupdate_studies1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_Sciences1 = filter_var(trim($_POST['degreeupdate_Sciences1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_activity1 = filter_var(trim($_POST['degreeupdate_activity1']), FILTER_SANITIZE_STRING);
                        $degreeupdate_activity2 = filter_var(trim($_POST['degreeupdate_activity2']), FILTER_SANITIZE_STRING);
                        $religious_educationupdate = filter_var(trim($_POST['Religious_educationupdate']), FILTER_SANITIZE_STRING);
                        $art_educationupdate = filter_var(trim($_POST['Art_educationupdate']), FILTER_SANITIZE_STRING);
                        $computerupdate = filter_var(trim($_POST['computerupdate']), FILTER_SANITIZE_STRING);
                        $error = '';
                        if ($namestdupdate == '' || $numberstdupdate == '' || $degreeupdate_arabic1 == ''
                            || $degreeupdate_eng1 == '' || $degreeupdate_math1 == '' || $degreeupdate_studies1 == ''
                            || $degreeupdate_Sciences1 == '' || $degreeupdate_activity1 == '' || $degreeupdate_activity2 == ''
                            || $religious_educationupdate == '' || $art_educationupdate == '' || $computerupdate == '') {
                            $error = 'يجب اكمال الحقول كامله';
                        }
                        if (empty($error)) {
                            $updatestd1 = $con->prepare("UPDATE studentres2
                        SET idnumber=?,name=?,arabic=?,english=?,math=?,studies=?,Sciences=?,activity1=?,activity2=?,religious=?,art=?,computer=?
                        WHERE id=$idnumber");
                            $updatestd1->execute(array($numberstdupdate, $namestdupdate, $degreeupdate_arabic1,
                                $degreeupdate_eng1, $degreeupdate_math1, $degreeupdate_studies1,
                                $degreeupdate_Sciences1, $degreeupdate_activity1, $degreeupdate_activity2, $religious_educationupdate,
                                $art_educationupdate, $computerupdate));
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
                            <br><label for="exampleInputEmail1"> درجة اللغة العربية </label>
                            <input type="text" class="form-control" name='degreeupdate_arabic1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["arabic"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة اللغة العربية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة اللغة الانجليزية</label>
                            <input type="text" class="form-control" name='degreeupdate_eng1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["english"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة اللغة الانجليزية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة الرياضيات</label>
                            <input type="text" class="form-control" name='degreeupdate_math1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["math"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة الرياضيات">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة الدراسات الاجتماعية </label>
                            <input type="text" class="form-control" name='degreeupdate_studies1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["studies"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة الدراسات الاجتماعية  ">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة العلوم  </label>
                            <input type="text" class="form-control" name='degreeupdate_Sciences1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["Sciences"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة العلوم">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة نشاط 1  </label>
                            <input type="text" class="form-control" name='degreeupdate_activity1'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["activity1"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة نشاط 1">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعدل درجة نشاط 2  </label>
                            <input type="text" class="form-control" name='degreeupdate_activity2'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["activity2"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة نشاط 2">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة التربية الدينية  </label>
                            <input type="text" class="form-control" name='Religious_educationupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["religious"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة التربية الدينية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة التربية الفنية  </label>
                            <input type="text" class="form-control" name='Art_educationupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["art"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة التربية الفنية">
                        </div>
                        <div class="form-group">
                            <br><label for="exampleInputEmail1"> تعديل درجة الحاسب الالي  </label>
                            <input type="text" class="form-control" name='computerupdate'
                            value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["computer"];}?>'
                            aria-describedby="emailHelp" placeholder="عدل درجة الحاسب الالي">
                        </div>
                        <button type="submit" class="btn btn-success">تعديل</button><br>
                    </form>
            </div>
               <?php }
                ?>

        <?php }
            if (@$_REQUEST['workstd'] == 'delete') {
                $idnumber = $_GET['id'];
                $selectresdel1 = $con->prepare("SELECT * FROM studentres2 WHERE id=$idnumber");
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
                            $updatestd1 = $con->prepare("DELETE FROM studentres2 WHERE id=$idnumber");
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
                 <p><strong>اللغة العربية : </strong><?php echo $user['arabic'] ?></p>
                 <p><strong>اللغة الانجليزية : </strong><?php echo $user['english'] ?></p>
                 <p><strong>الرياضيات  : </strong><?php echo $user['math'] ?></p>
                 <p><strong>الدراسات الاجتماعية : </strong><?php echo $user['studies'] ?></p>
                 <p><strong>العلوم : </strong><?php echo $user['Sciences'] ?></p>
                 <p><strong>نشاط 1  : </strong><?php echo $user['activity1'] ?></p>
                 <p><strong>نشاط 2  : </strong><?php echo $user['activity2'] ?></p>
                 <p><strong>المجموع : </strong><?php echo $user['arabic'] + $user['english'] + $user['math'] + $user['studies'] + $user['Sciences'] + $user['activity1'] + $user['activity2'] ?></p>
                 <p><strong>التربية الدينية : </strong><?php echo $user['religious'] ?></p>
                 <p><strong>التربية الفنية : </strong><?php echo $user['art'] ?></p>
                 <p><strong>الحاسب الالي : </strong><?php echo $user['computer'] ?></p>
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
if (@$_REQUEST['action'] == 'third') {
        $select = $con->prepare("SELECT * FROM studentres3 WHERE id=1");
        $select->execute();
        $fetch = $select->fetch();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $textaddress = filter_var(trim($_POST['textaddress']), FILTER_SANITIZE_STRING);
            $error = '';
            if ($textaddress == '') {
                $error = 'برجاء عدم ترك حقول فارغة';
            }
            if (empty($error)) {

                $update = $con->prepare("UPDATE studentres3 SET link=?");
                $update->execute(array($textaddress));
                $success = 'تم التعديل بنجاح';
                echo "<meta http-equiv='refresh' content='2;url=?action=third'>";
            }
        }
        ?>
        <div class='group-form' style=''>
        <form method="POST" enctype="multipart/form-data">
            <br><div class="form-group">
                <label for="exampleInputEmail1">رابط نتيجة الصف الثالث </label>
                <input type="text" class="form-control" name='textaddress' value='<?php if (isset($fetch)) {echo $fetch['link'];}?>'  aria-describedby="emailHelp" placeholder="ادخل اسم الموقع">
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
            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
        </div>
    <?php }

    include $temp . "footer.php";
} else {
    header("location:index.php");
}
?>
