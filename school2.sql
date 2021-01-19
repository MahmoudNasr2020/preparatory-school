-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2020 at 10:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school2`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutschool`
--

CREATE TABLE `aboutschool` (
  `id` int(11) NOT NULL,
  `textaddress` varchar(255) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aboutschool`
--

INSERT INTO `aboutschool` (`id`, `textaddress`, `text`, `img`) VALUES
(1, 'عن المدرسة', 'مدرسة ميدوم الاعداديه بنين هي واحده من اقدم المدارس في محافظه بني سويف,اشتهرت المدرسة بتخريج عدد كبير من الطلاب ذو الكفاءة العاليه في كل المجالات مدرسة سعداوي', 'layout/img/aboutschool/logo2.png');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classnumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classnumber`) VALUES
(11, 1),
(12, 2),
(14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `class2`
--

CREATE TABLE `class2` (
  `id` int(11) NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class2`
--

INSERT INTO `class2` (`id`, `classnumber`) VALUES
(5, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `classatt1`
--

CREATE TABLE `classatt1` (
  `id` int(11) NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classatt1`
--

INSERT INTO `classatt1` (`id`, `classnumber`) VALUES
(5, 1),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `classatt2`
--

CREATE TABLE `classatt2` (
  `id` int(11) NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classatt2`
--

INSERT INTO `classatt2` (`id`, `classnumber`) VALUES
(5, 2),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `classatt3`
--

CREATE TABLE `classatt3` (
  `id` int(11) NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classatt3`
--

INSERT INTO `classatt3` (`id`, `classnumber`) VALUES
(4, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `address`, `text`, `img`) VALUES
(1, 'الصف الاول الاعدادي', 'تهدف المدرسة في هذه المرحله الي اعداد طالب علي دراية بكل الاقسام التي يتم تدريسها له وعلي ادارك الطلاب لاهمية هذه المرحله من عمره', 'layout/img/goals/الثالث.jpg'),
(2, 'الصف الثاني الاعدادي', 'تهدف المدرسة الي اعداد طالب قوي ومرن في كل المواد بشكل خاص وفي الحياة العمليه بشكل عام', 'layout/img/goals/الاول.jpg'),
(3, 'الصف الثالث الاعدادي', 'تهدف المدرسة الي اعداد الطالب الاعداد السليم والجيد لما بعد المرحلة الاعدادية', 'layout/img/goals/الثاني.png');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(400) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `email`, `password`) VALUES
(1, 'mahmoud2', 'mahmoud20@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `manger`
--

CREATE TABLE `manger` (
  `id` int(11) NOT NULL,
  `mangerAdd` varchar(255) NOT NULL,
  `mangerText` varchar(2000) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manger`
--

INSERT INTO `manger` (`id`, `mangerAdd`, `mangerText`, `img`) VALUES
(2, 'كلمة السيدة مديرة المدرسة', 'أبنائي الطلبة الأعزاء، المعلمون الكرام، الاهالي الافاضل... يسعدني أن أحييكم جميعا باجمل تحية ونحن نبدأ عامنا الدراسي بعزيمة قوية وإرادة متجددة، بمشيئة الله تعالى سنعمل على تحقيق بيئة تربوية فعالة ومحفزة على التعلم والتميز بحيث يتم إعداد طلابنا إعداداً تربوياً علمياً خلقياً ودينياً، يقوم على تحقيق ذلك معلمون مؤهلون اكفاء لهم القدرة على التعامل مع التقنيات الحديثة في إطار مشاركة اجتماعية فعالة ومتعاونة من قبل المجتمع المحلي ,أولياء الأمور والمدرسة لذلك تقع على عاتقنا مسؤولية كبيرة قوامها مضاعفة الجهود والعمل سويا على معالجة مواطن الضعف وتحسين أداء الطلبة وتوفير الوسائل الضرورية لتحسين البيئة التعليمية من اجل رفع مستوى النجاح في كل صف وفي المدرسة اجمع ... والله الموفق والمستعان', 'layout/img/manger/المديرة.png');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `adressnews` varchar(255) NOT NULL,
  `news` varchar(1000) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `adressnews`, `news`, `img`, `date`) VALUES
(8, 'جدا جدا مهم', 'برشلونة اقوي فريق في العالم لعام 2051', 'layout/img/news/61384673_Untitled-2.jpg', '2020-04-26'),
(13, 'عاااااااااااااااااااجل', '&#34; مصدر باتحاد الكرة يكشف أسباب طلب بعض الأندية إلغاء الدوري', 'layout/img/news/990137577_Untitled-11.jpg', '2020-04-30'),
(15, 'احمد اخويا', 'محمود نصر يرحب بكم ويحييكم', 'layout/img/news/480723518_Untitled-3.jpg', '2020-04-26'),
(19, 'خبر هام', 'محمود نصر يرحب بكم ويحييكم', 'layout/img/news/news.jpg', '2020-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `adressnews` varchar(255) NOT NULL,
  `news` varchar(1000) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `adressnews`, `news`, `img`) VALUES
(1, 'وئةؤنئت', 'منسميس', 'منيمشسن'),
(6, 'التعليم الالكتروني', 'https://www.youtube.com/channel/UCxhMyy_YpfigS83kign-0_g/playlists?view=50&sort=dd&shelf_id=9', 'layout/img/service/التعليم الالكتروني.png'),
(7, 'النتيجة', 'result/result.php', 'layout/img/service/النتيجة.png'),
(8, 'الغياب', 'result/attanced.php', 'layout/img/service/الغياب.png'),
(9, 'بنك المعرفة', 'https://www.ekb.eg/ar/home', 'layout/img/service/bankmarfaaamasry.png'),
(10, 'Edmodo منصة', 'https://new.edmodo.com/home', 'layout/img/service/المنصة.png'),
(11, 'كادر المعلم', 'http://academy.emis.gov.eg/evaluation/Default.aspx', 'layout/img/service/كادر المعلمين.png'),
(12, 'صحيفة المعلم', 'http://student.emis.gov.eg/new/', 'layout/img/service/احوال المعلم.png'),
(13, 'موقع الحكومة', 'http://teacher.emis.gov.eg/emp_teacher/', 'layout/img/service/الحكومة الالكترونية.png'),
(14, 'اتصل بنا', 'Contact\\contact.php', 'layout/img/service/اتصل بنا.png');

-- --------------------------------------------------------

--
-- Table structure for table `settingsite`
--

CREATE TABLE `settingsite` (
  `siteid` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settingsite`
--

INSERT INTO `settingsite` (`siteid`, `sitename`, `email`, `number`, `address`, `status`) VALUES
(1, 'مدرسة ميدوم الاعدادية', 'm60161515@gmail.com', '01127421485', 'ميدوم-الواسطي-بني سويف', 1);

-- --------------------------------------------------------

--
-- Table structure for table `silder`
--

CREATE TABLE `silder` (
  `id` int(11) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `img` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `silder`
--

INSERT INTO `silder` (`id`, `adress`, `img`, `date`) VALUES
(1, 'ميدوم', 'سيبسيبسيبسيبسيب', '2020-04-25 21:30:37'),
(12, 'هرم ميدوم', 'layout/img/slider/82333582_2602070766554738_6676468091162984448_n.jpg', '2020-04-28 06:27:43'),
(13, 'مدرسة ميدوم الاعدادية بنين', 'layout/img/slider/المدرسة.jpg', '2020-04-28 05:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `facebook` varchar(1000) NOT NULL,
  `tweet` varchar(1000) NOT NULL,
  `youtube` varchar(1000) NOT NULL,
  `instagram` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `facebook`, `tweet`, `youtube`, `instagram`) VALUES
(1, 'www.ggg.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `studentatt`
--

CREATE TABLE `studentatt` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `numberatt` double NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentatt`
--

INSERT INTO `studentatt` (`id`, `idnumber`, `name`, `numberatt`, `classnumber`) VALUES
(11, 1, 'احمد نصر جمعة', 5, 1),
(12, 2, 'يوسف احمد صديق محمود', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `studentatt2`
--

CREATE TABLE `studentatt2` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `numberatt` double NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentatt2`
--

INSERT INTO `studentatt2` (`id`, `idnumber`, `name`, `numberatt`, `classnumber`) VALUES
(11, 3, 'محمد احمد صديق', 15, 2);

-- --------------------------------------------------------

--
-- Table structure for table `studentatt3`
--

CREATE TABLE `studentatt3` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `numberatt` double NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentatt3`
--

INSERT INTO `studentatt3` (`id`, `idnumber`, `name`, `numberatt`, `classnumber`) VALUES
(5, 2, 'محمود ياسر صديق', 16, 2),
(6, 25, 'احمد نصر جمعة', 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentres`
--

CREATE TABLE `studentres` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `arabic` double NOT NULL,
  `english` double NOT NULL,
  `math` double NOT NULL,
  `studies` double NOT NULL,
  `Sciences` double NOT NULL,
  `activity1` double NOT NULL,
  `activity2` double NOT NULL,
  `religious` double NOT NULL,
  `art` double NOT NULL,
  `computer` double NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentres`
--

INSERT INTO `studentres` (`id`, `idnumber`, `name`, `arabic`, `english`, `math`, `studies`, `Sciences`, `activity1`, `activity2`, `religious`, `art`, `computer`, `classnumber`) VALUES
(6, 1, 'احمد نصر جمعة', 40, 80, 20, 40, 50, 60, 70, 80, 55, 36, 1),
(7, 2, 'يوسف احمد صديق محمود', 55, 55, 80, 10, 41, 60, 80, 80, 40, 70, 1),
(9, 3, 'محمود نصر', 88, 40, 80, 10, 41, 70, 80, 30, 40, 70, 2),
(10, 4, 'احمد محمد', 55, 44, 22, 33.5, 44.58, 88.57998, 14, 14, 18, 20, 2),
(11, 5, 'عبدالله خالد محمود محمد', 55, 40, 14.6, 55.987, 48.59, 20.6, 30.8, 14, 15, 66, 3),
(12, 6, 'سماء احمد صديق محمود', 33, 23, 80, 70, 60.3269, 83, 54, 65, 18, 29, 3);

-- --------------------------------------------------------

--
-- Table structure for table `studentres2`
--

CREATE TABLE `studentres2` (
  `id` int(11) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `arabic` double NOT NULL,
  `english` double NOT NULL,
  `math` double NOT NULL,
  `studies` double NOT NULL,
  `Sciences` double NOT NULL,
  `activity1` double NOT NULL,
  `activity2` double NOT NULL,
  `religious` double NOT NULL,
  `art` double NOT NULL,
  `computer` double NOT NULL,
  `classnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentres2`
--

INSERT INTO `studentres2` (`id`, `idnumber`, `name`, `arabic`, `english`, `math`, `studies`, `Sciences`, `activity1`, `activity2`, `religious`, `art`, `computer`, `classnumber`) VALUES
(5, 1, 'احمد نصر جمعة', 55, 65, 23, 33, 44, 44, 33, 12, 10, 22, 1),
(6, 2, 'يوسف احمد صديق محمود', 55, 55, 20, 55, 60, 60, 20, 80, 48, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `studentres3`
--

CREATE TABLE `studentres3` (
  `id` int(11) NOT NULL,
  `link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentres3`
--

INSERT INTO `studentres3` (`id`, `link`) VALUES
(1, 'http://www.benisuef.gov.eg/New_Portal/Natega/prep/prep.aspx');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `name`, `subject`, `img`) VALUES
(1, 'محمود نصر', 'اللغة العربية', 'layout/img/teacher/teacher.jfif'),
(3, 'احمد محمد عامر', 'الرياضيات', 'layout/img/teacher/69803158_Untitled-1.jpg'),
(5, 'مصطفي عيسي', 'اللغة الانجليزية', 'layout/img/teacher/teacher.png'),
(6, 'محمود نصر', 'اللغة الانجليزية', 'layout/img/teacher/172103861_2.jpg'),
(8, 'احمد نصر جمعة', 'الدراسات الاجتماعية', 'layout/img/teacher/teacher.png');

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` int(11) NOT NULL,
  `textaddress` varchar(255) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `img` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `textaddress`, `text`, `img`) VALUES
(1, 'رؤية ورسالة المدرسة', 'تهدف المدرسة الي تخريج طالب قادر على التفاعل مع متطلبات العصر من خلال بيئة تربوية فعالة من المجتمع و للمجتمع التعاون المثمر بين أعضاء هيئة التدريس للدعم الفعال من جانب المجتمع و أولياء الامور لتفعيل البناء للقيادة المدرسيه , الاستمرارية فى التنمية المهنية للعاملين بالمدرسة وتوفير التكنولوجيا الحديثة لجميع المتعلمين بجانب المتابعة و التقويم المستمر لنتائج تحصيل المتعلمين وتعديل وتهذيب السلوك الطلابي من خلال تفعيل المشاركة في لأنشطة', 'layout/img/versionschool/المدرسة.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutschool`
--
ALTER TABLE `aboutschool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classnumber` (`classnumber`);

--
-- Indexes for table `class2`
--
ALTER TABLE `class2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classnumber` (`classnumber`);

--
-- Indexes for table `classatt1`
--
ALTER TABLE `classatt1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classnumber` (`classnumber`);

--
-- Indexes for table `classatt2`
--
ALTER TABLE `classatt2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classnumber` (`classnumber`);

--
-- Indexes for table `classatt3`
--
ALTER TABLE `classatt3`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classnumber` (`classnumber`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manger`
--
ALTER TABLE `manger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settingsite`
--
ALTER TABLE `settingsite`
  ADD PRIMARY KEY (`siteid`);

--
-- Indexes for table `silder`
--
ALTER TABLE `silder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentatt`
--
ALTER TABLE `studentatt`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idnumber` (`idnumber`),
  ADD KEY `classnumber` (`classnumber`);

--
-- Indexes for table `studentatt2`
--
ALTER TABLE `studentatt2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idnumber` (`idnumber`),
  ADD KEY `classnumber` (`classnumber`);

--
-- Indexes for table `studentatt3`
--
ALTER TABLE `studentatt3`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idnumber` (`idnumber`),
  ADD KEY `classnumber` (`classnumber`);

--
-- Indexes for table `studentres`
--
ALTER TABLE `studentres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idnumber` (`idnumber`),
  ADD KEY `classnumber` (`classnumber`);

--
-- Indexes for table `studentres2`
--
ALTER TABLE `studentres2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idnumber` (`idnumber`),
  ADD KEY `classnumber` (`classnumber`);

--
-- Indexes for table `studentres3`
--
ALTER TABLE `studentres3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutschool`
--
ALTER TABLE `aboutschool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `class2`
--
ALTER TABLE `class2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classatt1`
--
ALTER TABLE `classatt1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `classatt2`
--
ALTER TABLE `classatt2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `classatt3`
--
ALTER TABLE `classatt3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `manger`
--
ALTER TABLE `manger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `settingsite`
--
ALTER TABLE `settingsite`
  MODIFY `siteid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `silder`
--
ALTER TABLE `silder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentatt`
--
ALTER TABLE `studentatt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `studentatt2`
--
ALTER TABLE `studentatt2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `studentatt3`
--
ALTER TABLE `studentatt3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `studentres`
--
ALTER TABLE `studentres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `studentres2`
--
ALTER TABLE `studentres2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `studentres3`
--
ALTER TABLE `studentres3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentatt`
--
ALTER TABLE `studentatt`
  ADD CONSTRAINT `studentatt_ibfk_1` FOREIGN KEY (`classnumber`) REFERENCES `classatt1` (`classnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentatt2`
--
ALTER TABLE `studentatt2`
  ADD CONSTRAINT `studentatt2_ibfk_1` FOREIGN KEY (`classnumber`) REFERENCES `classatt2` (`classnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentatt3`
--
ALTER TABLE `studentatt3`
  ADD CONSTRAINT `studentatt3_ibfk_1` FOREIGN KEY (`classnumber`) REFERENCES `classatt3` (`classnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentres`
--
ALTER TABLE `studentres`
  ADD CONSTRAINT `studentres_ibfk_1` FOREIGN KEY (`classnumber`) REFERENCES `class` (`classnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `studentres2`
--
ALTER TABLE `studentres2`
  ADD CONSTRAINT `studentres2_ibfk_1` FOREIGN KEY (`classnumber`) REFERENCES `class2` (`classnumber`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
