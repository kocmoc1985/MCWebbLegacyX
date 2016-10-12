create table goetfertLaunch (
id integer not NULL AUTO_INCREMENT,
company varchar(50),
iplocal varchar(50),
userName varchar(50),
os varchar(50),
version varchar(50),
other varchar(500),
date_ varchar(50),
primary key (id)
);

create table goetfertTest (
id integer not NULL AUTO_INCREMENT,
company varchar(50),
iplocal varchar(50),
userName varchar(50),
os varchar(50),
version varchar(50),
test varchar(500),
date_ varchar(50),
primary key (id)
);