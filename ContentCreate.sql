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
	creator_id bigint auto_increment primary key,
    email varchar(255),
    bio mediumtext,
    foreign key(email) references Users(email),
    avi varchar(255) NOT NULL,
    contentType enum('gaming', 'photography', 'videography', 'basketball', 'football', 'swimming', 'art', 'comedy', 'gym', 'vlog', 'music', 'other'),
    numClicks mediumint,
    totalRates bigint,
    rating tinyint check (rating > 0 and rating < 6),
    numRates bigint default 0
);



create table Rating(
    creator_id bigint ,
    foreign key(creator_id) references Creators(creator_id),
    ratorid varchar(255),
    foreign key(ratorid) references Users(email),
    rating tinyint check (rating > 0 and rating < 6),
    time timestamp
);


create table CreatorSocial(
    creator_id bigint,
    foreign key(creator_id) references Creators(creator_id),
    PWebsite1 varchar(255),
    PWebsite2 varchar(255),
    LinkedIn varchar(255),
    Facebook varchar(255),
    Youtube varchar(255),
    Twitch varchar(255),
    Twitter varchar(255)
);


create table Content(
	creator_id bigint,
    foreign key(creator_id) references Creators(creator_id),
    content mediumtext,
    contentType enum('IMAGE','VIDEO')
);


create table Favorites(
	email varchar(255),
    foreign key(email) references Users(email),
    favorite_id bigint NOT NULL,
    foreign key(favorite_id) references Creators(creator_id),
    time timestamp
);


create table SearchHistory(
	email varchar(255),
    foreign key(email) references Users(email),
    history_id bigint NOT NULL,
    foreign key(history_id) references Creators(creator_id),
    time timestamp
    
);

create table resetpass(
    id int auto_increment,
    resetcode varchar(255),
    email varchar(255),
    primary key(id)
);


UPDATE Creators SET numClicks = 0 WHERE numClicks IS NULL;




