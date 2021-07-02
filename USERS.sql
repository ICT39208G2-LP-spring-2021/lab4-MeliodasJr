create table users (
    Id int not null AUTO_INCREMENT,
    FirstName varchar(30),
    LastName varchar(30),
    PersonalNumber varchar(11) unique,
    Email varchar(30) unique,
    HashedPassword char(30),
    StatusId int,
    primary key (Id)
);