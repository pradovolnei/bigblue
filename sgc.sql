/*
SQLyog Ultimate v10.42 
MySQL - 5.7.17 : Database - sgc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `atendimentos` */

DROP TABLE IF EXISTS `atendimentos`;

CREATE TABLE `atendimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proc` int(11) DEFAULT NULL,
  `id_plano` int(11) DEFAULT NULL,
  `id_paciente` int(11) DEFAULT NULL,
  `nome_paciente` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_atendente` int(11) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL,
  `data_abertura` datetime DEFAULT NULL,
  `data_agendada` datetime DEFAULT NULL,
  `data_encerramento` datetime DEFAULT NULL,
  `obs_paciente` text COLLATE utf8_unicode_ci,
  `obs_clinica` text COLLATE utf8_unicode_ci,
  `resultado` text COLLATE utf8_unicode_ci,
  `laudo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avaliacao` float DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nota` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_at_plano` (`id_plano`),
  KEY `fk_at_paciente` (`id_paciente`),
  KEY `fk_at_atendente` (`id_atendente`),
  KEY `fk_at_proc` (`id_proc`),
  KEY `fk_at_cli` (`id_clinica`),
  CONSTRAINT `fk_at_atendente` FOREIGN KEY (`id_atendente`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_at_cli` FOREIGN KEY (`id_clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_at_paciente` FOREIGN KEY (`id_paciente`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_at_plano` FOREIGN KEY (`id_plano`) REFERENCES `plano` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_at_proc` FOREIGN KEY (`id_proc`) REFERENCES `procedimento` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123457 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `atendimentos` */

insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (3,3,NULL,2,'volnei',NULL,1,'2019-06-26 14:24:42','2019-06-27 16:30:00',NULL,'Teste','',NULL,NULL,NULL,'Cancelado',4);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (4,8,1,2,'volnei',NULL,1,'2019-06-26 18:25:32','2019-06-28 15:00:00','2019-06-27 16:22:49','Teste','falha',NULL,NULL,NULL,'Cancelado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (5,3,2,2,'volnei',NULL,1,'2019-06-27 15:39:00','2019-07-01 13:00:00','2019-06-27 16:03:17','teste cancelar','',NULL,NULL,NULL,'Cancelado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (6,3,NULL,2,'volnei',NULL,1,'2019-06-28 10:33:46','2019-07-04 11:30:00',NULL,'','teste','teste',NULL,NULL,'Realizado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (7,3,NULL,NULL,'Ronaldo Fenomeno',3,1,'2019-06-28 11:19:41','2019-08-02 22:00:00',NULL,'','sss','O resultado é....',NULL,NULL,'Realizado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (8,1,NULL,NULL,'Ronaldinho Gaucho',3,1,'2019-06-28 11:23:51','2019-08-05 11:28:00',NULL,'','aaa','O resultado é....',NULL,NULL,'Realizado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (9,1,NULL,NULL,'Jon Snow',3,1,'2019-06-28 11:25:24','2019-07-03 20:00:00',NULL,'','aaa','O resultado é....','pages/laudos/anexos/laudo_9.docx',NULL,'Realizado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (10,1,NULL,NULL,'Son Goku',3,1,'2019-06-28 11:26:47','2019-07-04 12:57:00',NULL,'','ssss','O resultado é....','pages/laudos/anexos/laudo_10.docx',NULL,'Realizado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (11,3,2,2,'volnei',NULL,1,'2019-06-28 11:39:44','2019-07-05 14:00:00',NULL,'','ccc','O resultado é....',NULL,NULL,'Realizado',4);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (13,3,1,NULL,'Ronaldinho Gaucho',3,1,'2019-06-28 13:46:31','2019-07-22 13:00:00',NULL,'','',NULL,NULL,NULL,'Atendimento Confirmado',NULL);
insert  into `atendimentos`(`id`,`id_proc`,`id_plano`,`id_paciente`,`nome_paciente`,`id_atendente`,`id_clinica`,`data_abertura`,`data_agendada`,`data_encerramento`,`obs_paciente`,`obs_clinica`,`resultado`,`laudo`,`avaliacao`,`status`,`nota`) values (123456,1,NULL,2,'volnei',3,1,'2019-06-28 13:33:46','2019-07-25 13:00:00',NULL,'','',NULL,NULL,NULL,'Atendimento Confirmado',NULL);

/*Table structure for table `chamados` */

DROP TABLE IF EXISTS `chamados`;

CREATE TABLE `chamados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `mensagem` text COLLATE utf8_unicode_ci,
  `id_tratador` int(11) DEFAULT NULL,
  `resposta` text COLLATE utf8_unicode_ci,
  `data_envio` datetime DEFAULT NULL,
  `data_resposta` datetime DEFAULT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_call_user` (`id_usuario`),
  KEY `fk_call_atend` (`id_tratador`),
  CONSTRAINT `fk_call_atend` FOREIGN KEY (`id_tratador`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_call_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `chamados` */

insert  into `chamados`(`id`,`id_usuario`,`mensagem`,`id_tratador`,`resposta`,`data_envio`,`data_resposta`,`status`) values (1,2,'teste',2,'respondendo','2019-06-27 14:14:54','2019-06-27 15:16:09','Fechado');

/*Table structure for table `chat` */

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `id_remetente` int(11) DEFAULT NULL,
  `id_receptor` int(11) DEFAULT NULL,
  `mensagem` text COLLATE utf8_unicode_ci,
  `data` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  KEY `fk_remetente` (`id_remetente`),
  KEY `fk_receptor` (`id_receptor`),
  CONSTRAINT `fk_receptor` FOREIGN KEY (`id_receptor`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_remetente` FOREIGN KEY (`id_remetente`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `chat` */

insert  into `chat`(`id_remetente`,`id_receptor`,`mensagem`,`data`,`status`) values (3,2,'teste','2019-07-02 15:03:41',NULL);
insert  into `chat`(`id_remetente`,`id_receptor`,`mensagem`,`data`,`status`) values (2,3,'aaa','2019-07-02 15:03:59',1);
insert  into `chat`(`id_remetente`,`id_receptor`,`mensagem`,`data`,`status`) values (3,2,'mais um teste\\sdasdasdasdasdsafdsghgfhfghdfgdfg','2019-07-02 15:56:26',NULL);
insert  into `chat`(`id_remetente`,`id_receptor`,`mensagem`,`data`,`status`) values (2,3,'isso','2019-07-02 15:58:43',1);
insert  into `chat`(`id_remetente`,`id_receptor`,`mensagem`,`data`,`status`) values (2,3,'TESTE 10','2019-07-02 16:53:24',1);

/*Table structure for table `cidades` */

DROP TABLE IF EXISTS `cidades`;

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `cidades` */

insert  into `cidades`(`id`,`nome`,`uf`) values (1,'Rio de Janeiro','RJ');
insert  into `cidades`(`id`,`nome`,`uf`) values (2,'Duque de Caxias','RJ');
insert  into `cidades`(`id`,`nome`,`uf`) values (3,'Niteroi','RJ');
insert  into `cidades`(`id`,`nome`,`uf`) values (4,'Petropolis','RJ');
insert  into `cidades`(`id`,`nome`,`uf`) values (5,'São Paulo','SP');
insert  into `cidades`(`id`,`nome`,`uf`) values (6,'Santos','SP');
insert  into `cidades`(`id`,`nome`,`uf`) values (7,'Belo Horizonte','MG');
insert  into `cidades`(`id`,`nome`,`uf`) values (8,'Uberaba','MG');
insert  into `cidades`(`id`,`nome`,`uf`) values (9,'Vitória','ES');
insert  into `cidades`(`id`,`nome`,`uf`) values (10,'Florianópolis','SC');
insert  into `cidades`(`id`,`nome`,`uf`) values (11,'Chapecó','SC');
insert  into `cidades`(`id`,`nome`,`uf`) values (12,'Curitiba','PR');
insert  into `cidades`(`id`,`nome`,`uf`) values (13,'Cascavel','PR');
insert  into `cidades`(`id`,`nome`,`uf`) values (14,'Porto Alegre','RS');
insert  into `cidades`(`id`,`nome`,`uf`) values (15,'Caxias do Sul','RS');

/*Table structure for table `clinica` */

DROP TABLE IF EXISTS `clinica`;

CREATE TABLE `clinica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `uf` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` int(11) DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` text COLLATE utf8_unicode_ci,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city` (`cidade`),
  CONSTRAINT `fk_city` FOREIGN KEY (`cidade`) REFERENCES `cidades` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `clinica` */

insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (1,'Clinica XPTO','2019-05-13','RJ',1,'Bangu','Rua xxxxxxxx n 111','dezepicos3@gmail.com','(21)98561-4694');
insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (2,'C2','2019-05-31','RJ',1,'Copacabana',NULL,NULL,NULL);
insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (3,'LAB 3','2019-06-10','SP',5,'Morumbi',NULL,NULL,NULL);
insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (4,'Hospital 4','2019-06-10','RJ',3,'Rio do Ouro',NULL,NULL,NULL);
insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (8,'Clinica 5','2019-07-01','RJ',1,'Padre Miguel','Mocidade ','','');
insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (9,'Clinica 9','2019-07-01','RJ',1,'Bangu','Prata ','','');
insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (10,'Clinia XP','2019-07-01','SP',5,'Morumbi',' ','','');
insert  into `clinica`(`id`,`nome`,`data_cadastro`,`uf`,`cidade`,`bairro`,`endereco`,`email`,`telefone`) values (11,'Cl g','2019-07-01','PR',12,'',' ','','');

/*Table structure for table `especialidades` */

DROP TABLE IF EXISTS `especialidades`;

CREATE TABLE `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `especialidades` */

insert  into `especialidades`(`id`,`nome`) values (1,'Patologia');
insert  into `especialidades`(`id`,`nome`) values (2,'Oftalmologia');
insert  into `especialidades`(`id`,`nome`) values (3,'Otorrinolaringologia');
insert  into `especialidades`(`id`,`nome`) values (4,'Ortopedia');
insert  into `especialidades`(`id`,`nome`) values (5,'Odontologia');
insert  into `especialidades`(`id`,`nome`) values (6,'Endocrinologia');
insert  into `especialidades`(`id`,`nome`) values (7,'Ginecologia');
insert  into `especialidades`(`id`,`nome`) values (8,'4');

/*Table structure for table `logins` */

DROP TABLE IF EXISTS `logins`;

CREATE TABLE `logins` (
  `id_usuario` int(11) DEFAULT NULL,
  `data_execucao` datetime DEFAULT NULL,
  `execucao` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_log_user` (`id_usuario`),
  CONSTRAINT `fk_log_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `logins` */

insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (1,'2019-05-29 14:11:46','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-05-29 14:20:20','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-27 16:14:38','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:15:38','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:16:27','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:16:54','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:18:27','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:19:02','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:19:11','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:19:19','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-27 16:19:43','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 10:19:42','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 11:14:04','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-28 11:14:16','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-28 11:36:56','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 11:37:07','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 11:37:25','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 11:37:31','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 11:39:53','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-28 11:40:08','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-28 11:41:28','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 11:41:34','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-06-28 12:16:30','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-28 12:16:41','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-06-28 14:18:39','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-01 10:27:42','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-01 16:31:41','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-01 16:31:59','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-02 09:28:44','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-02 09:29:13','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-02 09:29:32','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-02 11:43:13','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-02 11:43:41','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-02 12:13:39','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-02 14:13:12','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-02 15:57:45','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-02 15:57:52','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-02 17:47:06','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-02 17:47:32','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-03 10:25:56','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-03 10:26:12','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-03 10:26:32','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-03 14:22:25','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-03 17:13:27','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-03 18:11:36','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-03 18:11:53','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-03 18:14:55','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-03 18:15:03','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-10 14:51:32','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-10 17:35:43','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-10 17:35:49','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-10 17:38:12','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-10 17:38:26','login','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (3,'2019-07-10 17:50:29','logout','127.0.0.1');
insert  into `logins`(`id_usuario`,`data_execucao`,`execucao`,`ip`) values (2,'2019-07-10 17:50:39','login','127.0.0.1');

/*Table structure for table `notificacao` */

DROP TABLE IF EXISTS `notificacao`;

CREATE TABLE `notificacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notificacao` text COLLATE utf8_unicode_ci,
  `id_usuario` int(11) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_not_user` (`id_usuario`),
  CONSTRAINT `fk_not_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `notificacao` */

insert  into `notificacao`(`id`,`notificacao`,`id_usuario`,`data`,`status`,`link`) values (1,'Atendimento 123456 Remarcado!',2,'2019-07-10 17:48:52',1,'home.php?l=MQ==&ntf=1');

/*Table structure for table `perfil` */

DROP TABLE IF EXISTS `perfil`;

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `perfil` */

insert  into `perfil`(`id`,`perfil`) values (1,'Administrador');
insert  into `perfil`(`id`,`perfil`) values (2,'Paciente');
insert  into `perfil`(`id`,`perfil`) values (3,'Atendente');
insert  into `perfil`(`id`,`perfil`) values (4,'Médico');

/*Table structure for table `plano` */

DROP TABLE IF EXISTS `plano`;

CREATE TABLE `plano` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `plano` */

insert  into `plano`(`id`,`nome`) values (1,'Sulamerica');
insert  into `plano`(`id`,`nome`) values (2,'Unimed');
insert  into `plano`(`id`,`nome`) values (3,'Amil');
insert  into `plano`(`id`,`nome`) values (4,'Assim');

/*Table structure for table `plano_clinica` */

DROP TABLE IF EXISTS `plano_clinica`;

CREATE TABLE `plano_clinica` (
  `id_plano` int(11) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL,
  `produto` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `fk_clinica` (`id_clinica`),
  KEY `fk_plano` (`id_plano`),
  CONSTRAINT `fk_clinica` FOREIGN KEY (`id_clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_plano` FOREIGN KEY (`id_plano`) REFERENCES `plano` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `plano_clinica` */

insert  into `plano_clinica`(`id_plano`,`id_clinica`,`produto`) values (1,9,'');
insert  into `plano_clinica`(`id_plano`,`id_clinica`,`produto`) values (2,9,'');
insert  into `plano_clinica`(`id_plano`,`id_clinica`,`produto`) values (1,10,'592');
insert  into `plano_clinica`(`id_plano`,`id_clinica`,`produto`) values (3,1,NULL);
insert  into `plano_clinica`(`id_plano`,`id_clinica`,`produto`) values (1,1,NULL);
insert  into `plano_clinica`(`id_plano`,`id_clinica`,`produto`) values (2,1,NULL);

/*Table structure for table `proc_clinica` */

DROP TABLE IF EXISTS `proc_clinica`;

CREATE TABLE `proc_clinica` (
  `id_proc` int(11) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  KEY `fk_cli` (`id_clinica`),
  KEY `fk_proc_cli` (`id_proc`),
  CONSTRAINT `fk_cli` FOREIGN KEY (`id_clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_proc_cli` FOREIGN KEY (`id_proc`) REFERENCES `procedimento` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `proc_clinica` */

insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (2,2,30.58);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (5,2,NULL);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (6,3,NULL);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (9,3,NULL);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (7,4,NULL);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (1,9,NULL);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (3,9,NULL);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (4,9,NULL);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (10,11,55);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (1,1,1);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (4,1,1);
insert  into `proc_clinica`(`id_proc`,`id_clinica`,`preco`) values (3,1,NULL);

/*Table structure for table `procedimento` */

DROP TABLE IF EXISTS `procedimento`;

CREATE TABLE `procedimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(155) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_espec` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_espec_proc` (`id_espec`),
  CONSTRAINT `fk_espec_proc` FOREIGN KEY (`id_espec`) REFERENCES `especialidades` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `procedimento` */

insert  into `procedimento`(`id`,`nome`,`id_espec`) values (1,'Hemograma',1);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (2,'Consulta',2);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (3,'Consulta',1);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (4,'Teste HIV',1);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (5,'Cirurgia',2);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (6,'Consulta',3);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (7,'Consulta',4);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (8,'Consulta',5);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (9,'Limpeza',3);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (10,'Consulta',7);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (11,'Sexagem Fetal',1);
insert  into `procedimento`(`id`,`nome`,`id_espec`) values (12,'Consulta',8);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genero` int(11) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `perfil` int(11) DEFAULT NULL,
  `id_clinica` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_us_clinica` (`id_clinica`),
  KEY `fk_us_perfil` (`perfil`),
  CONSTRAINT `fk_us_clinica` FOREIGN KEY (`id_clinica`) REFERENCES `clinica` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_us_perfil` FOREIGN KEY (`perfil`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`nome`,`genero`,`data_nascimento`,`cpf`,`email`,`senha`,`status`,`perfil`,`id_clinica`) values (1,'Volnei',NULL,'2019-05-13',111111,'','111',1,1,NULL);
insert  into `usuarios`(`id`,`nome`,`genero`,`data_nascimento`,`cpf`,`email`,`senha`,`status`,`perfil`,`id_clinica`) values (2,'volnei',NULL,'1990-05-09',12321312,'volnei.prado@oi.net.br','b99c445168c41306c98f8e2aa47380ce45df41096a973e3145801bc2fbf16a4c4173dc4177dc5a6bec509146e38bc2f892cdadb40161d01854cae22f7a5d3933',1,1,NULL);
insert  into `usuarios`(`id`,`nome`,`genero`,`data_nascimento`,`cpf`,`email`,`senha`,`status`,`perfil`,`id_clinica`) values (3,'Luiz Prado',1,'1990-06-20',142476,'volneifjv@gmail.com','94d18234004197df654729be3681d983f81529a83ae5230130e48c76933ddec68b7712b7dd4f3180066f3d54e427493433af8ee7de9c02bcce05e2390d2a4eaf',1,2,1);
insert  into `usuarios`(`id`,`nome`,`genero`,`data_nascimento`,`cpf`,`email`,`senha`,`status`,`perfil`,`id_clinica`) values (4,'teste',NULL,NULL,NULL,'dezepicos@gmail.com','42298107259ee4cbfc13976176020a307528f141eedaf551449a923ec68b317eed4240a889f0ef53f1e57692af63315c0d1cf56469df6f7aee7ed11178fe79c6',1,3,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
