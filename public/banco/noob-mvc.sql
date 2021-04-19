create database noob;
use noob;
create table users (
   id_user int auto_increment primary key,
   email_user varchar(100) not null,
  name_user varchar(100) not null,
  password_user varchar(20)
);
drop table users;
INSERT INTO users (email_user,  name_user , password_user)
VALUES ("ell120603@gmail.com", "eliel_ele", "985896167");
select *  from users;