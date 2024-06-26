-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: B5CGM
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP DATABASE IF EXISTS B5CGM;
CREATE DATABASE B5CGM;

GRANT ALL PRIVILEGES ON B5CGM.* To 'aatu'@'localhost' IDENTIFIED BY 'Kiiski';
USE B5CGM;
--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `gameid` int(11) DEFAULT '0',
  `time` datetime NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39191 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `fx_helpmessages`
--

DROP TABLE IF EXISTS `fx_helpmessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fx_helpmessages` (
  `messageid` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `HelpLocation` varchar(200) NOT NULL,
  `HelpImage` varchar(200) NOT NULL,
  `nextpageid` int(11) NOT NULL,
  PRIMARY KEY (`messageid`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(400) NOT NULL,
  `accesslevel` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=210 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Dumping data for table `player`
--

LOCK TABLES `player` WRITE;
/*!40000 ALTER TABLE `player` DISABLE KEYS */;
INSERT INTO `player` VALUES (1,'chrome','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(2,'opera','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(3,'player1','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(4,'player2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(5,'Tadrac','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(6,'Popo','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(7,'Fred','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(9,'Fred2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(10,'Zero','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(11,'Zero2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(12,'Todd','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(13,'Todd2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(14,'Shalbatana','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(15,'Shalbatana2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(16,'Kitep','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(17,'Kitep2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(18,'Katoc','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(19,'Katoc2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(20,'valthonis','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(21,'valthonis2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(22,'Raevynwilder','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(23,'Raevynwilder2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(24,'Kizarvexis','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(25,'Kizarvexis2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(26,'Arcanis','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(27,'Arcanis2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(28,'Narsham','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(29,'Narsham2','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',0),(30,'Jazz','*0F859FF011F576603BB5CDB7A43D9229C65FC464',0),(31,'Chris','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',1),(32,'wolfgang','*D4D2AD7CD086014BE0A963B46406554549ACE715',1),(33,'Aatu','*AD4B130CF51B5878091C40707F83DE48AE8F0D9C',5),(34,'Virthkinis','*9B147F283F5D293F83C6D833CAD4969E1C06E7DD',1),(35,'Ragnarok','*C2464A298FA2365053565756F354C3B889E2376F',1),(36,'Ragnarok2','*C2464A298FA2365053565756F354C3B889E2376F',1),(37,'Demos','*215DE1B3B26E2AB71933E1000BBF6AAF5C64E87E',1),(38,'Stad','*5A6050955CC014444D755DBB12B48A0E1AF04858',1),(39,'Traven','*CDD22C6B061E25AAA2D7BC7478BFE436B369F851',1),(40,'TomB','*4221298BF6921847ECE6D64F441B360DDCA3539E',1),(41,'Jal','*AE98BC9037F16C478813A5F40ED008A27C5C88F5',1),(42,'MrD','*9BB37EFA7815B20EC0874FE9F9918A81260DEC36',1),(43,'onefromb5','*36D810C8F5D2FBF8EE720AE837FD0A95062563CC',1),(44,'ancient history','*42F59D77BFCC0F5C6AC564D06990F0CE99BBCD24',1),(45,'krieg','*94DD126F947C3CA7FA19A59AB6D6033FF6F462EF',1),(46,'the5thchild','*5F9E0650AC0416D617EF479FFD6DA204EBADA9C4',1),(47,'JGurnett617','*668425423DB5193AF921380129F465A6425216D0',1),(48,'Abraxas','*7B2F14D9BB629E334CD49A1028BD85750F7D3530',1),(49,'kmunoz','*2F996C12BD5208AFE4A03EA93BC8C4CB6913D75E',1),(50,'BodoMe','*C0DF3E00B1DADD8C30048C1F94A88B1210380E12',1),(51,'guest','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',1),(52,'JGurnett','*A99817C01F6C154FF07288E12B72BDBCCF6C3B2E',1),(53,'llre','*A5A0FF3DF591C9938CB8B65A1F85802F89D067BC',1),(54,'kitep3','*BAD53AECCBFBDCCE67B366B98F84BDC924554DD2',1),(55,'Smash_kirby','*70A8C23DEF27115884556E99A6B024B37A82E39E',1),(56,'Blackstreak','*8576F730DE89917DF339682EE9D46B0C363123C7',1),(57,'RoyStevens','*BAD53AECCBFBDCCE67B366B98F84BDC924554DD2',1),(58,'B1ackstreak','*25A64B67AE048F6781689BBFC8A46306D7D33901',1),(59,'Atrocity','*C2464A298FA2365053565756F354C3B889E2376F',1),(60,'Somanic','*1D9F08F708D896AF495013CEC5E23F6347B148EE',1),(61,'Zero1627','*2D1C013BC03EEE77CFC30FA91618B6008F8BCC9F',1),(62,'TokyoDan','*49FD0BA365A82630EDBE61DF7A2CFEF2FAE2A926',1),(63,'fisheyedbunny','*7F240604F9B53DB05DE904D37ACD77C72A1A1F1F',1),(64,'demiurge','*B29166EC6204C80C230F046923A685F5FEE961C2',1),(65,'Kevin','*5163B00CA789B7A7C9D4EAE6F2BDB699A360F38D',1),(66,'amr83','*2CCDA1DAE0A6F2851DFB9E310DEC7155D288A036',1),(67,'Catslaughing','*5F4A022B19707C851BC2280B1EE49998C9D3CC60',1),(68,'GrimJim','*624F37A95A6D0D24C451D8FA2368A14F037596D8',1),(69,'ATN082268','*2B3A56AC393B8B984881A7D056F8970B0F57530F',1),(70,'Cannotcope','*5F4A022B19707C851BC2280B1EE49998C9D3CC60',1),(71,'bluebirds42','*4EB3827A886DFB80E7CCE58238BB9CBE75BB7D66',1),(72,'iceman','*5D04C2E7A05F358E83E2BF4D3DF7B88D7AA9161E',1),(73,'chrismata','*D3CEEC3649424F98548D25BCBEF3BD2F79BFB121',1),(74,'sisetpasheri','*30E1A35F15ABF88D55E6820A6A856AE6A2BC4077',1),(75,'Faulkenburg','*DF98A2F5A35E43189CB267C40DA185CECBC79BA0',1),(76,'Keflar','*661914C8ABBABCFE4793AB5F8CE149C82DC99382',1),(77,'Wildcat','*CEAED60B8E0767F9D5043A59A9F970F648EB4430',1),(78,'foorke','*EA04B325D5E430FF2F3BDDC6E6164C5CF7E8974E',1),(79,'angelicus','*E18DD60013F19D445D530C5EBBE89DA9AAB93FFA',1),(80,'KoenGeeraerts','*313B7811D1849CEA1C10345DBF2D0F32FEA0392E',1),(81,'Sebastiaan Stevens','*E9C4136B63E1F5BC4C51CA5895DDD98E2067E29A',1),(82,'Foi','*3BBE534C6F3094E94A69E7460005A752FCD6D743',1),(83,'JohnGurnett','*3BA49D9289DEB1480884D44BC81AE29D79514CBF',1),(84,'Selso Zaghloul','*5DFE89E6B3AC96276F3CADBD97C4DB815C4C866B',1),(85,'Paul A. Bester','*861B1B1D5B7FE7D408673D2AC8FCB03A99D52035',1),(86,'Phrisbee','*E87E1AB2B20C051F0E3CBD801DACC9E467118246',1),(87,'nnevala','*B4FFCD40061C8B218AF0233276E44A0BF05A46A8',1),(88,'Arnold','*81B766D5B59F247972DE747F54A9501A0D8DFE45',1),(89,'TheNetherlord','*23F74EEFE7008EE224746B1E5FC7851D4BC5628A',1),(90,'TheNetherlord2','*AA0D6B52CC82E6B3E1ED3ED7B35D12EF7F0D3E42',1),(91,'Drylyyx','*E56A114692FE0DE073F9A1DD68A00EEB9703F3F1',1),(92,'Akil','*E159DE73DC4A3B16BD0F25CC2EEBEEFEC0418B2A',1),(93,'Vance','*88AA22555157BF63DFA246BDD74E5D400AF8911C',1),(94,'dhargyal','*F96A47C4E91C536C76B5DC886891F505637BD67C',1),(95,'Stefan','*7EF9D54953DCC8CDD8DAD750A774C87A0B99884F',1),(96,'tester1','*72A446F69ED6E2F6B57F7B1D521E315D22DBD86C',1),(97,'Atrocity2','*C2464A298FA2365053565756F354C3B889E2376F',1),(98,'LukOkkerse','*0EB98DBA490E4FF48F6652ECEA3736BA64871930',1),(99,'Luk2Okkerse','*0EB98DBA490E4FF48F6652ECEA3736BA64871930',1),(100,'JustinKase','*CD89F71BF229E1CDC65318D54CDA9F466AE1AA77',1),(101,'Justin Kase','*CD89F71BF229E1CDC65318D54CDA9F466AE1AA77',1),(102,'vim187','*7EE105418808560F5633B766E2BBF7B56D105951',1),(103,'Ian','*5DE4C38779F81E1CC765C57D9D816B3CBD13C3F2',1),(104,'malkav','*C1FFFC29209CD3E8A994FD92BA1C8C9F9F65F829',1),(105,'Jakaal','*5F63FD561A608E663BB73DD67D281ACEAE34824E',1),(106,'petor123','*753ED076EBDBD39A061D261F0E783BD908B492FE',1),(107,'Nik_Coppens','*820BF3F2C62CC074CE2F66B560C5A6F90EA779CC',1),(108,'Alex Cookson','*1D91204A9CAAD8E04801DA3A1C5C8AF1EEF58E1E',1),(109,'wisnoskij','*576EE5B74C20E68F2A5A240F3E408E6DE43DD73F',1),(110,'Londo','*5F63FD561A608E663BB73DD67D281ACEAE34824E',1),(111,'Levarith','*0DEA769E509C1D9EEFC2F37A71F20884D52DC8E3',1),(112,'Winterborn','*E35AC078B6C159384961D391C16C860ACA824BCC',1),(113,'GoreChild','*4356F7C21B1D729B3042DD34FE5336B0BCD05A7F',1),(114,'ChrisDaPra','*4356F7C21B1D729B3042DD34FE5336B0BCD05A7F',1),(115,'Father0915','*3296BD68E419D2EB4364FDBFC5B1FCAA6D10691B',1),(116,'badgerlord1649','*72A7AA5DBDA1B0AA1A2F2CC83BC4FC0AC99938C7',1),(117,'Lucienne Vindevogel','*AFE4D8A316D7540FB5975A6357A23175A7185FCB',1),(118,'GodHead','*4BDA07FCC07BCBCB31136BADD08D03872AC52F50',1),(119,'Zuxsion','*3918CBD388D14A1CC4408F7F8A633115AC4C808D',1),(120,'JamesBarry','*1F785E756DC4C02C29182617A713A75BF5EA8E1D',1),(121,'Garfield','*895B24E5429C85FE0201B1F50FD89E5FA87484E5',1),(122,'Tolga','*BD57420D8A8B3558065D3078B1BC461ED39D08C1',1),(123,'sollieus','*916D2A4935407F2381B009BA2A289364FA8851D6',1),(124,'tolga2','*BD57420D8A8B3558065D3078B1BC461ED39D08C1',1),(125,'turgon99','*FB9AD8956398F823D3AE3FD5AE155771659BC475',1),(126,'Lamoix','*5CEF639D002666BBA9F3E2E3CF872BC9EF74B271',1),(127,'nomosolo','*028507EA7C6C0B3EFE236D8AF08DF7AE94DDC6AD',1),(128,'JonG','*7F1E08C0B0FF5FA86D9EF2F469D90FDAD63CEADB',1),(129,'Warhorse8','*F37BBE3040C18615CAF565CE1FAEECA38CECA1AF',1),(130,'Warhorse9','*F7D992B7A5B7222B252E5797EFFFC1FAC2DA6664',1),(131,'Naranekk','*8A6B4EE78651358CF62A680F01BE9E76EDD0CBF5',1),(132,'Ragnar0k','*8A6B4EE78651358CF62A680F01BE9E76EDD0CBF5',1),(133,'jazz_test','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',1),(134,'ctcharger','*38F9D45E602BF81DE5DF719B08B66CEB0B6B31AA',1),(135,'JoostvR','*4128D88CC226A794BA41232D0FC7A7FA13B89055',1),(136,'Vartanil','*2D8B2CD2B550137FE9F04BB39F5F9823269A60E0',1),(137,'BadBoy007','*96E5BDB324BDE281E20AD91809EDAE613017BFF3',1),(138,'TKSolway','*640B11329CAEDEEFCF1244D970297C3747A83CBC',1),(139,'Draxxel Bane','*044A73182572985A811A7DEFDDD2245D5C3BFC3B',1),(140,'eddyl','*6908CAE1A03598125322F4D4CA6B254FF1907A6D',1),(141,'anyGould','*2C805F4C7338D628716B77B81ADAD701F8E02F67',1),(142,'DraxxelBane','*900BFECA1C479F22C7F61191FBA43C032A17263E',1),(143,'Kezerk','*6C7E003EC8AC7F7B291DEA0245BECC5B6E86123A',1),(144,'Kez2','*6C7E003EC8AC7F7B291DEA0245BECC5B6E86123A',1),(145,'heikkip','*DC42990E70F578DDB8717D648311AB379EADC8CE',1),(146,'fyenix','*B5D2D18BB0AD7DD2E01337FBBF9E072EDB5B35C5',1),(147,'Ruwon','*640B11329CAEDEEFCF1244D970297C3747A83CBC',1),(148,'MickeyP2K','*2CD721940628C06D9EA046905EF1BF4AC5C1397F',1),(149,'TestMike','*2CD721940628C06D9EA046905EF1BF4AC5C1397F',1),(150,'Anjin','*4B146100CA749A7B04DAFE8EC9047380943639C5',1),(151,'Sgt Looney','*56AB6B37D97610EA3004053D4BAF851D200D21ED',1),(152,'gfc1963','*CE39B3336CE13FA8E06E3EB8EAF909772773BB80',1),(153,'Zathras23','*F63B2E4C41386513471C833B5230DAF3D899FFEB',1),(154,'jbarson','*2E0A391AACB958B6D37C723315360D511E97738D',1),(155,'PinkPhantom','*2965D3AB8AAE08B9DA9C88377C5BDC63CE5AF2E6',1),(156,'seekingwittyid','*88AAFCBD12916BD548258B8385E2C70A7E14822D',1),(157,'Maserati','*1B68B74980A965BE66B198EE547D845EFCAD40F9',1),(158,'Herc Warrior','*02C22BE64B8154719F09D4F9AB76916798FF1A8E',1),(159,'fish048','*BE0C8BFB2F06ABD5D9044565E223B217A116B341',1),(160,'zaarin7','*0D50BF7BFA1D2A0CD5618403DA26CA75FB4F1B05',1),(161,'ElPresidente','*563AFF5CA5D291DD00CE2B6FFAFE755990DE64ED',1),(162,'tsolway','*640B11329CAEDEEFCF1244D970297C3747A83CBC',1),(163,'Dioctrium','*DB51B08F47CF401D86C369A55C72E06B673E2A65',1),(164,'Streen','*0DE1A9F6B35A23F95C8BAF310661AE1929F050A4',1),(165,'Batrachian','*0DE1A9F6B35A23F95C8BAF310661AE1929F050A4',1),(166,'Sath','*3D8C72AB836A0549044A055263CEC2727250818F',1),(167,'Lloth','*91D70B1A27857A67CDCD73F7D043E9484E34B247',1),(168,'CarlZog','*25D8C3CBF14A7389EBE0CD7ACCAD1503A7D76C3F',1),(169,'strangelooper','*BB265FFDE63EB81B3AB710B5EC0451FF5A0B39A9',1),(170,'loopstranger','*BB265FFDE63EB81B3AB710B5EC0451FF5A0B39A9',1),(171,'Babcom','*D39FB77EB0EA518CF9973F0F7CD7F47957F0244D',1),(172,'NeilP','*BB265FFDE63EB81B3AB710B5EC0451FF5A0B39A9',1),(173,'RoyC','*02821D8D31D84929A855F741CF08616A8FD22C81',1),(174,'Shakle','*7393533C38C19B15D308A734D43526324D92E92B',1),(175,'JoshA','*F969DCDD31F2F41F04EEEEB70288E1423F09E5D4',1),(176,'GregD','*0971389F8E7F1AEB999104BDA7A0FA145087F348',1),(177,'Philtastic','*B999154F2F8FE743341645879CBE5AA47596B97D',1),(178,'KevinH','*A40512856A21738E62A4DAFF2188983671933B91',1),(179,'evildoughboy','*955E3077A776E49E051597026A52018829A29872',1),(180,'Teufelted','*870DF77AA3F8301EEC68721D4F8349B2750C6283',1),(181,'Dirt Hanf','*A0682554C8D7297CBEAF8AD0C663F4C4B251E2AB',1),(182,'GregoryD','*109CEBF115DF8BB5BC0FEAD68286835C19B2513B',1),(183,'TijiRikimaru','*A0682554C8D7297CBEAF8AD0C663F4C4B251E2AB',1),(184,'alD','*5F4782CBD483A3911D2065DF442728570EE0FFCB',1),(185,'TedWin','*FB03E78CD67298818A315367AA568C5F555DE0FF',1),(186,'Gegner','*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19',1),(187,'Deadlikeme','*541E89C97480FD9881DDA58E51D92F86D66EB38C',1),(188,'gstano','*12FAAB51B036B87DA14B125871065E7BA5ED26B0',1),(189,'Docmani','*B1F03EAB0886510F134961C68CB8CD8E548C4C21',1),(190,'drpatient','*B1F03EAB0886510F134961C68CB8CD8E548C4C21',1),(191,'demonkiwi','*731E63DCF93A4625E914BDF2528528760744EC9D',1),(192,'Derteufel','*1235439EDEA8A62FE127C294D281180F93C33C1E',1),(193,'byrn','*5E65EC36B5FB8AB853D166A018303EE65B8D130B',1),(194,'baron','*72DB611DAF9607168FF092FA5BCA3A4FE039BCE7',1),(195,'Dwain','*F33BF8010894ACFDA73B5127C8CF6BB18409FEAB',1),(196,'Royc1','*8E8C44270C4F2F2FC64F886AA7406C222730499C',1),(197,'Zero1627_2','*B69027D44F6E5EDC07F1AEAD1477967B16F28227',1),(198,'RC1','*02821D8D31D84929A855F741CF08616A8FD22C81',1),(199,'jbarrett','*5D66BF3071EC6162BB799A0CD77C0B8724FD958D',1),(200,'mmitchel','*34C06246052A3D7D265508326600599AF4E04D11',1),(201,'testmsaw','*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29',1),(202,'Raptor','*90948D1703C0573A3643054E576F68F1FCC40073',1),(203,'Bin','*CCFEC9B786E6F5289148E23F7C0EF034E619F265',1),(204,'jtstano','*E041FB9DDD50077135956CF9CEADEDB4966D94F8',1),(205,'Heythatsme','*99F870F1D5F7A2EB9E1CEBFC5B0A8054FD6C9906',1),(206,'Andromus','*3D853ECE89F299930EA622D95BF3E52BD41D2E1A',1),(207,'Zero1627X','*2D1C013BC03EEE77CFC30FA91618B6008F8BCC9F',1),(208,'dragonfly','*F9EC77098C5235718A0C705AE1205E0A2312D54F',1),(209,'dragonfly2','*F9EC77098C5235718A0C705AE1205E0A2312D54F',1);
/*!40000 ALTER TABLE `player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `player_chat`
--

DROP TABLE IF EXISTS `player_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `player_chat` (
  `playerid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `last_checked` datetime DEFAULT NULL,
  PRIMARY KEY (`playerid`,`gameid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `tac_ammo`
--

DROP TABLE IF EXISTS `tac_ammo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_ammo` (
  `shipid` int(11) NOT NULL,
  `systemid` int(11) NOT NULL,
  `firingmode` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `ammo` int(11) NOT NULL,
  `turn` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`gameid`,`shipid`,`systemid`,`firingmode`,`turn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tac_enhancements`
--

DROP TABLE IF EXISTS `tac_enhancements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_enhancements` (
  `gameid` int(11) NOT NULL,
  `shipid` int(11) NOT NULL,
  `enhid` varchar(10) NOT NULL,
  `numbertaken` int(11) NOT NULL,
  `enhname` text(50) NOT NULL,
  PRIMARY KEY (`gameid`,`shipid`,`enhid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tac_critical`
--

DROP TABLE IF EXISTS `tac_critical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_critical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL,
  `shipid` int(11) NOT NULL,
  `systemid` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `turn` int(11) NOT NULL,
  `turnend` int(11) NOT NULL DEFAULT 0,
  `param` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `shipid` (`shipid`)
) ENGINE=InnoDB AUTO_INCREMENT=44475 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_damage`
--

DROP TABLE IF EXISTS `tac_damage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_damage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `systemid` int(11) NOT NULL,
  `turn` int(11) NOT NULL,
  `damage` int(11) NOT NULL DEFAULT '0',
  `armour` int(11) DEFAULT '0',
  `shields` int(11) DEFAULT '0',
  `fireorderid` int(11) NOT NULL,
  `destroyed` tinyint(1) NOT NULL DEFAULT '0',
  `undestroyed` tinyint(1) NOT NULL DEFAULT '0',
  `pubnotes` text,
  `damageclass` tinytext,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `shipid` (`shipid`)
) ENGINE=InnoDB AUTO_INCREMENT=412134 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_ew`
--

DROP TABLE IF EXISTS `tac_ew`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_ew` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL,
  `shipid` int(11) NOT NULL,
  `turn` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `amount` int(11) NOT NULL,
  `targetid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `shipid` (`shipid`)
) ENGINE=InnoDB AUTO_INCREMENT=309637 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_fireorder`
--

DROP TABLE IF EXISTS `tac_fireorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_fireorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL DEFAULT 'normal',
  `shooterid` int(11) NOT NULL DEFAULT '0',
  `targetid` int(11) NOT NULL DEFAULT '0',
  `weaponid` int(11) NOT NULL DEFAULT '0',
  `calledid` int(11) NOT NULL DEFAULT '0',
  `turn` int(11) NOT NULL DEFAULT '0',
  `firingmode` int(11) NOT NULL DEFAULT '0',
  `needed` int(11) NOT NULL DEFAULT '0',
  `rolled` int(11) NOT NULL DEFAULT '0',
  `gameid` int(11) NOT NULL,
  `notes` text NOT NULL,
  `shotshit` int(11) NOT NULL DEFAULT '0',
  `shots` int(11) NOT NULL DEFAULT '1',
  `pubnotes` text NOT NULL,
  `intercepted` int(11) NOT NULL DEFAULT '0',
  `x` varchar(10) NOT NULL DEFAULT 'null',
  `y` varchar(10) NOT NULL DEFAULT 'null',
  `damageclass` tinytext,  
  `resolutionorder` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `shooterid` (`shooterid`),
  KEY `weaponid` (`weaponid`)
) ENGINE=InnoDB AUTO_INCREMENT=490359 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_flightsize`
--

DROP TABLE IF EXISTS `tac_flightsize`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_flightsize` (
  `entry` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) DEFAULT NULL,
  `shipid` int(11) DEFAULT NULL,
  `flightsize` int(11) DEFAULT NULL,
  PRIMARY KEY (`entry`)
) ENGINE=InnoDB AUTO_INCREMENT=2536 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_game`
--

DROP TABLE IF EXISTS `tac_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `turn` int(11) DEFAULT NULL,
  `phase` int(11) DEFAULT NULL,
  `activeship` varchar(4000) default '-1',
  `background` varchar(200) DEFAULT NULL,
  `points` int(6) DEFAULT '1000',
  `status` varchar(45) NOT NULL DEFAULT 'LOBBY',
  `slots` int(11) NOT NULL DEFAULT '2',
  `creator` int(11) DEFAULT NULL,
  `submitLock` datetime DEFAULT NULL,
  `gamespace` varchar(45) DEFAULT NULL,
  `rules` varchar(400) DEFAULT '{}',  
  `description` text ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3670 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_iniative`
--

DROP TABLE IF EXISTS `tac_iniative`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_iniative` (
  `gameid` int(11) NOT NULL,
  `shipid` int(11) NOT NULL,
  `turn` int(11) NOT NULL,
  `iniative` int(11) DEFAULT NULL,
  PRIMARY KEY (`gameid`,`turn`,`shipid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tac_playeringame`
--

DROP TABLE IF EXISTS `tac_playeringame`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_playeringame` (
  `gameid` int(11) NOT NULL,
  `slot` int(11) NOT NULL DEFAULT '0',
  `playerid` int(11) DEFAULT NULL,
  `teamid` int(11) DEFAULT '0',
  `lastturn` int(11) DEFAULT '0',
  `lastphase` int(11) DEFAULT '0',
  `lastactivity` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `submitLock` datetime DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `depx` decimal(10,0) DEFAULT NULL,
  `depy` decimal(10,0) DEFAULT NULL,
  `deptype` varchar(45) DEFAULT NULL,
  `depwidth` int(11) DEFAULT NULL,
  `depheight` int(11) DEFAULT NULL,
  `depavailable` int(11) DEFAULT NULL,
  PRIMARY KEY (`gameid`,`slot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_power`
--

DROP TABLE IF EXISTS `tac_power`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_power` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL,
  `systemid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `turn` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`),
  KEY `shipid` (`shipid`)
) ENGINE=InnoDB AUTO_INCREMENT=152404 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_ship`
--

DROP TABLE IF EXISTS `tac_ship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playerid` int(11) NOT NULL,
  `tacgameid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phpclass` varchar(45) NOT NULL,
  `rolling` tinyint(1) NOT NULL DEFAULT '0',
  `rolled` tinyint(1) NOT NULL DEFAULT '0',
  `campaignX` int(11) DEFAULT NULL,
  `campaignY` int(11) DEFAULT NULL,
  `campaigngameid` int(11) DEFAULT NULL,
  `slot` int(11) NOT NULL DEFAULT '0',
  `enhvalue` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gameid` (`tacgameid`)
) ENGINE=InnoDB AUTO_INCREMENT=28910 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tac_shipmovement`
--

DROP TABLE IF EXISTS `tac_shipmovement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_shipmovement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(45) DEFAULT NULL,
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `xOffset` int(11) NOT NULL DEFAULT '0',
  `yOffset` int(11) NOT NULL DEFAULT '0',
  `speed` int(11) DEFAULT NULL,
  `heading` int(11) DEFAULT NULL,
  `facing` int(11) DEFAULT NULL,
  `preturn` int(11) DEFAULT NULL,
  `requiredthrust` text,
  `assignedthrust` text,
  `turn` int(11) NOT NULL DEFAULT '1',
  `value` varchar(100) NOT NULL DEFAULT '0',
  `at_initiative` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`shipid`,`gameid`),
  KEY `gameid` (`gameid`)
) ENGINE=InnoDB AUTO_INCREMENT=1336799 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `tac_individual_notes`
--

DROP TABLE IF EXISTS `tac_individual_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_individual_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameid` int(11) NOT NULL DEFAULT '0',
  `turn` int(11) NOT NULL DEFAULT '1',
  `phase` int(11) NOT NULL DEFAULT '1',
  `shipid` int(11) NOT NULL,
  `systemid` int(11) NOT NULL,  
  `notekey` varchar(40) DEFAULT '',
  `notekey_human` varchar(40) DEFAULT '',
  `notevalue` varchar(100) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `gameid` (`gameid`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



--
-- Table structure for table `tac_systemdata`
--

DROP TABLE IF EXISTS `tac_systemdata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tac_systemdata` (
  `systemid` int(11) NOT NULL,
  `subsystem` varchar(45) NOT NULL,
  `gameid` int(11) NOT NULL,
  `shipid` int(11) NOT NULL,
  `data` text,
  `turn` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`systemid`,`subsystem`,`gameid`,`shipid`, `turn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-11 15:13:05
