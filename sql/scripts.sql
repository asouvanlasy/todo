-- This table holds the three priority levels
CREATE TABLE task_priority
(priority INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
task VARCHAR(100) NOT NULL);

-- This table holds the main data visible to the user
CREATE TABLE task (
task_pk INT NOT NULL AUTO_INCREMENT PRIMARY KEY,	
task VARCHAR(100) NOT NULL,
priority INT NOT NULL,
note VARCHAR(100),
FOREIGN KEY (priority) REFERENCES task_priority(priority)
);

-- task_pk begins incrementing at 5000
ALTER TABLE task AUTO_INCREMENT = 100;

-- Insert the 3 priority levels
INSERT INTO task_priority (task)
VALUES ('High'), ('Medium'), ('Low');



-- Script for users
CREATE TABLE user (
user_pk INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100) NOT NULL,
password VARCHAR(255) NOT NULL);