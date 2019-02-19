drop database if exists polaznik05_zavrsni;
create database polaznik05_zavrsni character set utf8 collate utf8_general_ci;
use polaznik05_zavrsni;

create table users(
	id int not null primary key auto_increment,
	firstName varchar(50) not null,
	lastName varchar(50) not null,
	email varchar(100) not null,
	password char(60) not null,
	adminRole boolean default false,
	profilePicture varchar(250)  -- add not null, add QR code
)ENGINE=InnoDB;
create unique index ix1 on users(email); -- email is unique user info, cannot be duplicated

create table tasks(
	id int not null primary key auto_increment,
	taskName varchar(250) not null,
	users int not null, -- task owner/person who's assignment that task is.
	taskStartTime datetime not null,
	taskEndTime datetime not null,
	taskDescription text not null,
	taskStatus varchar(30) not null,
	taskCategory varchar(250) not null
)ENGINE=InnoDB;

create table tasksPicture(
	id int not null primary key auto_increment,
	tasks int not null,
	picture varchar(250) -- path for each individual picture
)ENGINE=InnoDB;

create table tasksTags(
	id int not null primary key auto_increment,
	tasks int not null,
	tagName varchar(250) not null
)ENGINE=InnoDB;

create table tasksTagsTasks(
	id int not null primary key auto_increment,
	taskTags int not null,
	tasks int not null
)ENGINE=InnoDB;

alter table tasks add foreign key (users) references users(id);
alter table tasksPicture add foreign key (tasks) references tasks(id);
alter table tasksTagsTasks add foreign key (taskTags) references tasksTags(id);
alter table tasksTagsTasks add foreign key (tasks) references tasks(id);

insert into users(firstname, lastname, email, password, adminrole, profilepicture) VALUES
  ("Admin","Admin","admin@task.com","$2a$10$PtoKf1c8AXOf/fswwkcypuQx1l0z0Whep7N441ES18bKg3jyjgx2u",true, "null"),

	("First","Username","first.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Second","Username","second.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Third","Username","third.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Fourth","Username","fourth.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Fifth","Username","fifth.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Sixth","Username","sixth.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Seventh","Username","seventh.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Eighth","Username","eighth.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Ninth","Username","ninth.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null"),
	("Tenth","Username","tenth.user@task.com","$2a$10$wO0qNus7rv/dovUlwaotJuLMXWEieDC3ObQC6AKLDoG9rDfGwkITC",false , "null");

insert into tasks( taskName, users, taskStartTime, taskEndTime, taskDescription, taskStatus, taskCategory) values
  ("First Task",2,"2019-01-01 08:00:00","2019-01-10 16:00:00", "First task description","Finished","backend"),
  ("Second Task",3,"2019-01-03 08:00:00","2019-01-10 16:00:00", "Second task description","Finished","backend"),
  ("Third Task",3,"2019-01-05 08:00:00","2019-01-12 16:00:00", "Third task description","Finished","backend"),
  ("Fourth Task",4,"2019-01-07 08:00:00","2019-01-20 16:00:00", "Fourth task description","Finished","backend"),
  ("Fifth Task",5,"2019-01-07 08:00:00","2019-01-15 16:00:00", "Fifth task description","Finished","backend"),
  ("Sixth Task",6,"2019-01-08 08:00:00","2019-01-16 16:00:00", "Sixth task description","Finished","backend"),
  ("Seventh Task",7,"2019-01-09 08:00:00","2019-01-13 16:00:00", "Seventh task description","Finished","backend"),
  ("Eighth Task",8,"2019-01-10 08:00:00","2019-01-20 16:00:00", "Eighth task description","Finished","backend"),
  ("Ninth Task",8,"2019-01-10 08:00:00","2019-01-18 16:00:00", "Ninth task description","Finished","backend"),
  ("Tenth Task",9,"2019-01-12 08:00:00","2019-01-20 16:00:00", "Tenth task description","Finished","backend"),
  ("Eleventh Task",9,"2019-01-12 08:00:00","2019-01-20 16:00:00", "eleventh task description","Finished","backend"),
  ("Twelfth Task",9,"2019-01-12 08:00:00","2019-01-25 16:00:00", "twelfth task description","Finished","backend"),
  ("Thirteenth Task",10,"2019-01-10 08:00:00","2019-01-21 16:00:00", "thirteenth task description","Finished","backend"),
  ("Fourteenth Task",10,"2019-01-10 08:00:00","2019-01-22 16:00:00", "fourteenth task description","Finished","backend"),
  ("Fifteenth Task",10,"2019-01-12 08:00:00","2019-01-25 16:00:00", "fifteenth task description","Finished","backend");