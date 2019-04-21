LOGIN SYSTEM DATABASE

CREATE TABLE user_login(
name VARCHAR(250) NOT NULL, 
email VARCHAR(250) NOT NULL,
username VARCHAR(250) NOT NULL PRIMARY KEY, 
pwd1 VARCHAR(250) NOT NULL, 
pwd2 VARCHAR(250) NOT NULL,
question INT NOT NULL, 
answer VARCHAR(250) NOT NULL);

CREATE TABLE user_session (
name VARCHAR(250) NOT NULL,
user VARCHAR(250) NOT NULL,
status INT NOT NULL,
sessionDate DATETIME);

//Delete the sessionDate colume in putty or terminal
ALTER TABLE user_session DROP COLUMN sessionDate;

//User in table 2 won't repeat twice
ALTER TABLE user_session ADD PRIMARY KEY (user);

//THIS TABLE IS FOR ANGULARJS
CREATE TABLE chatUser(
name VARCHAR(250) NOT NULL PRIMARY KEY, 
email VARCHAR(250) NOT NULL,
password VARCHAR(250) NOT NULL, 
question VARCHAR(250) NOT NULL, 
answer VARCHAR(250) NOT NULL);
