CREATE TABLE Users (
    uid int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    chanel_description varchar(255),
    token_1 varchar(255),
    token_2 varchar(255),
    PRIMARY KEY(uid)
);


ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'superrootpass';
ALTER USER 'secureuser'@'%' IDENTIFIED WITH mysql_native_password BY 'securepass';

FLUSH PRIVILEGES;

INSERT INTO Users (username,password,chanel_description,token_1,token_2) VALUES ('Root','rootpass','This is the start of all things','rootkey','rootpass');
INSERT INTO Users (username,password,chanel_description,token_1,token_2) VALUES ('Notroot','notrootpass','This is the the annoying little brother','notrootkey','notrootpass');