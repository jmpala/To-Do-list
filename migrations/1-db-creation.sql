USE todolist;

DROP DATABASE IF EXISTS todolist;

CREATE DATABASE todolist;

DROP TABLE IF EXISTS tasks;
CREATE TABLE tasks (
    id integer primary key auto_increment,
    task varchar(255),
    status varchar(255)
);
