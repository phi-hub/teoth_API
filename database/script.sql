CREATE DATABASE if NOT EXISTS MD17304;

USE MD17304;

CREATE TABLE if NOT exists users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    password VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    is_verified BIT DEFAULT 0,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL
);

INSERT INTO users (password, name, email) VALUES
('123456', 'Nguyen Van A', 'fafd@gmail.com'),
('123456', 'Nguyen Van B', 'aaa@gmail.com'),
('123456', 'Nguyen Van C', 'dasd@gmail.com');


CREATE TABLE if NOT exists reset_password (
    id INT PRIMARY KEY AUTO_INCREMENT,
    token VARCHAR(100) NOT NULL,
    createAt DATETIME NOT NULL DEFAULT NOW(),
    email VARCHAR(100) NOT NULL,
    avaiable BIT DEFAULT 1
);

CREATE TABLE IF NOT EXISTS Cart(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(5000),
    quantity INT NOT NULL,
    size VARCHAR(10) NOT NULL,
    ice VARCHAR(10) NOT NULL,
    ice_quant VARCHAR(20),
    userId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS Histories(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    total INT NOT NULL,
    userId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(id)
);

INSERT INTO cart (id, name, price, image, quantity, size, ice, ice_quant) VALUES (1, 'capuchino', 20, 'https://tse1.mm.bing.net/th?id=OIP.UUULVSMhnCVDlNO0faYm6AHaEo&pid=Api&P=0&h=220', 2, 'small', 'iced', 'full ice');


CREATE TABLE IF NOT EXISTS Categorie(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(100) NOT NULL
);
insert into categorie (id, name, image) values (1, 'Điện thoại', 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg');
insert into categorie (id, name, image) values (2, 'Laptop', 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg');
insert into categorie (id, name, image) values (3, 'Phụ kiện', 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg');

create table if not exists products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(5000) NOT NULL,
    description VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    categoryId INT NOT NULL,
    FOREIGN KEY (categoryId) REFERENCES categorie(id)
);

insert into products (id, name, price, image, description, quantity, categoryId) 
values (1, 'Điện thoại 1', 1000, 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg', 'Điện thoại 1', 10, 1);
insert into products (id, name, price, image, description, quantity, categoryId)
values (2, 'Điện thoại 2', 2000, 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg', 'Điện thoại 2', 20, 2);
insert into products (id, name, price, image, description, quantity, categoryId)
values (3, 'Điện thoại 3', 3000, 'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg', 'Điện thoại 3', 30, 3);

CREATE TABLE IF NOT EXISTS characters(
    characterID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    story VARCHAR(5000) NOT NULL,
    level INT NOT NULL,
    skill_level INT NOT NULL,
    hp INT NOT NULL,
    mp INT NOT NULL,
    vit INT NOT NULL,
    str INT NOT NULL,
    int INT NOT NULL,
    luk INT NOT NULL,
    position FLOAT NOT NULL,
    image VARCHAR(200) NOT NULL,
    userId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES users(userId),
    worldID INT NOT NULL,
    FOREIGN KEY (worldID) REFERENCES worlds(worldID)
);
CREATE TABLE IF NOT EXISTS worlds(
    worldID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    image VARCHAR(200) NOT NULL,
    available BIT DEFAULT 1
);
CREATE TABLE IF NOT EXISTS inventories(
    inventoryID INT PRIMARY KEY AUTO_INCREMENT,
    price INT NOT NULL,
    createAt DATETIME NOT NULL DEFAULT now(),
    characterID INT NOT NULL,
    FOREIGN KEY (characterID) REFERENCES characters(characterID),
    equipmentID INT NOT NULL,
    FOREIGN KEY (equipmentID) REFERENCES equipments(equipmentID)
);
CREATE TABLE IF NOT EXISTS equipments(
    equipmentID INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    effect VARCHAR(5000) NOT NULL,
    durability FLOAT NOt NULL,
    price INT NOT NULL,
    image VARCHAR(200) NOT NULL
);


