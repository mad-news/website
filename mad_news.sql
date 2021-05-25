-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 07:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mad_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `tarticles`
--

CREATE TABLE `tarticles` (
  `artID` int(11) NOT NULL,
  `artTitle` text DEFAULT NULL,
  `artAutID` int(11) NOT NULL,
  `artDate` date DEFAULT NULL,
  `artTyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tarticles`
--

INSERT INTO `tarticles` (`artID`, `artTitle`, `artAutID`, `artDate`, `artTyID`) VALUES
(100, '唐纳德·特朗普的雾月一十八日（上）', 103, '2020-01-20', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tauthors`
--

CREATE TABLE `tauthors` (
  `autID` int(50) NOT NULL,
  `autFName` varchar(50) DEFAULT NULL,
  `autLName` varchar(50) DEFAULT NULL,
  `autPName` varchar(50) DEFAULT NULL,
  `autPhone` varchar(50) DEFAULT NULL,
  `autEmail` varchar(100) DEFAULT NULL,
  `autGender` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tauthors`
--

INSERT INTO `tauthors` (`autID`, `autFName`, `autLName`, `autPName`, `autPhone`, `autEmail`, `autGender`) VALUES
(101, 'Wenxi', 'Yang', 'Jessie', '6089494535', 'yangwx51@gmail.com', 0),
(102, 'Zhiwei', 'Song', '溪边望月', '6086929308', 'zsong96@wisc.edu', 1),
(103, 'Hanlin', 'Tao', '赤色的黎明', '9513129490', 'htao23@wisc.edu', 1),
(104, 'Xuli', 'Wang', 'Tony', '6089575318', 'xwang2382@wisc.edu', 1),
(105, 'Lihao', 'Yuan', '红炉主人', '+8618930633523', 'yuanhaohao1234@gmail.com', 1),
(106, 'Yimin', 'Guo', '那货老昌', '7573164985', 'guo.yimin.97@gmail.com', 1),
(107, 'Wenzhe', 'Teng', '格鲁西', '6089602605', 'wteng3@wisc.edu', 1),
(108, 'Jianxu', 'Chen', 'cjxvictory', '6086288267', 'jchen855@wisc.edu', 1),
(109, 'Mufan', 'Chen', '二杯面粉', '5853542760', 'mchen349@wisc.edu', 0),
(110, 'Xiaoru', 'Ma', '不放香菜', '6089494894', 'maxiaoru_mandy@163.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tcontents`
--

CREATE TABLE `tcontents` (
  `conID` int(11) NOT NULL,
  `conTitle` text DEFAULT NULL,
  `conPara` text DEFAULT NULL,
  `conTitleSize` int(11) NOT NULL,
  `conParaSize` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tcontents`
--

INSERT INTO `tcontents` (`conID`, `conTitle`, `conPara`, `conTitleSize`, `conParaSize`) VALUES
(100, '<b>写在前面</b>', '自2020年11月起一系列围绕着美国总统大选的闹剧到1月6日发展到了高潮，在现任总统特朗普的鼓吹之下，其支持者展开了对美国国会的冲击。尽管这场“向罗马进军”的低劣复刻版闹剧（或者说“笑剧”）仍未完全落幕，但这荒唐可笑的一幕令笔者不自禁地想写下这一短文。有心的读者可能一来就发现了<b>本文致敬了马克思的《路易·波拿巴的雾月十八日》的标题</b>。这不仅仅是因为特朗普与路易·波拿巴一样，一个平庸可笑的小丑在一场荒唐的闹剧中成了“英雄” （后者成功了，而前者依然前途未卜），更是因为二者都表现出了资产阶级共和国内部发展中积累的重重矛盾和阶级斗争。马克思曾在《路易·波拿巴的雾月十八日》说到“在那里（美国），<b>虽然已有阶级存在，但它们还没有完全固定下来</b>，它们在不断的运动中不断更新自己的组成部分，并且彼此互换着自己的组成部分；在那里，现代的生产资料不仅不和经常人口过剩的现象相结合，反而弥补了头脑和人手方面的相对缺乏；最后，在那里，应该开辟新世界的物质生产所具有的狂热而充满青春活力的进展，没有给予人们时间或机会来结束旧的幽灵世界”，<b>但在21世纪的今天，美国的资本主义发展似乎已经走到了矛盾集中凸显的时刻。阶级固化已到了相当严重的程度。</b>', 30, 30),
(101, '<b>“向国会进军”</b>', '自11月美国大选点票结束以来，特朗普在输掉这次选举后便开始一系列企图继续保留其权力的挣扎。一方面，他玩弄起他的“狗哨”（通过暗示的手段来表达对政治主流观点的反对），比如，他经常说少数族裔的移民会把白人为主的郊区搞乱。<b>积极地调动起他的忠诚者们散布着各种粗制滥造的选举阴谋与作弊“证据”</b>。另一边，他<b>用狂热支持者选票（胡萝卜）和总统权力的大棒诱使共和党议员们支持他对于选举阴谋论的支持。不少共和党议员们还天真地以为对阴谋论的支持是榨干特朗普与其狂热支持者价值的机会，兴高采烈地放出对特朗普选举阴谋论暧昧模糊的支持。</b>', 30, 30),
(102, ' ', '终于，在2021年1月6日，在美国国会与副总统彭斯仪式性地清点选举人团票的当天，特朗普与他的支持者们开启了一场滑稽的大型化装晚会与亡灵召唤。Reichstag（德国国会大厦，1933年发生过纳粹主导的国会纵火案）与火刑架火光中的褐衫和的白袍纷纷登场，奴隶主与十字军的旗帜飘扬起来，各种早已朽烂的鬼影在这天都粉墨登场并在特朗普的号召之下聚集在美国的国会下。终于，在彭斯如实宣布民主党候选人拜登胜选时，这位特朗普“虔诚忠实“的仆人马上成为了特朗普狂热支持者的首要目标。在“吊死彭斯（Hang Mike Pence）”的口号下，“爱国者们”在国会警察半推半就的“帮助”下冲入了国会。虽然这次混乱无序的冲击现在看来形同一场马戏团演出，但这确实是美国政治上史无前例的一场对其资产阶级共和制度的挑战；在此之前，很少有人会认为这个世界资本主义的核心上演了一幕香蕉共和国（中美洲几个以香蕉种植业为支柱的小国，以频繁的军事政变闻名）式的政治动荡。<b>要了解这一幕发生的缘由，我们需要用外科手术刀划开表层病变的肌理，去寻找资本主义在美国矛盾累积的内核。</b>', 30, 30),
(103, '<b>序幕</b>', '要回答特朗普如何在2021年掀起这样一场风暴，我们必须先看一下他2016年是如何获得其选民支持并胜利的。在这次的冲击国会事件中，绝大多数特朗普的狂热支持者相信“Wir sind das volk （我们就是人民）”并相信着他们在执行着一场由“爱国者们”发起的掀翻腐败政府的“革命”。<b>不少的幼稚者看到这场由许多美国底层民众参与的运动错误地以为这是一场属于美国人民的运动，甚至于更荒谬地认为这是一场无产阶级运动。</b>正如纳粹党的在德国的崛起也不乏有来自于大量受蛊惑的德国工人与无产阶级的支持一样，特朗普所煽动的这场破坏活动目的是为了维护他自己的权力与扩张其种族主义与新时代麦卡锡主义的影响。同时<b>美国的底层人民在冷战麦卡锡主义，去工业化，工会衰落，宗教保守主义与新自由主义资本主义经济的统治与荼毒下</b>，一方面累积了<b>对大资本家与大企业的大量不满</b>。而另一方面，<b>美国社会长期以来又把左翼思想与社会主义当作洪水猛兽</b>。同时，资本主义的全球剥削体系也使美国这样的资本主义核心国家中的无产阶级享受到了大企业主们在全球剥削剩余价值后的残羹剩饭，使得他们愈发丧失了斗争性。在这样的矛盾环境中，在工厂减少、工会衰落背景下的底层人民开始转向了教堂与保守主义，转向了种族主义乃至于法西斯主义的道路上。右翼煽动者们试图让人们把他们的困境归咎于外来者与外国人们。在这样的的催化下，<b>美国这位弗兰克斯坦（玛丽雪莱笔下的一个科学怪人，他创造了一个缝合怪物）终于制造出了这个有着传统主义脑袋、基督教保守主义躯干、法西斯主义双腿与种族主义臂膀的“怪人”，并最终选择了特朗普成为其大脑。</b>', 30, 30),
(104, '<b>选举前奏</b>', '2020年初出现的新冠病毒并没有像特朗普自大地宣称到“会像奇迹般消失(One day — it’s like a miracle — it will disappear)”，相反地，美国的政治稳定性随着新冠病毒的肆虐与民众生活水平的普遍下降倒是毫不令人意外地消失了。', 30, 30),
(105, ' ', '在这样的环境下，长期建立在种族间不平等的经济地位之上的种族主义问题因为2020年的5月明尼苏达警察对于乔治·弗洛伊德的谋杀突出表现了出来，其引发的一系列诉求种族平等与反对法西斯主义的游行示威也达到了自民权运动以来对最高峰。<b>对于美国人民对种族平等与社会正义的诉求中，美国的资产阶级政府的两只铁钳对其进行了联合绞杀。</b>一方面是民主党与自由派对黑人运动表示口头支持，<b>但却对核心问题，即黑人和白人在经济地位上的不平等顾左右而言他</b>，另一方面则是<b>特朗普用“法律与秩序(law and orders)”集结国家暴力机器和民间的“反革命十字军”尝试用真枪实弹的暴力来“拯救”他们心心念念的属于“财产，家庭，宗教，秩序”的旧社会</b>。连最表面与浅薄的对于种族平等的诉求与对警察暴力的反对“都同时被当作‘谋害社会的行为’加以惩罚，当作‘社会主义阴谋’加以指责”。', 30, 30),
(106, ' ', '在这样的动荡与混乱中，年末的美国总统大选迎来了两位候选人，一位是老气横秋的政治建制派代表人拜登，而另一位就是本文的主角特朗普。毫无疑问地，特朗普先生在选举前就意识到他对新冠疫情的完全放任与突出的种族矛盾令他的连任之路变得愈发飘渺，于是<b>他的视线便开始转向了那属于古罗马“独裁官”亡灵的束棒与月桂枝，在选举投票前便一刻不停地质疑着选举的合法性，</b>“如果我输了，那一定是民主党作弊了”。', 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `timages`
--

CREATE TABLE `timages` (
  `imID` int(11) NOT NULL,
  `imRef` text DEFAULT NULL,
  `imAltText` text DEFAULT NULL,
  `imNote` text DEFAULT NULL,
  `imFolder` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timages`
--

INSERT INTO `timages` (`imID`, `imRef`, `imAltText`, `imNote`, `imFolder`) VALUES
(100, 'img/1_1.jpg', 'Trump\'s supporters gathering outside the Capitol', '图源：NBC', 'img'),
(101, 'img/1_2.jpg', 'Slogan of \"Make America Great Again\"', '图源：Chicago Tribune', 'img'),
(102, 'img/1_3.jpg', 'Slogan of \"Count every vote\"', '图源：KRNV', 'img'),
(103, 'img/1_4.jpg', 'Comic about 2020 Election', ' ', 'img');

-- --------------------------------------------------------

--
-- Table structure for table `tpostcons`
--

CREATE TABLE `tpostcons` (
  `posconID` int(11) NOT NULL,
  `posconArtID` int(11) NOT NULL,
  `posconConID` int(11) NOT NULL,
  `posconPriority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tpostcons`
--

INSERT INTO `tpostcons` (`posconID`, `posconArtID`, `posconConID`, `posconPriority`) VALUES
(100, 100, 100, 1),
(101, 100, 101, 2),
(102, 100, 102, 3),
(103, 100, 103, 4),
(104, 100, 104, 5),
(105, 100, 105, 6),
(106, 100, 106, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tpostims`
--

CREATE TABLE `tpostims` (
  `posimID` int(11) NOT NULL,
  `posimArtID` int(11) NOT NULL,
  `posimImID` int(11) NOT NULL,
  `posimPriority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tpostims`
--

INSERT INTO `tpostims` (`posimID`, `posimArtID`, `posimImID`, `posimPriority`) VALUES
(100, 100, 100, 1),
(101, 100, 101, 2),
(102, 100, 102, 3),
(103, 100, 103, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ttypes`
--

CREATE TABLE `ttypes` (
  `tyID` int(11) NOT NULL,
  `tyCHIName` varchar(25) DEFAULT NULL,
  `tyENGName` varchar(25) DEFAULT NULL,
  `tyCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ttypes`
--

INSERT INTO `ttypes` (`tyID`, `tyCHIName`, `tyENGName`, `tyCount`) VALUES
(100, '政治', 'Politics', 1),
(101, '财经', 'Business', 0),
(102, '教育', 'Education', 0),
(103, '社会', 'Society', 0),
(104, '科技', 'Tech', 0),
(105, '体育', 'Sport', 0),
(106, '娱乐', 'Entertainment', 0),
(107, '新闻评论', 'News', 0),
(108, '疫情', 'Pandemic', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tarticles`
--
ALTER TABLE `tarticles`
  ADD PRIMARY KEY (`artID`),
  ADD KEY `artAutID` (`artAutID`),
  ADD KEY `artTyID` (`artTyID`);

--
-- Indexes for table `tauthors`
--
ALTER TABLE `tauthors`
  ADD PRIMARY KEY (`autID`);

--
-- Indexes for table `tcontents`
--
ALTER TABLE `tcontents`
  ADD PRIMARY KEY (`conID`);

--
-- Indexes for table `timages`
--
ALTER TABLE `timages`
  ADD PRIMARY KEY (`imID`);

--
-- Indexes for table `tpostcons`
--
ALTER TABLE `tpostcons`
  ADD PRIMARY KEY (`posconID`),
  ADD KEY `posconConID` (`posconConID`),
  ADD KEY `posconArtID` (`posconArtID`);

--
-- Indexes for table `tpostims`
--
ALTER TABLE `tpostims`
  ADD PRIMARY KEY (`posimID`),
  ADD KEY `posimArtID` (`posimArtID`),
  ADD KEY `posimImID` (`posimImID`);

--
-- Indexes for table `ttypes`
--
ALTER TABLE `ttypes`
  ADD PRIMARY KEY (`tyID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tarticles`
--
ALTER TABLE `tarticles`
  ADD CONSTRAINT `tarticles_ibfk_1` FOREIGN KEY (`artAutID`) REFERENCES `tauthors` (`autID`),
  ADD CONSTRAINT `tarticles_ibfk_2` FOREIGN KEY (`artTyID`) REFERENCES `ttypes` (`tyID`);

--
-- Constraints for table `tpostcons`
--
ALTER TABLE `tpostcons`
  ADD CONSTRAINT `tpostcons_ibfk_1` FOREIGN KEY (`posconConID`) REFERENCES `tcontents` (`conID`),
  ADD CONSTRAINT `tpostcons_ibfk_2` FOREIGN KEY (`posconArtID`) REFERENCES `tarticles` (`artID`);

--
-- Constraints for table `tpostims`
--
ALTER TABLE `tpostims`
  ADD CONSTRAINT `tpostims_ibfk_1` FOREIGN KEY (`posimArtID`) REFERENCES `tarticles` (`artID`),
  ADD CONSTRAINT `tpostims_ibfk_2` FOREIGN KEY (`posimImID`) REFERENCES `timages` (`imID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
