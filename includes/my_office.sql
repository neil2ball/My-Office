/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.8-MariaDB : Database - my_office
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`my_office` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `my_office`;

/*Table structure for table `t_admin` */

DROP TABLE IF EXISTS `t_admin`;

CREATE TABLE `t_admin` (
  `a_name` varchar(30) NOT NULL,
  `a_mail` varchar(30) NOT NULL,
  `a_pwd` varchar(255) NOT NULL,
  `a_loc` varchar(30) NOT NULL COMMENT 'Location of admin',
  PRIMARY KEY (`a_mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_admin` */

insert  into `t_admin`(`a_name`,`a_mail`,`a_pwd`,`a_loc`) values ('Admin001','admin1@admin.com','$argon2id$v=19$m=65536,t=4,p=1$dUdMRzRBY2gzSUVuaE9iLg$z2ZTARB8jti84tJa0zi469I/7KHGWGZ+npyebbp2seA','Location001');

/*Table structure for table `t_admin` */

DROP TABLE IF EXISTS `t_teach`;

CREATE TABLE `t_teach` (
  `t_name` varchar(30) NOT NULL,
  `t_email` varchar(30) NOT NULL,
  `t_pwd` varchar(255) NOT NULL,
  `t_loc` varchar(30) NOT NULL COMMENT 'Location of teacher',
  PRIMARY KEY (`t_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_teach` */

insert  into `t_teach`(`t_name`,`t_email`,`t_pwd`,`t_loc`) values ('teacher1','teacher1@teacher.com','$argon2id$v=19$m=65536,t=4,p=1$V1VkQkJFVUQ3dW5hWURmZg$9fHDoeq9/fWvbYPd/gg5xDDYywmEf9l2vryIyF7rJFE','Location001');

/*Table structure for table `t_cart` */

DROP TABLE IF EXISTS `t_cart`;

CREATE TABLE `t_cart` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `c_p_qty` int(11) NOT NULL COMMENT 'Cart product quantity',
  `p_name` varchar(30) NOT NULL,
  `p_price` float NOT NULL COMMENT 'Price of one product',
   PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_cart` */

insert  into `t_cart`(`u_id`,`p_id`,`c_p_qty`,`p_name`,`p_price`) values (1,1,5,'CHEEZ-IT',150);

/*Table structure for table `t_order_user_det` */

DROP TABLE IF EXISTS `t_order_user_det`;

CREATE TABLE `t_order_user_det` (
  `o_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_amt` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(30) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_loc` varchar(30) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `s_email` varchar(30) NOT NULL,
  `s_loc` varchar(30) NOT NULL,  
  `o_date` date NOT NULL,
  `o_escrow` int(11) NOT NULL,
  `u_ver` int(1) NOT NULL,
  `s_ver` int(1) NOT NULL,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `t_order_user_det` */

/*Table structure for table `t_product` */

DROP TABLE IF EXISTS `t_product`;

CREATE TABLE `t_product` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` int(11) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_qty` varchar(30) NOT NULL,
  `p_img` varchar(50) NOT NULL,
  `p_wt` varchar(30) NOT NULL COMMENT 'weight',
  `p_price` varchar(30) NOT NULL,
  `p_desc` varchar(30) NOT NULL COMMENT 'Description',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `t_product` */

insert  into `t_product`(`p_id`,`s_id`,`p_name`,`p_qty`,`p_img`,`p_wt`,`p_price`,`p_desc`) values (1,1,'CHEEZ-IT','0','Product_Image/918CJVcvwPL.jpg','250','150',' Cheez-it  the real cheez'),(3,1,'Johnson Baby Shampoo','50','Product_Image/best-sls-free-shampoo-in-india-4.jpg','150','200',' Baby Shampoo');

/*Table structure for table `t_supplier` */

DROP TABLE IF EXISTS `t_supplier`;

CREATE TABLE `t_supplier` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` varchar(30) DEFAULT NULL,
  `s_name` varchar(30) NOT NULL,
  `s_email` varchar(30) NOT NULL,
  `s_pwd` varchar(255) NOT NULL,
  `s_loc` varchar(30) NOT NULL,
  `s_bal` int(11) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_supplier` */

insert  into `t_supplier`(`a_id`,`s_name`,`s_email`,`s_pwd`, `s_loc`, `s_bal`) values ('admin1@admin.com','teacher1','teacher1@teacher.com','$argon2id$v=19$m=65536,t=4,p=1$V1VkQkJFVUQ3dW5hWURmZg$9fHDoeq9/fWvbYPd/gg5xDDYywmEf9l2vryIyF7rJFE', '1111', 0);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
