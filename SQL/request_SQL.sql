CREATE DATABASE IF NOT EXISTS 2DO;
USE 2DO;

CREATE TABLE status(
   ID_status INT NOT NULL AUTO_INCREMENT,
   status_name VARCHAR(50) NOT NULL,
   PRIMARY KEY(ID_status)
);

CREATE TABLE task(
   ID_task INT NOT NULL AUTO_INCREMENT,
   task_name VARCHAR(50) NOT NULL,
   task_creation_date DATETIME NOT NULL,
   task_description VARCHAR(255),
   task_order INT,
   ID_status INT NOT NULL,
   PRIMARY KEY(ID_task),
   FOREIGN KEY(ID_status) REFERENCES STATUS(ID_status)
);
