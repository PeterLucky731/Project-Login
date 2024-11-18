create database user_login;
use user_login; 

create table usuario (
id int primary key auto_increment,
nome varchar(255) not null,
data_nasc date,
email varchar(255) unique,
senha varchar(255)
);

select * from usuario;