SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";

CREATE TABLE admins (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL
);

INSERT INTO admins (username, password) VALUES ('admin', 'admin');

CREATE TABLE accounts (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(128) NOT NULL,
    lname VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    mobile VARCHAR(128) NOT NULL 
);

INSERT INTO accounts (fname, lname, email, password, mobile) 
VALUES ('User', 'User', 'user@gmail.com', 'user', '+20123456789');

CREATE TABLE aircrafts (
  name VARCHAR(128) NOT NULL PRIMARY KEY,
  company VARCHAR(128) NOT NULL  
);

INSERT INTO aircrafts (name, company) VALUES ('Aircraft 1', 'Egypt Air');

CREATE TABLE flights (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    src VARCHAR(128) NOT NULL,
    dest VARCHAR(128) NOT NULL,
    flightDate DATE NOT NULL,
    flightTime TIME NOT NULL,
    aircraft VARCHAR(128) NOT NULL,
    num INT NOT NULL,
    FOREIGN KEY (aircraft) REFERENCES aircrafts(name) ON DELETE CASCADE ON UPDATE CASCADE
);

ALTER TABLE flights 
ADD CHECK (flightDate > CURDATE());

CREATE TABLE tickets (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    flightID INT NOT NULL,
    passengerID INT NOT NULL,
    FOREIGN KEY (flightID) REFERENCES flights(id),
    FOREIGN KEY (passengerID) REFERENCES accounts(id)
);

INSERT INTO flights (src, dest, flightDate, flightTime, aircraft, num)
VALUES ('Cairo', 'New York', '2020-07-25', '10:00:00', 'Aircraft 1', 200);
INSERT INTO flights (src, dest, flightDate, flightTime, aircraft, num)
VALUES ('New York', 'Cairo', '2020-07-28', '18:00:00', 'Aircraft 1', 250);

CREATE TABLE messages (
    name VARCHAR(255) NOT NULL,
    email VARCHAR(128) NOT NULL,
    msg VARCHAR(512) NOT NULL
);
