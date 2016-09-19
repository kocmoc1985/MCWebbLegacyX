create table  httpcom (
client integer not NULL,
ip varchar(30),
last_request_date varchar(50),
valid integer not NULL,
notes varchar(500),
version varchar(50),
os varchar(50),
primary key (client)
);
