CREATE TABLE Users (
    uid int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    chanel_description varchar(255),
    token_1 varchar(255),
    token_2 varchar(255)
);

INSERT INTO USERS VALUES 0,'Root','This is the start of all things','rooturl','rootpass'