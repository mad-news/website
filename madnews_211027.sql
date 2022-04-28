-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2021 at 06:55 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `madnews_rw`
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
(100, '唐纳德·特朗普的雾月一十八日（上）', 103, '2020-01-20', 100),
(101, '唐纳德·特朗普的雾月一十八日（下）', 103, '2020-01-21', 100),
(102, '美国走到了历史的风陵渡口', 105, '2020-01-07', 100),
(103, '【财经周报】苏伊士运河运河堵塞导致全球产业链出现较大异常', 104, '2021-03-28', 101),
(104, '​丰县八孩事件,我们怎么看？', 105, '2022-02-22', '105')
;
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
-- Table structure for table `tcomments`
--

CREATE TABLE `tcomments` (
  `comID` int(11) NOT NULL,
  `comText` text DEFAULT NULL,
  `comuserID` int(11) NOT NULL,
  `comDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tcontents`
--

CREATE TABLE `tcontents` (
  `conID` int(11) NOT NULL,
  `artID` int(11) DEFAULT NULL,
  `conTitle` text DEFAULT NULL,
  `conPara` text DEFAULT NULL,
  `conTitleSize` int(11) NOT NULL,
  `conParaSize` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tcontents`
--

INSERT INTO `tcontents` (`conID`, `artID`, `conTitle`, `conPara`, `conTitleSize`, `conParaSize`) VALUES
(100, 100, '<b>写在前面</b>', '自2020年11月起一系列围绕着美国总统大选的闹剧到1月6日发展到了高潮，在现任总统特朗普的鼓吹之下，其支持者展开了对美国国会的冲击。尽管这场“向罗马进军”的低劣复刻版闹剧（或者说“笑剧”）仍未完全落幕，但这荒唐可笑的一幕令笔者不自禁地想写下这一短文。有心的读者可能一来就发现了<b>本文致敬了马克思的《路易·波拿巴的雾月十八日》的标题</b>。这不仅仅是因为特朗普与路易·波拿巴一样，一个平庸可笑的小丑在一场荒唐的闹剧中成了“英雄” （后者成功了，而前者依然前途未卜），更是因为二者都表现出了资产阶级共和国内部发展中积累的重重矛盾和阶级斗争。马克思曾在《路易·波拿巴的雾月十八日》说到“在那里（美国），<b>虽然已有阶级存在，但它们还没有完全固定下来</b>，它们在不断的运动中不断更新自己的组成部分，并且彼此互换着自己的组成部分；在那里，现代的生产资料不仅不和经常人口过剩的现象相结合，反而弥补了头脑和人手方面的相对缺乏；最后，在那里，应该开辟新世界的物质生产所具有的狂热而充满青春活力的进展，没有给予人们时间或机会来结束旧的幽灵世界”，<b>但在21世纪的今天，美国的资本主义发展似乎已经走到了矛盾集中凸显的时刻。阶级固化已到了相当严重的程度。</b>', 30, 30),
(101, 100, '<b>“向国会进军”</b>', '自11月美国大选点票结束以来，特朗普在输掉这次选举后便开始一系列企图继续保留其权力的挣扎。一方面，他玩弄起他的“狗哨”（通过暗示的手段来表达对政治主流观点的反对），比如，他经常说少数族裔的移民会把白人为主的郊区搞乱。<b>积极地调动起他的忠诚者们散布着各种粗制滥造的选举阴谋与作弊“证据”</b>。另一边，他<b>用狂热支持者选票（胡萝卜）和总统权力的大棒诱使共和党议员们支持他对于选举阴谋论的支持。不少共和党议员们还天真地以为对阴谋论的支持是榨干特朗普与其狂热支持者价值的机会，兴高采烈地放出对特朗普选举阴谋论暧昧模糊的支持。</b>', 30, 30),
(102, 100, ' ', '终于，在2021年1月6日，在美国国会与副总统彭斯仪式性地清点选举人团票的当天，特朗普与他的支持者们开启了一场滑稽的大型化装晚会与亡灵召唤。Reichstag（德国国会大厦，1933年发生过纳粹主导的国会纵火案）与火刑架火光中的褐衫和的白袍纷纷登场，奴隶主与十字军的旗帜飘扬起来，各种早已朽烂的鬼影在这天都粉墨登场并在特朗普的号召之下聚集在美国的国会下。终于，在彭斯如实宣布民主党候选人拜登胜选时，这位特朗普“虔诚忠实“的仆人马上成为了特朗普狂热支持者的首要目标。在“吊死彭斯（Hang Mike Pence）”的口号下，“爱国者们”在国会警察半推半就的“帮助”下冲入了国会。虽然这次混乱无序的冲击现在看来形同一场马戏团演出，但这确实是美国政治上史无前例的一场对其资产阶级共和制度的挑战；在此之前，很少有人会认为这个世界资本主义的核心上演了一幕香蕉共和国（中美洲几个以香蕉种植业为支柱的小国，以频繁的军事政变闻名）式的政治动荡。<b>要了解这一幕发生的缘由，我们需要用外科手术刀划开表层病变的肌理，去寻找资本主义在美国矛盾累积的内核。</b>', 30, 30),
(103, 100, '<b>序幕</b>', '要回答特朗普如何在2021年掀起这样一场风暴，我们必须先看一下他2016年是如何获得其选民支持并胜利的。在这次的冲击国会事件中，绝大多数特朗普的狂热支持者相信“Wir sind das volk （我们就是人民）”并相信着他们在执行着一场由“爱国者们”发起的掀翻腐败政府的“革命”。<b>不少的幼稚者看到这场由许多美国底层民众参与的运动错误地以为这是一场属于美国人民的运动，甚至于更荒谬地认为这是一场无产阶级运动。</b>正如纳粹党的在德国的崛起也不乏有来自于大量受蛊惑的德国工人与无产阶级的支持一样，特朗普所煽动的这场破坏活动目的是为了维护他自己的权力与扩张其种族主义与新时代麦卡锡主义的影响。同时<b>美国的底层人民在冷战麦卡锡主义，去工业化，工会衰落，宗教保守主义与新自由主义资本主义经济的统治与荼毒下</b>，一方面累积了<b>对大资本家与大企业的大量不满</b>。而另一方面，<b>美国社会长期以来又把左翼思想与社会主义当作洪水猛兽</b>。同时，资本主义的全球剥削体系也使美国这样的资本主义核心国家中的无产阶级享受到了大企业主们在全球剥削剩余价值后的残羹剩饭，使得他们愈发丧失了斗争性。在这样的矛盾环境中，在工厂减少、工会衰落背景下的底层人民开始转向了教堂与保守主义，转向了种族主义乃至于法西斯主义的道路上。右翼煽动者们试图让人们把他们的困境归咎于外来者与外国人们。在这样的的催化下，<b>美国这位弗兰克斯坦（玛丽雪莱笔下的一个科学怪人，他创造了一个缝合怪物）终于制造出了这个有着传统主义脑袋、基督教保守主义躯干、法西斯主义双腿与种族主义臂膀的“怪人”，并最终选择了特朗普成为其大脑。</b>', 30, 30),
(104, 100, '<b>选举前奏</b>', '2020年初出现的新冠病毒并没有像特朗普自大地宣称到“会像奇迹般消失(One day — it’s like a miracle — it will disappear)”，相反地，美国的政治稳定性随着新冠病毒的肆虐与民众生活水平的普遍下降倒是毫不令人意外地消失了。', 30, 30),
(105, 100, ' ', '在这样的环境下，长期建立在种族间不平等的经济地位之上的种族主义问题因为2020年的5月明尼苏达警察对于乔治·弗洛伊德的谋杀突出表现了出来，其引发的一系列诉求种族平等与反对法西斯主义的游行示威也达到了自民权运动以来对最高峰。<b>对于美国人民对种族平等与社会正义的诉求中，美国的资产阶级政府的两只铁钳对其进行了联合绞杀。</b>一方面是民主党与自由派对黑人运动表示口头支持，<b>但却对核心问题，即黑人和白人在经济地位上的不平等顾左右而言他</b>，另一方面则是<b>特朗普用“法律与秩序(law and orders)”集结国家暴力机器和民间的“反革命十字军”尝试用真枪实弹的暴力来“拯救”他们心心念念的属于“财产，家庭，宗教，秩序”的旧社会</b>。连最表面与浅薄的对于种族平等的诉求与对警察暴力的反对“都同时被当作‘谋害社会的行为’加以惩罚，当作‘社会主义阴谋’加以指责”。', 30, 30),
(106, 100, ' ', '在这样的动荡与混乱中，年末的美国总统大选迎来了两位候选人，一位是老气横秋的政治建制派代表人拜登，而另一位就是本文的主角特朗普。毫无疑问地，特朗普先生在选举前就意识到他对新冠疫情的完全放任与突出的种族矛盾令他的连任之路变得愈发飘渺，于是<b>他的视线便开始转向了那属于古罗马“独裁官”亡灵的束棒与月桂枝，在选举投票前便一刻不停地质疑着选举的合法性，</b>“如果我输了，那一定是民主党作弊了”。', 30, 30),
(107, 101, '<b>阴谋的诞生</b>', '为了挑战对自己不利的选举结果的合法性，<b>特朗普精确地瞄准了美国资本主义民主制度多年累积弊病的薄弱环，那便是两党制与赢家通吃的选举制度</b>。两党对权力的垄断扼杀了任何第三党竞争的机会，并迫使绝大多数选民都只能在两个同样依附于大资产阶级的党派中进行选择。同时，赢家通吃的制度让任何一位候选人只要票数高于竞争对手，无论实际投票率有多低都能赢得选举人票。', 30, 30),
(108, 101, '', '与此同时，<b>特朗普还注意到了一个选举统计时的有趣现象，并决定以此作为自己败选后攻击选举合法性的核心</b>。在2013年，俄亥俄州立大学的法学教授Edward Foley就发现因为人口稀疏的农村地区通常比人口稠密的城市地区计票更迅速，因此<b>在农村地区有着更高支持率的共和党通常会在计票一开始（选举日结束之前）显出极大的优势，但随着后续城市地区的选票被计算后选举结果会开始向民主党倾斜</b>。因为共和党通常使用红色而民主党采用蓝色，Edward Foley将这种现象命名为“红色蜃楼”（red mirage）或者“蓝移”（blue shift）。而这次的新冠疫情与邮寄选票更是大大加深了这种现象发生的可能性。因为特朗普对新冠疫情的抵赖与刻意忽视，共和党选民可能更倾向于计票更早但有病毒接触风险的选举站投票，而民主党选民更有可能选择邮寄选票。于是乎特朗普在选举开始之前便质疑起了邮寄选票的合法性（即使他自己过去也是用邮寄选票来投票的）。', 30, 30),
(109, 101, '', '果然，11月3日当天的选举情况的确像特朗普设想的那样发生了，特朗普在几个尚在点票阶段关键州的选举情况领先并在凌晨匆忙地向支持者们宣布胜选。但随后的点票结果却渐渐偏向于民主党，并最终指向了拜登的选举胜利。此时，特朗普精心炮制数月的阴谋论终于上线了，民主党“窃取”了选举结果！<b>对于特朗普导演地这次选举作弊闹剧，共和党的建制派精英们陷入了犹豫</b>。一方面他们震撼于特朗普毫不掩饰的无耻与自恋扯下了美国政治外表上的“文明”面纱，并认为特朗普的阻碍了他们自己追求权力的道路。另一方面他们又不甘于失去特朗普狂热支持者们的选票。于是乎，以Ted Cruz为代表的共和党政客们对特朗普的阴谋论进行着暧昧的支持，并最终令其发酵为1月6日的冲击国会。', 30, 30),
(110, 101, '<b>尾声与反思</b>', '今天，美国的自由派媒体日复一日地咒骂着特朗普的支持者们是种族主义者，白人至上主义者，法西斯分子，和威权支持者，但却<b>没有思考为什么特朗普能走到这一步，以及为何特朗普的支持者会转向于这些政治观点</b>。正如德国魏玛共和国里失意的底层人民需要犹太人来为他们的悲惨遭遇做替罪羊一样，<b>美国资本主义经济日发增长的不平等与经济危机让走投无路的底层人民们寻求新的“负责人”</b>。一方面他们朦胧地认识到美国腐败的建制政治精英与大企业间的紧密结合推进的资本主义全球化剥削体系与国内的去工业化是他们困境的根源，一方面他们错误地把仇恨放在了普通的移民，少数族裔与“境外势力”上。<b>这种对建制精英的朦胧仇恨与排外种族主义倾向终于为特朗普这样的伪民粹主义小丑铺就了通往权力之路</b>。尽管特朗普任上不断为大企业与富豪减税并任由疫情肆掠使底层民众生活在更为艰难的环境里，但他高超的撒谎技巧与抵赖策略无时无刻都在诱导着民众们去仇视那些“替罪羊”，即少数族裔和社会边缘群体，并将问题都归咎于他们。<b>这样的倒行逆施让部分中间派选民略微认识到了特朗普的本质并导致了他在这次大选中的失败，但却使部分狂热者的仇恨更为疯狂并发展为这次“向国会进军”的主力军。</b>尽管现在看来特朗普似乎失败了，拜登如果对美国新自由主义资本主义经济的延续只会令矛盾更加累积，并在不久的将来召唤出更多的由各种仇恨缝合而成的“怪人”。所以说，<b>拜登的就职绝不意味着尘埃的落定，未来的斗争将是激烈与残酷的。</b>', 30, 30),
(111, 101, '<b>作者按</b>', '今天华盛顿发生的事态是美国历史上史无前例的，<b>从来没有人用这种暴力和决绝的方式强行打断世界上最大的宪政民主国家的选举进程</b>（参议院最终确认选举人投票结果）。毋庸置疑，美国的民主受到了巨大的挑战，华盛顿邮报的评论表示川普应该对今天的国会袭击事件负责并引咎下台。《大西洋月刊》惊呼：这是一场政变！', 30, 30),
(112, 101, '', '暴乱者冲进国会大厦，肆意打砸，安置疑似爆炸物。更有甚者竟然占据参议院讲台，高喊支持特朗普的口号，<b>混乱最终导致有数人伤亡</b>。但是，<b>暴乱者的野蛮行动是徒劳的，他们并不能改变任何事情</b>，特朗普的败选已经是板上钉钉的事实。任凭暴徒们如何捣乱，<b>国会已经决定尊重选举人投票的结果，接下来的事情仅仅是履行程序义务。</b>', 30, 30),
(113, 101, '', '<b>相反，国会大厦事件给了特朗普致命的打击。</b>当天上午，特朗普发表了“拯救美国”的演讲，呼吁到达华府的上万支持者继续战斗。然而，不到两个小时，“拯救美国”变成了“毁灭美国”。由他亲自煽动起来的“铁卫队”干出了超出他预期的暴行。也许<b>特朗普自己都没有想到事态会发展到这种地步，他虽然发推特呼吁他的支持者回家，但他仍然坚持自己赢得了选举。</b>这种言论好比杀人犯谴责自己的行凶的残暴，但依然坚持自己杀人的正当性，对平息事态于事无补。', 30, 30),
(114, 101, '', '至此，广大美国人民彻底认清了特朗普集团的危险性。<b>作为国家最高元首，特朗普事实上拥有不止一支仅向他本人效忠的准军事组织</b>，并且在今天发动了试图抢班夺权的暴动。这已经违反了宪法和政党政治的基本原则。正因此，在今晚重新举行的参议院辩论上，<b>原先一小撮支持特朗普的共和党强硬派也开始发生分裂</b>，副总统彭斯，参议院多数党领袖麦康奈尔反对推翻选举结果。佐治亚州现任参议员共和党人凯利·洛夫勒（在本次佐治亚州参议员竞选中失败）决定放弃她对于选举人团投票结果的反对。她表示今天发生的暴行动摇了她的之前的观点，她认为现在必须重塑人民对选举公正和民主自由的信心。在这些反对声中，特朗普最后的幻想也随之烟消云散了。', 30, 30),
(115, 101, '', '那么，特朗普先生接下来该如之何呢？<b>讽刺的是，他现在的处境真的和义和团运动时的慈禧老佛爷有些许相似</b>。面对于”奉旨造反“的群众，特朗普真是骑虎难下，<b>一方面，他乐见自己的支持者“如此勇猛”</b>，他希望继续利用“民气”为自己博取更大政治利益。<b>另一方面，他心里又极端恐惧，害怕对这些“川卫兵”们失去控制，搬起石头砸了自己的脚。</b>根据特朗普一贯的做风，可以预见，在局势变得不可收拾的时候，他自然会毫无负罪感地“改抚为剿”，一脚踢开这些狂热支持者。这也是<b>川普支持者最可悲的一点，他们选择支持一个没有人情味的利己主义者来实现自己的“美国梦”。</b>', 30, 30),
(116, 101, '', '特朗普的四年统治被国会山的可耻暴行画上了句号。但是<b>特朗普时代不会因为他的下台而终结。巨大的阴影已经投射到美国的方方面面</b>，“激化的党派之争”、“闹剧式的政治表演”、“短视的外交方针”、“急功近利的经济政策”……还有低下的政府执行力所导致的可怕疫情。现在，特朗普这个打开潘多拉魔盒的人已经无足轻重，现在关键的是谁能带领美国人民战胜这些凶相毕露的魔鬼。美国现在需要坚强的领导力，在这样紧急的情况下，即使打破一些常规，做出一些牺牲也是必要的。我们期待美国新一届政府的作为。', 30, 30),
(117, 102, '<b>01 苏伊士运河堵塞导致全球产业链出现较大异常</b>', '全球最大船舶之一“长赐号”(Ever Given)从周二起堵住了苏伊士运河。这艘集装箱货轮被河岸卡住，繁忙的运河上出现了大堵船。这艘巨轮属于长荣海运(Evergreen)，仍在初步调查阶段的参与调查的人士说，调查的重点是一场沙尘暴和一股大约持续两分钟的强风，它可能会无情地将客轮抛离航道。这些知情人士说，正在检查船长和运河管理局的行为，看是否有任何失误，以及可能出现的机械故障。埃及当局也在研究所谓的“河岸效应”——在浅水狭窄水域，大型船只会被水中高低压区域推拉。', 30, 30),
(118, 102, ' ', '船运专家表示，苏伊士运河上出现的堵塞，导致了全球多种商品出现供应问题。相关数据显示，全球海运物流中，约15%的货船要经过苏伊士运河。每天约有30艘重型货船通过苏伊士运河，堵塞一天就意味着5.5万个集装箱延迟交付。德国保险巨头安联集团估算，苏伊士运河堵塞或令全球贸易每周损失60亿美元至100亿美元。苏伊士运河管理方表示，货船可以自行选择等待还是绕行非洲南端的好望角。不过，目前没有船只选择绕行或等待，不确定何时能通行，每天都要付出额外成本；但绕行则意味着要付出数周的额外航程及连带成本。由于对苏伊士运河海运渠道依赖度较高，欧洲市场已明显感受到物流受阻带来的不便。多家欧洲家居、家电零售商均表示有货物堵在运河中，将导致延迟交付。一旦情况迟迟得不到缓解， 可能导致物价上涨。', 30, 30),
(119, 102, ' ', '不仅零售业受到冲击，制造业也一样。国际评级机构穆迪分析，由于欧洲制造业特别是汽车零件供应商，一直奉行“准时制库存管理”以最大化资本效率，不会大量囤积原材料。在这种情况下，物流一旦受阻，可能导致生产中断。疫情冲击下，零售业、制造业原本就是损失较大的行业。随着经济逐步恢复，这些行业刚刚有所恢复，特别是消费者疫情居家期间有改善生活条件的需求，给零售业带来“曙光”，但运河堵塞让零售商一时“无米下锅”。不仅如此，如果堵塞延续，大量货船无法周转，必将导致海运费率提高，增加全球贸易成本，导致连锁反应。去年下半年以来，国际海运市场受集装箱短缺、贸易复苏等因素影响，运力本已经十分紧张，海运价格已处于高位。苏伊士运河堵塞无异于向海运市场“伤口上撒盐”。', 30, 30),
(120, 102, ' ', '另外，也有市场人士担心国际原油及其他大宗商品价格会因苏伊士运河堵塞暴涨。最近几天，国际油价显著上涨。纽约商品交易所5月交货的轻质原油期货和5月交货的伦敦布伦特原油期货价格均已超过每桶60美元。', 30, 30),
(121, 102, '<b>02 知乎上市首日遭冷遇，中概股前景暗淡</b>', '中国在线内容公司知乎(Zhihu Inc., ZH)的股票周五首日上市在华尔街受到冷遇，该股开盘价较发行价跌15.3%。本次上市通过IPO与私募配售，预计知乎将会融资8.5亿美元。但针对知乎首日上市大幅下跌的现象，可分别由内部与外部原因来解释。', 30, 30),
(122, 102, ' ', 'SEC当地时间3月24日公告称，已通过《外国公司问责法案》最终修正案，并征求公众意见。该法案要求，外国发行人连续三年不能满足美国公众公司会计监督委员会对会计师事务所检查要求的，其证券禁止在美交易。该法案最早于2019年3月被提出，旨在要求外国证券发行人确定其不受外国政府拥有或掌控，并要求在美国上市的外国企业遵守美国上市公司会计师监督委员会（PCAOB）的审计标准，否则面临潜在的退市后果。其后，美国国会于2020年12月通过其法案，并在美国前总统特朗普签署后正式生效。根据美富律师事务所(Morrison & Foerster)此前发布的报告，《外国公司问责法案》修正案增加了几项关键要求，包括识别美国公众公司会计监督委员会未能审阅的发行人、禁止交易、解除初始交易禁令、若再次无法审阅则禁止交易五年以及披露政府控股或实际控制。受此影响，早前，中概股遭遇集体“滑铁卢”，腾讯音乐、爱奇艺、贝壳、B站、拼多多、百度等一众互联网明星公司均有大幅下跌。', 30, 30),
(123, 102, ' ', '不过，美国政府推出《外国公司问责法案》最终修正案，有可能引发中概股香港二次上市的热潮，截至今年3月底，已经先后有百度、京东、网易、新东方等共12家中概股成功在香港二次上市。（有关香港2021IPO市场的报道请关注下一期财经专栏报道）', 30, 30),
(124, 102, ' ', '除了大环境，盈利难题也是知乎破发的重要因素。知乎目前的盈利途径主要包括线上广告、付费会员、商业内容解决方案以及其他服务（包括在线教育、电商）四大板块。2020年，知乎上述四业务营收贡献分别为8.43亿、3.21亿、1.36亿和5263万。其中，广告收入占总营收的62.4%，付费会员收入占总营收的23.7%，两者贡献了86%的收入。广告业务仍然是知乎的主要收入支柱。广告无疑是一门好生意，但广告越多意味着用户体验越差，注定是有着天花板的。况且相比于B站、抖音、快手等平台，知乎的用户规模和转化效率要低一个档次。', 30, 30),
(125, 104, ' ', '丰县八孩事件发酵已经一个多月了，据最新消息，江苏省委省政府成立“丰县生育八孩女子”事件调查组，整个事件已经进入最关键的阶段。此前，大量的媒体人不畏威胁，赶赴事发的丰县欢口镇进行调查，当地的居民也陆续提供线索，大量的细节被披露出来。我们现在可以确定的是，原名为小花梅的受害人杨某侠确系被从云南拐卖至丰县，遭受强奸，幽禁等非人待遇，导致精神失常，八个孩子确系杨某侠和犯罪嫌疑人董志民所生。此外，小花梅的遭遇在丰县和整个徐州地区绝非个案，云南籍的被拐卖妇女普遍存在。', 30, 30),
(126, 104, '1. 此事对凝聚社会共识，促进社会改革具有积极作用', '丰县事件所产生的社会影响近年所罕见，可能对法治社会的建设和公民意识的觉醒起到的积极作用。这次事件之所以产生如此激烈的民愤，一方面是因为被拐卖是所有人都可能会遭遇到的危险。 除了犯罪分子和它们的保护伞，所有人的切身利益受到了潜在的威胁。另一方面，在有道德主义传统的中国，拐卖这种丧天良行为的出现也激起了人们对社会失序和道德沦丧的忧虑。 历代王朝对拐卖的惩罚极其严厉“，古代之所以对拐卖采取严刑峻法，正是因为拐卖是礼崩乐坏的体现。 统治者如处置不力，则会在老百姓心目中失去其统治的合法性，因此此事非同小可。', 30, 30),
(127, 104, '<b>历史小贴士，根据大清律法，“凡设方略而诱取良人及略卖良人为奴裨者，杖一百、流三千里；为妻妾、子孙者，杖一百、徒三年。因而伤人者，绞；杀人者，斩。”</b>' , 30, 30),
(128, 104, '正因如此，在一个月的时间里，老百姓团结起来追问真相，任凭你怎么转移矛盾，威逼利诱，挑拨离间，分化瓦解，“甩石头，掺沙子，挖墙脚”、始终咬定青山不放松。 在以往针对社会热点的讨论中那种“屁股决定脑袋”的争吵现在变少了，取而代之的是跨阶级，跨意识形态的社会共识：“解放被拐女性，严惩犯罪分子和失职人员！ 完善女性保护法律，坚决打击奴隶制在21世纪的复辟！”就连一些主流意识形态的吹鼓手如胡锡进也加入了发声的行列，民意不可谓不汹涌。 希望这种共识能够继续下去，变成实实在在的改变，进而将这种“自媒体发现问题—舆论监督问责—促进政府落实—更加公开透明”的模式扩展到社会其他领域。', 30, 30),
(129, 104, ' ','我们应该意识到，虽然近年来互联网受到一定的限制，但是还远没有到“万马齐喑”的程度，相反一些如抖音，视频号等新型平台加快了信息的传播速度（本次事件就是在一次线上直播活动中被曝光）， 自媒体更方便了我们行使舆论监督的权利，实际上的言论空间比我们想象中要大得多。 我们不要被表面的肃杀所吓倒，堕入到自己审查自己的地步，而是要利用各种平台，敢于发声，向一切不义不法之事开战。', 30, 30),
(130, 104, '2. 丰县事件所反映的是强权和官僚体制对人的漠视，对目的和手段的颠倒错位', '过去的两周，中国为来自世界的运动员们制造了一个美丽而又安全的泡泡，运动员在里面快乐地生活，训练，比赛，享受最好的待遇，免受疫情的威胁。 然而在过去的二十多年里，小花梅等妇女被禁锢在一个黑暗而邪恶的泡泡里，受尽苦难，而徐州和丰县的各级干部们也有意地阻止外人知道这一切，就连被拐妇女自救求生的权利也予以剥夺， 自2014年以来，中国裁判文书网上记录了数例徐州被拐卖妇女起诉的离婚案，丰县人民法院的判决均为不予支持离婚。这些女性的绝望，可想而知。', 30, 30),
(131, 104, ' ', '窃以为，这两个泡泡都是中国的代表，它们本质上都是官僚制度的一体两面：当体制需要你的时候，就会对你提供种种便利，任何繁琐的流程都消失了，任何看上去棘手的问题都能迎刃而解，有些服务即使你不想享受都不行，整个人彷佛置于人间天堂一般（置身其中的人很难不对这个“乌托邦”交口称赞）。 可是，一旦这个体制不需要你的时候，那他就会板起面孔，抬出各种规章制度来给你使绊子，即使你的诉求合理合法，它也会置之不理，美其名曰：“我们要按照流程办事，谁都不能搞特殊。”', 30, 30),
(132, 104, ' ', '其实，除了可怜的被拐女性，“不被当人”的命运也会发生在我们每个人身上，就连置身“奥运泡泡”里，一时风光无限的体育明星们也逃不脱被当成“工具人”的命运，无论国籍。', 30, 30),
(133, 104, ' ', '就在上周，俄罗斯花样滑冰明星卡米拉·瓦利耶娃的违禁药物检测呈阳性，一度无法参加比赛。后来瓦利耶娃虽被允许参赛，可身心俱疲的她在正式比赛时发挥失常，遗憾与奖牌擦肩而过。 赛后，无限委屈的瓦利耶娃掩面哭泣，可她的教练埃特里·图特贝里泽严厉地斥责了她的失败。事实很清楚，这个小姑娘无法掌握自己的命运，应该负责的是急功近利的花滑教练和将金牌视为政绩的俄罗斯体育官员。 然而，瓦利耶娃却被当做一枚弃子，等待着被更年轻漂亮的，如同流水线上下来花滑少女们所取代。 无数喜爱瓦利耶娃的中国观众看到这一幕都唏嘘不已（她才十五岁，就可能再也无缘登上奥运的舞台了），进而为中国女孩谷爱凌捏了一把汗。真希望她今后能掌握自己的命运，不要沦为“工具人”啊。', 30, 30),
(134, 104, ' ', '<b>如果我们大家都能意识到官僚体制的两面性，既在它对你的冷酷无情时反对它，又能拒绝它有时对你的过分热情（能做到这一点真的难能可贵）， 与之划清界限，避免成为它的牺牲者或花瓶工具。到了那时，我们就真正在前往自由之精神的路上迈出了一大步。</b>', 30, 30),
(135, 104, '3. 拒绝为罪恶找“客观理由”，但是客观存在的问题也不能忽视。', '丰县的事件，充分反映出中国问题之复杂，现代化进程之任重道远。中国还有五亿多农村人口，其中很多人的生产生活方式和思想观念都还十分落后，解决生计问题是当务之急。 然而，在大城市，人们已经在抱怨现代化的城市生活带来的困扰了。人口多，底子薄，发展不均匀的国情在未来很长一段时间里不会改变。 为此，我们必须承认，处于不同发展水平的人们所面临的问题都是真实而迫切的。 这样的中国好像一只大跨步的雄鸡，后一只脚还陷在前现代的泥沼里拔不出来，前一只脚已经急匆匆地踏入后现代的问题里去了，如果两种问题无法均衡地，妥善地解决，很可能要站立不稳。', 30, 30),
(136, 104, ' ', '然而总的来说，走出古老的“秦制”，彻底实现全民族从生活方式到思想意识的现代化，还是当下的首要任务。因此，我们应该抱有打持久战的毅力，因为未来很可能还会揭露出更加丑恶的现象。 对于解决诸如人口拐卖这类“顽疾遗毒”，也要抱有充分的耐心，因为即使解救了小花梅等一批妇女，同样的悲剧还是普遍存在的。', 30, 30),
(137, 104, ' ', '在这次全民的大讨论中，我们发现了一些需要被指出的问题。', 30, 30),
(138, 104, ' ', '<b>首先，一切应该以法治为准绳，无论是所谓“完美受害人”还是“无奈加害人”都是不可接受的概念。任何罪恶都不能披着“贫穷愚昧”的可怜外衣而被饶恕。 </b>现在有些人过分强调了丰县的贫困导致了男性难以成家的客观因素。实际上，丰县从来不是所谓的“国家级贫困县”，丰县是黄淮平原最早产生人类文明的地方， 历史悠久，名人辈出，甚至还是苏北革命老区，即使算不上富裕，可最近几年也获得了一定的发展。在这样的“文明地带”发生性奴役和大规模人口贩卖是无论如何也不可接受的。', 30, 30),
(139, 104, ' ' , '<b>同时，我们不要因为丰县事件而对中国农村进行整体的妖魔化</b>最近有些情绪激动的网民开始大肆挞伐农村的一切，仿佛乡村自治和宗族就是罪恶的温床，农村人除了摆脱农村别无出路。甚至有些人呼吁国家派武警来踏平涉事村落，枪毙所有包庇者。这种偏激的观点对解决问题毫无益处。中国农村是一个非常特殊的共同体，无数顶尖的学者都被它的复杂程度所困扰，更何况我们这些的普通人呢？因此，我们在发表观点前，有必要了解更多的知识，最起码要读一读费孝通先生的《乡土中国》吧。当我们对历史上的中国农村有一些初步认识，我们会发现农村并非只有黑白两色，而是呈现出多种色彩。一方面，一些乡村的宗族统治确实禁锢了人，家法的滥用制造了很多悲剧。但另一方面，传统中国的经济和文化中心在乡村而不在城镇。自治的乡村巩固了中国的社会基础，减少了中央政府的行政成本。组织有方，温情脉脉的乡村小共同体不仅可以凝聚人心，也对兴办文化公益事业有积极因素。这几年来，很多乡村开展鼓励宗族传统和重建“现代乡贤治理”的运动，不乏成功的案例。', 30, 30),
(140, 104, ' ', '由此可见，乡村自治产生的结果是多方面的，需要具体问题具体分析。它作为一种制度本身并不是丰县悲剧的直接原因。 有关涉事村庄存在包庇人口拐卖现象，并不是取消乡村自治，政府在基层加强权力的理由。反之，集权难道就可以解决问题吗？ 建国以来公权力对于传统乡村结构的全盘瓦解，造成了原子化的社会和普遍的道德价值缺失。近几十年在农村施行的强制计划生育政策导致了严重的男女比例失衡（成婚难的一大原因）。 这些过度集权所导致的恶果，难道对人口买卖的泛滥不负任何责任吗？对某一制度和路径的迷信真是要不得。', 30, 30),
(141, 104, ' ', '作为在美留学生，关注国内社会问题，学以致用推动祖国发展进步，是我们的职责。但与此同时，跻身于中产及中产以上阶层的我们，在审视基层问题的时候，一定要保持谦虚谨慎， 做深入地调查研究，有清晰的问题意识，避免产生机遇特定阶级视角的刻板印象。 如果关注丰县事件没有激发我们像晏阳初和陶行知先生（两位先生均是留美生）那样研究乡村社会经济学，投入乡村建设运动，反而是加强了“农村真是个大粪坑”这种固有观念，那我们不关注也罢。', 30, 30),
(142, 104, '4. 丰县事件给我们很好的反思的机会', '当我们大家对拐卖产业链的巨大黑幕感到恐惧，对小花梅的悲惨遭遇而深表同情的时候，扪心自问，我们自己是否有意无意地成为了“物化女性”和加强性别歧视的帮凶呢？“物化女性”不仅仅是于女性买卖为性奴，而是经常披着日常的，消费主义的的外衣展现在我们面前，时常还令我们津津乐道。比如，游戏里衣着暴露的女性角色， 国产网剧里为争夺男人斗得你死的女性角色，短视频网站上经常出现的“女性穿搭”等软色情内容，哔哩哔哩上广受追捧的跨国恋爱，跨国夫妻节目（通常突出中国男性之于外国女性的主导地位）。 这些迎合男性审美（male gaze）的文娱产品之所以如此有市场，从侧面反映了中国男性普遍接受，甚至享受女性被物化这一社会现实。即使是笔者本人，也不能免俗。', 30, 30),
(143, 104, ' ', '另外，性别上的男女不平等也是结构性的。更可怕的是，性别歧视被正常化得如此之彻底，以至于很多女性和支持女权主义的男性都意识不到要去改变它。这次关于丰县事件的讨论中， 很多人喊出的口号是，“关注真相，严惩拐卖，因为我们每个人都有妻儿。”字里行间的正义的渴望溢于言表。可问题来了，只有当女人作为妻子和女儿的时候，她们的权益才重要吗？当然不是！ 女人是人，而不是男人的附属品。社会道德的建立也不应该由女人的牺牲来完成（贞节牌坊的时代早就过去了！） 然而，现实很残酷，即使是在我们的日常语境中，女性也无法摆脱污名化，实现独立自主。想想我们的汉语，有“女”字旁的贬义字词还少吗？', 30, 30),
(144, 104, ' ', '因此，即使丰县事件在全国人民的谴责下得到彻底的揭露，作恶者得到依法惩处，这也绝不是女性的胜利，而仅仅是她们男权社会的压迫下的一次喘气。 中国人，尤其是男同胞们，必须意识到性别不平等的根深蒂固，除了等待移风易俗和制度建设的完善以外，我们自身还有很多努力的空间。', 30, 30),
(145, 104, ' ', '此外，我们不需否认，中国从古至今就是一个帝国。而帝国的一个特征就是零和性、排他性以及广泛存在于等各领域的不平等现象， 而正是这种等级的差异才是维持帝国统治的关键要素。回顾历史，帝国们的倾轧中，那一次不是女性承受最繁重的劳役和最惨痛的牺牲？ 也因此，推动性别平等不单单是一个简单的社会文化议题，还决定了我们中国能否走出“帝国思维”，接受真正意义上的世界多元化。 现在社会上针对女性解放运动的极端谩骂（如给境外势力递刀子），其实也正反映了一种“帝国候群症”，即一味守旧排他，不反省自身。', 30, 30),
(146, 104, ' ', '“一个不懂反思的老大帝国怎么能真正强大起来？”九十多年前，中国杰出的爱国者，威斯康星大学政治系校友王造时学长就产生了这样的忧虑。在威大四年多的时间里， 他着眼于中国当时的民族危机，结合英美的政治理论，成为了中国的公民民族主义最早的倡导者和实践者（Civic nationalism，一个民族的建立应该基于于每个成员的自我决定， 彼此平等共享政治权力社会契约，无论其人种、肤色、信念、性别、语言或种族如何划分。民族建构和民主政治应该同步进行，爱自己民族的同时不加害别的民族。）', 30, 30),
(147 ,104, ' ', '上述几条意见，仅供参考。总而言之，让我们继续努力吧，去把丰县事件真相彻彻底底地揭露出来，还人间一个公道。另外，千千万万， 让我们持续关注小花梅和每一个被拐卖妇女的后续，关心她们的生活，给她们力所能及的帮助，不要让促进了公民觉醒和社会进步的她们再受苦了。', 30, 30)
;
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
(103, 'img/1_4.jpg', 'Comic about 2020 Election', ' ', 'img'),
(104, 'img/2_1.jpg', 'Comic of Trump by Vox', '图源：Vox', 'img'),
(105, 'img/2_2.jpg', 'Trump\'s supporters gathering outside the Capitol by NBC', '图源：NBC', 'img'),
(106, 'img/2_3.jpg', 'Comic about Trump', ' ', 'img'),
(107, 'img/3_1.jpg', 'Trump\'s supporters gathering outside the Capitol', '', 'img'),
(108, 'img/3_2.jpg', 'ABC\'s White House Video', '（特朗普呼吁其支持者们撤离国会，图源：ABC News）', 'img'),
(109, 'img/3_3.jpg', 'Trump\'s supporters gathering outside the Capitol by ABC', '（特朗普呼吁其支持者们撤离国会，图源：ABC News）', 'img'),
(110, 'img/1_1.jpg', '1', "（来源：澎湃新闻，《红楼梦》插图香菱被拐）", 'img'),
(101, 'img/1_2.jpg', '', '（图源：微博，小花梅被直播时发现）', 'img'),
(102, 'img/1_3.jpg', '', '来源：环球时报：奥运泡泡里的高档餐厅）', 'img'),
(103, 'img/1_4_1.jpg', '', '（来源：环球时报：瓦利耶娃泪洒赛场）', 'img'),
(104, 'img/1_4.jpg', '', '（来源知乎：中国人均GDP分布图）', 'img'),
(105, 'img/1_5.jpg', '', '（来源bilibili：阮玲玉《神女》名场面）', 'img'),
(106, 'img/1_6.jpg', '', '（来源知乎：徽州的古祠堂）', 'img'),
(107, 'img/1_7.jpg', '', '推荐一本学术专著：Masculinity and the New Imperialism, 男子气概和新帝国主义', 'img'),
(108, 'img/1_8.jpg', '', '（王造时学长在威大时的照片）', 'img')
;
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
(106, 100, 106, 7),
(107, 101, 107, 1),
(108, 101, 108, 2),
(109, 101, 109, 3),
(110, 101, 110, 4),
(111, 102, 111, 1),
(112, 102, 112, 2),
(113, 102, 113, 3),
(114, 102, 114, 4),
(115, 102, 115, 5),
(116, 102, 116, 6);

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
(103, 100, 103, 4),
(104, 101, 104, 1),
(105, 101, 105, 2),
(106, 101, 106, 3),
(107, 102, 107, 1),
(108, 102, 108, 2),
(109, 102, 109, 3);

-- --------------------------------------------------------

--
-- Table structure for table `treplies`
--

CREATE TABLE `treplies` (
  `repID` int(11) NOT NULL,
  `repText` text NOT NULL,
  `repcomID` int(11) NOT NULL,
  `repuserID` int(11) NOT NULL,
  `repDate` date NOT NULL,
  `repPriority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(100, '政治', 'Politics', 3),
(101, '财经', 'Business', 0),
(102, '社会', 'Society', 0),
(103, '科技', 'Tech', 0),
(104, '文体', 'Recreation', 0),
(105, '新闻评论', 'Commentary', 0),
(106, '疫情', 'Pandemic', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tusers`
--

CREATE TABLE `tusers` (
  `userID` int(11) NOT NULL,
  `userLName` varchar(50) NOT NULL,
  `userFName` varchar(50) NOT NULL,
  `userPhone` varchar(50) NOT NULL,
  `userGender` int(11) NOT NULL,
  `userUserName` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL,
  `userProfilePic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `tcomments`
--
ALTER TABLE `tcomments`
  ADD PRIMARY KEY (`comID`),
  ADD KEY `comuserID` (`comuserID`);

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
-- Indexes for table `treplies`
--
ALTER TABLE `treplies`
  ADD PRIMARY KEY (`repID`),
  ADD KEY `repcomID` (`repcomID`),
  ADD KEY `repuserID` (`repuserID`);

--
-- Indexes for table `ttypes`
--
ALTER TABLE `ttypes`
  ADD PRIMARY KEY (`tyID`);

--
-- Indexes for table `tusers`
--
ALTER TABLE `tusers`
  ADD PRIMARY KEY (`userID`);

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
-- Constraints for table `tcomments`
--
ALTER TABLE `tcomments`
  ADD CONSTRAINT `tcomments_ibfk_1` FOREIGN KEY (`comuserID`) REFERENCES `tusers` (`userID`);

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

--
-- Constraints for table `treplies`
--
ALTER TABLE `treplies`
  ADD CONSTRAINT `treplies_ibfk_1` FOREIGN KEY (`repcomID`) REFERENCES `tcomments` (`comID`),
  ADD CONSTRAINT `treplies_ibfk_2` FOREIGN KEY (`repuserID`) REFERENCES `tusers` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
