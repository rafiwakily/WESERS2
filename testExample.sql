create database TestExample;
use TestExample;

CREATE TABLE Products (
    ID INT NOT NULL AUTO_INCREMENT, 
    Name VARCHAR(50) NOT NULL,  
    Description VARCHAR(500),
    Price INT NOT NULL,
    Picture VARCHAR(50),
    PRIMARY KEY (ID)
);

INSERT INTO Products (Name,Description,Price,Picture) VALUES("Delicuse","Frish", 1, "Carrot.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("With nice color","big", 3, "eggplant.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("watermelon","very Frish", 4, "melon.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("apple","red", 10, "apple.jpg");
INSERT INTO Products (Name,Description,Price,Picture) VALUES("grapes","Frish", 1, "grapes.jpg");

COMMIT;
