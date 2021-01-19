<?php
session_start();
session_regenerate_id();
if (isset($_SESSION['username'])) {
    include "init.php";
    ?>
    <div class='group-form'>
        <a href='?action=result'><div class='btn btn-primary'>النتيجة</div></a>
        <a href='?action=attendance'><div class='btn btn-info'>الغياب</div></a>
    </div>
   <?php
/**************************************************************************************** */
    /**************************************************************************************** */
    /**************************************النتيجة************************************************** */
    /**************************************************************************************** */
    if (@$_REQUEST['action'] == 'result') {?>
        <div class='group-form'>
            <br><a href='?action=result&type=second'><div class='btn btn-warning'>الصف الثاني</div></a>
            <a href='?action=result&type=first'><div class='btn btn-danger'>الصف الاول</div></a>
        </div>
   <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************انتيجة الصف الاول************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['type'] == 'first') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $select = $con->prepare("SELECT * FROM studentres WHERE idnumber=$name ");
                $select->execute();
                $row = $select->rowCount();
                if ($row > 0) {
                    $fetch = $select->fetch();
                    $success = 'تم الحفظ';
                } else {
                    $error = 'هذا الطالب غير موجود';
                }

            }
            ?>
    <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1">رقم الجلوس الطالب</label>
                        <input type="text" class="form-control" name='name'
                        value=''
                        aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                    </div>
                    <button type="submit" class="btn btn-primary">بحث</button><br>
                    <?php
if (isset($success)) {?>

                                <br><div class="alert alert-primary" role="alert">
                                    <p><strong>الاسم : </strong><?php echo $fetch['name'] ?></p>
                                    <p><strong>رقم الجلوس : </strong><?php echo $fetch['idnumber'] ?></p>
                                    <p><strong>رقم الجلوس : </strong><?php echo $fetch['idnumber'] ?></p>
                                    <p><strong>  الصف : </strong> الاول الاعدادي</p>
                                    <p><strong>اللغة الانجليزية : </strong><?php echo $fetch['english'] ?></p>
                                    <p><strong>الرياضيات  : </strong><?php echo $fetch['math'] ?></p>
                                    <p><strong>الدراسات الاجتماعية : </strong><?php echo $fetch['studies'] ?></p>
                                    <p><strong>العلوم : </strong><?php echo $fetch['Sciences'] ?></p>
                                    <p><strong>نشاط 1  : </strong><?php echo $fetch['activity1'] ?></p>
                                    <p><strong>نشاط 2  : </strong><?php echo $fetch['activity2'] ?></p>
                                    <p><strong>المجموع : </strong><?php echo $fetch['arabic'] + $fetch['english'] + $fetch['math'] + $fetch['studies'] + $fetch['Sciences'] + $fetch['activity1'] + $fetch['activity2'] ?></p>
                                    <p><strong>التربية الدينية : </strong><?php echo $fetch['religious'] ?></p>
                                    <p><strong>التربية الفنية : </strong><?php echo $fetch['art'] ?></p>
                                    <p><strong>الحاسب الالي : </strong><?php echo $fetch['computer'] ?></p>
                                    <a href='?action=result&id=<?php echo $fetch['id']; ?>&workstd=delete1'>
                                    <button type="button" class="btn btn-danger">حذف</button></a>
                                    <a href='?action=result&id=<?php echo $fetch['id']; ?>&workstd=edit1'>
                                    <button type="button" class="btn btn-success">تعديل</button></a>
                                    </div>

                       <?php }
            if (isset($error)) {?>
                            <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }
            ?>
                </form>
            </div>


    <?php }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************تعديل الصف الاول************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'edit1') {
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
                        echo "<meta http-equiv='refresh' content='2;url=result.php?action=first&work=showstd&classid=$fetchstdres1[classnumber]'>";
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

        }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************حذف الصف الاول************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'delete1') {
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
                        echo "<meta http-equiv='refresh' content='2;url=result.php?action=first&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
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

        /**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************انتيجة الصف الثاني************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['type'] == 'second') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $select = $con->prepare("SELECT * FROM studentres2 WHERE idnumber=$name ");
                $select->execute();
                $row = $select->rowCount();
                if ($row > 0) {
                    $fetch = $select->fetch();
                    $success = 'تم الحفظ';
                } else {
                    $error = 'هذا الطالب غير موجود';
                }

            }
            ?>
     <div class='group-form' >
                 <form method="POST" enctype="multipart/form-data">
                     <div class="form-group">
                         <br><label for="exampleInputEmail1">رقم الجلوس الطالب</label>
                         <input type="text" class="form-control" name='name'
                         value=''
                         aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                     </div>
                     <button type="submit" class="btn btn-primary">بحث</button><br>
                     <?php
if (isset($success)) {?>

                                 <br><div class="alert alert-primary" role="alert">
                                     <p><strong>الاسم : </strong><?php echo $fetch['name'] ?></p>
                                     <p><strong>رقم الجلوس : </strong><?php echo $fetch['idnumber'] ?></p>
                                     <p><strong>رقم الجلوس : </strong><?php echo $fetch['idnumber'] ?></p>
                                     <p><strong>  الصف : </strong> الثاني الاعدادي</p>
                                     <p><strong>اللغة الانجليزية : </strong><?php echo $fetch['english'] ?></p>
                                     <p><strong>الرياضيات  : </strong><?php echo $fetch['math'] ?></p>
                                     <p><strong>الدراسات الاجتماعية : </strong><?php echo $fetch['studies'] ?></p>
                                     <p><strong>العلوم : </strong><?php echo $fetch['Sciences'] ?></p>
                                     <p><strong>نشاط 1  : </strong><?php echo $fetch['activity1'] ?></p>
                                     <p><strong>نشاط 2  : </strong><?php echo $fetch['activity2'] ?></p>
                                     <p><strong>المجموع : </strong><?php echo $fetch['arabic'] + $fetch['english'] + $fetch['math'] + $fetch['studies'] + $fetch['Sciences'] + $fetch['activity1'] + $fetch['activity2'] ?></p>
                                     <p><strong>التربية الدينية : </strong><?php echo $fetch['religious'] ?></p>
                                     <p><strong>التربية الفنية : </strong><?php echo $fetch['art'] ?></p>
                                     <p><strong>الحاسب الالي : </strong><?php echo $fetch['computer'] ?></p>
                                     <a href='?action=result&id=<?php echo $fetch['id']; ?>&workstd=delete2'>
                                     <button type="button" class="btn btn-danger">حذف</button></a>
                                     <a href='?action=result&id=<?php echo $fetch['id']; ?>&workstd=edit2'>
                                     <button type="button" class="btn btn-success">تعديل</button></a>
                                     </div>

                        <?php }
            if (isset($error)) {?>
                             <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 <?php echo $error; ?>
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                        <?php }
            ?>
                 </form>
             </div>


     <?php }?>
     <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************تعديل الصف الثاني************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'edit2') {
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
                        echo "<meta http-equiv='refresh' content='2;url=result.php?action=second&work=showstd&classid=$fetchstdres1[classnumber]'>";
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

        }?>
     <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************حذف الصف الثاني************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'delete2') {
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
                        echo "<meta http-equiv='refresh' content='2;url=result.php?action=second&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
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
    }
    /**************************************************************************************** */
    /**************************************************************************************** */
    /**************************************الغياب************************************************** */
    /**************************************************************************************** */
    if (@$_REQUEST['action'] == 'attendance') {?>
        <div class='group-form'>
            <br><a href='?action=attendance&type=third'><div class='btn btn-primary'>الصف الثالث</div></a>
            <a href='?action=attendance&type=second'><div class='btn btn-warning'>الصف الثاني</div></a>
            <a href='?action=attendance&type=first'><div class='btn btn-danger'>الصف الاول</div></a>
        </div>
   <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************غياب الصف الاول************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['type'] == 'first') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $select = $con->prepare("SELECT * FROM studentatt WHERE idnumber=$name ");
                $select->execute();
                $row = $select->rowCount();
                if ($row > 0) {
                    $fetch = $select->fetch();
                    $success = 'تم الحفظ';
                } else {
                    $error = 'هذا الطالب غير موجود';
                }

            }
            ?>
    <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1">رقم الجلوس الطالب</label>
                        <input type="text" class="form-control" name='name'
                        value=''
                        aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                    </div>
                    <button type="submit" class="btn btn-primary">بحث</button><br>
                    <?php
if (isset($success)) {?>

                                <br><div class="alert alert-primary" role="alert">
                                    <p><strong>الاسم : </strong><?php echo $fetch['name'] ?></p>
                                    <p><strong>رقم الجلوس : </strong><?php echo $fetch['idnumber'] ?></p>
                                    <p><strong>  الصف : </strong> الاول الاعدادي</p>
                                    <p><strong>ايام الغياب  : </strong><?php echo $fetch['numberatt'] ?></p>
                                    <a href='?action=attendance&id=<?php echo $fetch['id']; ?>&workstd=deleteatt1'>
                                    <button type="button" class="btn btn-danger">حذف</button></a>
                                    <a href='?action=attendance&id=<?php echo $fetch['id']; ?>&workstd=editatt1'>
                                    <button type="button" class="btn btn-success">تعديل</button></a>
                                    </div>

                       <?php }
            if (isset($error)) {?>
                            <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }
            ?>
                </form>
            </div>


    <?php }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************تعديل الصف الاول************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'editatt1') {
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
                        echo "<meta http-equiv='refresh' content='2;url=attanced.php?action=first&work=showstd&classid=$fetchstdres1[classnumber]'>";
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
                    <br><label for="exampleInputEmail1"> عدد ايام الغياب </label>
                    <input type="text" class="form-control" name='degreeupdate_arabic1'
                    value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["numberatt"];}?>'
                    aria-describedby="emailHelp" placeholder="عدل ايام الغياب ">
                </div>
                <button type="submit" class="btn btn-success">تعديل</button><br>
            </form>
    </div>
       <?php }

        }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************حذف الصف الاول************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'deleteatt1') {
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
                        echo "<meta http-equiv='refresh' content='2;url=attanced.php?action=first&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
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
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************غياب الصف الثاني************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['type'] == 'second') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $select = $con->prepare("SELECT * FROM studentatt2 WHERE idnumber=$name ");
                $select->execute();
                $row = $select->rowCount();
                if ($row > 0) {
                    $fetch = $select->fetch();
                    $success = 'تم الحفظ';
                } else {
                    $error = 'هذا الطالب غير موجود';
                }

            }
            ?>
    <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1">رقم الجلوس الطالب</label>
                        <input type="text" class="form-control" name='name'
                        value=''
                        aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                    </div>
                    <button type="submit" class="btn btn-primary">بحث</button><br>
                    <?php
if (isset($success)) {?>

                                <br><div class="alert alert-primary" role="alert">
                                    <p><strong>الاسم : </strong><?php echo $fetch['name'] ?></p>
                                    <p><strong>رقم الجلوس : </strong><?php echo $fetch['idnumber'] ?></p>
                                    <p><strong>  الصف : </strong> الثاني الاعدادي</p>
                                    <p><strong>ايام الغياب  : </strong><?php echo $fetch['numberatt'] ?></p>
                                    <a href='?action=attendance&id=<?php echo $fetch['id']; ?>&workstd=deleteatt2'>
                                    <button type="button" class="btn btn-danger">حذف</button></a>
                                    <a href='?action=attendance&id=<?php echo $fetch['id']; ?>&workstd=editatt2'>
                                    <button type="button" class="btn btn-success">تعديل</button></a>
                                    </div>

                       <?php }
            if (isset($error)) {?>
                            <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }
            ?>
                </form>
            </div>


    <?php }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************تعديل الصف الثاني************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'editatt2') {
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
                        echo "<meta http-equiv='refresh' content='2;url=attanced.php?action=second&work=showstd&classid=$fetchstdres1[classnumber]'>";
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
                    <br><label for="exampleInputEmail1"> عدد ايام الغياب </label>
                    <input type="text" class="form-control" name='degreeupdate_arabic1'
                    value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["numberatt"];}?>'
                    aria-describedby="emailHelp" placeholder="عدل ايام الغياب ">
                </div>
                <button type="submit" class="btn btn-success">تعديل</button><br>
            </form>
    </div>
       <?php }

        }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************حذف الصف الثاني************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'deleteatt2') {
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
                        echo "<meta http-equiv='refresh' content='2;url=attanced.php?action=second&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
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
        /**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************غياب الصف الثالث************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['type'] == 'third') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $select = $con->prepare("SELECT * FROM studentatt3 WHERE idnumber=$name ");
                $select->execute();
                $row = $select->rowCount();
                if ($row > 0) {
                    $fetch = $select->fetch();
                    $success = 'تم الحفظ';
                } else {
                    $error = 'هذا الطالب غير موجود';
                }

            }
            ?>
    <div class='group-form' >
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <br><label for="exampleInputEmail1">رقم الجلوس الطالب</label>
                        <input type="text" class="form-control" name='name'
                        value=''
                        aria-describedby="emailHelp" placeholder="ادخل رقم الجلوس">
                    </div>
                    <button type="submit" class="btn btn-primary">بحث</button><br>
                    <?php
if (isset($success)) {?>

                                <br><div class="alert alert-primary" role="alert">
                                    <p><strong>الاسم : </strong><?php echo $fetch['name'] ?></p>
                                    <p><strong>رقم الجلوس : </strong><?php echo $fetch['idnumber'] ?></p>
                                    <p><strong>  الصف : </strong> الثالث الاعدادي</p>
                                    <p><strong>ايام الغياب  : </strong><?php echo $fetch['numberatt'] ?></p>
                                    <a href='?action=attendance&id=<?php echo $fetch['id']; ?>&workstd=deleteatt3'>
                                    <button type="button" class="btn btn-danger">حذف</button></a>
                                    <a href='?action=attendance&id=<?php echo $fetch['id']; ?>&workstd=editatt3'>
                                    <button type="button" class="btn btn-success">تعديل</button></a>
                                    </div>

                       <?php }
            if (isset($error)) {?>
                            <br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                       <?php }
            ?>
                </form>
            </div>


    <?php }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************تعديل الصف الثالث************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'editatt3') {
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
                        echo "<meta http-equiv='refresh' content='2;url=attanced.php?action=third&work=showstd&classid=$fetchstdres1[classnumber]'>";
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
                    <br><label for="exampleInputEmail1"> عدد ايام الغياب </label>
                    <input type="text" class="form-control" name='degreeupdate_arabic1'
                    value='<?php if (isset($fetchstdres1)) {echo $fetchstdres1["numberatt"];}?>'
                    aria-describedby="emailHelp" placeholder="عدل ايام الغياب ">
                </div>
                <button type="submit" class="btn btn-success">تعديل</button><br>
            </form>
    </div>
       <?php }

        }?>
    <?php
/**************************************************************************************** */
        /**************************************************************************************** */
        /**************************************حذف الصف الثالث************************************************** */
        /**************************************************************************************** */
        if (@$_REQUEST['workstd'] == 'deleteatt3') {
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
                        echo "<meta http-equiv='refresh' content='2;url=attanced.php?action=third&work=showstd&classid=$fetchstdresdel1[classnumber]'>";
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
    }
    include $temp . "footer.php";
} else {
    header("location:index.php");
}
?>