-- This table holds the 3 priority levels
CREATE TABLE todo_priority
(priorityID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
task VARCHAR(100) NOT NULL);

-- This table holds the main data visible to the user
CREATE TABLE todo (
taskID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
task VARCHAR(100) NOT NULL,
priorityID INT NOT NULL,
note VARCHAR(100),
FOREIGN KEY (priorityID) REFERENCES todo_priority(priorityID)
);

ALTER TABLE todo AUTO_INCREMENT 5000;

-- Insert the 3 priority levels
INSERT INTO todo_priority (task)
VALUES ('High'), ('Medium'), ('Low');

-- Select command inside index.php
-- This joins the priorityID column from ToDoList and Priority
SELECT todo.*, todo_priority.task as 'priorityID' FROM todo INNER JOIN todo_priority ON todo.priorityID = todo_priority.priorityID;