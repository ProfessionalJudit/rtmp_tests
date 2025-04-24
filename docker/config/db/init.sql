CREATE TABLE Users (
    uid int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    chanel_description varchar(255),
    token_1 varchar(255),
    token_2 varchar(255),
    PRIMARY KEY(uid)
);

CREATE TABLE Extra (
    id int NOT NULL AUTO_INCREMENT,
    chanelid int NOT NULL,
    imgname varchar(255) NOT NULL,
    smallimgname varchar(255) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (chanelid) REFERENCES Users(uid)
);


ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'superrootpass';
ALTER USER 'secureuser'@'%' IDENTIFIED WITH mysql_native_password BY 'securepass';

FLUSH PRIVILEGES;

INSERT INTO Users (username,password,chanel_description,token_1,token_2) VALUES ('Root','rootpass','This is the start of all things','rootkey','rootpass');
INSERT INTO Users (username,password,chanel_description,token_1,token_2) VALUES ('Notroot','notrootpass','This is the the annoying little brother','notrootkey','notrootpass');
INSERT INTO Extra (chanelid,imgname,smallimgname) VALUES (1,"root-function-feature.jpg","root-function-feature.jpg");
INSERT INTO Extra (chanelid,imgname,smallimgname) VALUES (2,"root-function-feature.jpg","root-function-feature.jpg");