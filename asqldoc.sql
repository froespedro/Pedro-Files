CREATE DATABASE mydb;
USE mydb;

CREATE table phpadmins(
	user_id int not null auto_increment,
	first_name varchar (255),
	last_name varchar (255),
	username varchar (255),
	password varchar (255),
    primary key (user_id)
);
CREATE table phppeople(
	ID int not null auto_increment,
	fname varchar (255),
	lname varchar (255),
	email varchar (255),
	telNumber varchar (255),
    primary key (ID)
);
    
ALTER TABLE phppeople ADD profile_image VARCHAR(255);

SELECT * FROM phppeople;

SELECT * FROM phpadmins;