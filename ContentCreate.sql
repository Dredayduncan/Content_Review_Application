SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

drop database if exists ContentCreate;
create database ContentCreate;
use ContentCreate;

create table Users(
	fname varchar(255) NOT NULL,
    lname varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255) primary key,
    user_role enum('CREATOR','USER')
);

create table Creators(
	creator_id bigint auto_increment primary key ,
    email varchar(255),
    foreign key(email) references Users(email),
    avi varchar(255) NOT NULL
    
);

create table Content(
	creator_id bigint,
    foreign key(creator_id) references Creators(creator_id),
    content varchar(255) NOT NULL,
    contentName varchar(100) NOT NULL,
    contentType enum('gaming', 'photography', 'videography', 'basketball', 'football', 'swimming', 'art', 'comedy', 'gym', 'vlog', 'music', 'other'),
    keyword varchar(255),
    ContentSpec enum('image', 'video'),
    contentLink varchar(255)
);

create table Favorites(
	email varchar(255),
    foreign key(email) references Users(email),
    favorite_id mediumint NOT NULL,
    time timestamp
);

create table SearchHistory(
	email varchar(255),
    foreign key(email) references Users(email),
    history_id mediumint NOT NULL,
    time timestamp
    
);




