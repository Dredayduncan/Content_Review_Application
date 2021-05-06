SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


drop database if exists ContentCreate;
create database ContentCreate;
use ContentCreate;

--User table


create table Users(
	fname varchar(255) NOT NULL,
    lname varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255) primary key,
    user_role enum('CREATOR','USER')
);


--Creator table 
create table Creators(
	creator_id bigint auto_increment primary key,
    email varchar(255),
    foreign key(email) references Users(email),
    avi varchar(255) NOT NULL,
    numClicks mediumint,
    totalRates bigint,
    rating tinyint check (rating > 0 and rating < 6),
    numRates bigint default 0
);

--Rating table that accumulates the rating 

create table Rating(
    creator_id bigint,
    foreign key(creator_id) references Creators(creator_id),
    ratorid varchar(255),
    rating tinyint check (rating > 0 and rating < 6)

);

-- Table that contains links to each creator's social media links as well as website links
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

-- Table that stores the content of each creator
create table Content(
	creator_id bigint,
    foreign key(creator_id) references Creators(creator_id),
    content varchar(255) NOT NULL,
    contentName varchar(100) NOT NULL,
    contentType enum('gaming', 'photography', 'videography', 'basketball', 'football', 'swimming', 'art', 'comedy', 'gym', 'vlog', 'music', 'other'),
    keyword varchar(255)
);

--Table that keeps track of the favorites of a user
create table Favorites(
	email varchar(255),
    foreign key(email) references Users(email),
    favorite_id bigint NOT NULL,
    foreign key(favorite_id) references Creators(creator_id),
    time timestamp
);

--Table that stores the search history of every user
create table SearchHistory(
	email varchar(255),
    foreign key(email) references Users(email),
    history_id bigint NOT NULL,
    foreign key(history_id) references Creators(creator_id),
    time timestamp
    
);




