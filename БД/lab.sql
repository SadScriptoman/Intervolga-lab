

CREATE TABLE `analytics` (
  `visitor_id` int(11) NOT NULL AUTO_INCREMENT,
  `visitor_ip` varchar(12) NOT NULL,
  `visited_page_id` int(11) NOT NULL,
  `visited_this_page` int(11) NOT NULL DEFAULT 0,
  `visitor_ref` text NOT NULL,
  PRIMARY KEY (`visitor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;


INSERT INTO analytics VALUES
("43","127.0.0.1","26","13","lab/admin.php"),
("44","127.0.0.1","28","16",""),
("45","127.0.0.1","27","2","http://lab/map.php"),
("46","::1","29","13",""),
("47","127.0.0.1","29","5",""),
("48","::1","30","14","http://localhost/"),
("49","::1","31","16","http://localhost/map"),
("50","::1","32","23","http://localhost/menu"),
("51","127.0.0.1","31","1","http://projects.local/"),
("52","127.0.0.1","30","1","http://projects.local/menu"),
("53","127.0.0.1","32","1","http://projects.local/map"),
("54","::1","33","10","http://localhost/employees"),
("55","::1","34","9","http://localhost/main"),
("56","::1","35","5","http://localhost/menu"),
("57","::1","36","6",""),
("58","::1","37","11","http://localhost/admin"),
("59","::1","38","2","http://localhost/main"),
("60","::1","39","1","http://localhost/menu"),
("61","::1","40","4","http://localhost/main"),
("62","::1","41","10","http://localhost/menu"),
("63","::1","42","1",""),
("64","::1","43","6",""),
("65","::1","44","4",""),
("66","::1","45","2","https://www.yandex.ru/clck/jsredir?from=yandex.ru;suggest;browser&text="),
("67","::1","46","4","");




CREATE TABLE `employees` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_name` varchar(100) DEFAULT NULL,
  `e_tel` varchar(20) DEFAULT NULL,
  `e_post` varchar(30) DEFAULT NULL,
  `e_photo` varchar(100) DEFAULT '././uploads/employes',
  PRIMARY KEY (`e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;


INSERT INTO employees VALUES
("146","Соколов Никита Дмитриевич","+7 (917) 842-43-66","Официант","sokolov-nikita-dmitrievich-sbmj3.jpg"),
("155","Силеверстова Марина Евгеньевна","+7 (917) 842-43-66","Официант","sokolov-nikita-dmitrie-pobjk.jpg"),
("157","Соколов Никита Андреевич","+7 (917) 842-43-66","Старший Официант","sokolov-nikita-dmitrievich-ztkjb.jpg");




CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_url` varchar(60) NOT NULL,
  `page_title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;


INSERT INTO pages VALUES
("37","/main","Главная"),
("40","/menu","Меню"),
("41","/map","Рестораны"),
("46","/","Главная");




CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `deposit` float DEFAULT 0,
  `name` varchar(60) DEFAULT NULL,
  `table_number` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;


INSERT INTO reservations VALUES
("56","2019-11-25","09:00:00","+7 (917) 842-43-66","0","Соколов","22"),
("57","2019-11-25","09:00:00","+7 (917) 842-43-66","0","Соколов","22");




CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT INTO users VALUES
("1","admin","admin"),
("3","nikita","nikita123"),
("4","login","admin"),
("5","superadmin","admin");


