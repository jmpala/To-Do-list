DROP DATABASE IF EXISTS todolist;

CREATE DATABASE todolist;

CREATE TABLE tasks (
    id integer primary key auto_increment,
    task varchar(255)
);
