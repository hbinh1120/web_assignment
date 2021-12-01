CREATE DATABASE assignment;
USE assignment;

CREATE TABLE product (
    product_id INT AUTO_INCREMENT,
    product_name VARCHAR(255),
    price INT,
    description TEXT,
    stock INT,
    PRIMARY KEY (product_id)
);

CREATE TABLE imgurl (
    imgurl VARCHAR(255),
    product_id INT,
    PRIMARY KEY (imgurl, product_id),
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE
);

CREATE TABLE user (
    username VARCHAR(255),
    name VARCHAR(255),
    password VARCHAR(255),
    phone INT,
    bdate DATE,
    type INT,
    PRIMARY KEY (username)
);

CREATE TABLE category (
    category_name VARCHAR(255),
    PRIMARY KEY (category_name)
);

CREATE TABLE review (
    username VARCHAR(255),
    product_id INT,
    rating INT,
    comment TEXT,
    PRIMARY KEY (username, product_id),
    FOREIGN KEY (username) REFERENCES user(username),
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE
);

CREATE TABLE has (
    category_name VARCHAR(255),
    product_id INT,
    PRIMARY KEY (category_name, product_id),
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE,
    FOREIGN KEY (category_name) REFERENCES category(category_name)
);

CREATE TABLE cart (
    number INT,
    username VARCHAR(255),
    product_id INT,
    PRIMARY KEY (username, product_id),
    FOREIGN KEY (username) REFERENCES user(username),
    FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE
);

INSERT INTO product (product_name, price, description, stock) VALUES
    ('Lawnmower Extreme L2', 150, '', 100),
    ('Vacuum Cleaner Extreme V3', 100, '', 57),
    ('Prebuilt PC Lenova P20', 400, '', 30),
    ('Car Porschal 913', 4000, '', 2);

INSERT INTO imgurl VALUES
    ('img/lawn_mower_extreme_l2-1.png', 1),
    ('img/lawn_mower_extreme_l2-2.png', 1),
    ('img/vacuum_cleaner_extreme_v3-1.png', 2),
    ('img/vacuum_cleaner_extreme_v3-2.png', 2),
    ('img/vacuum_cleaner_extreme_v3-3.png', 2),
    ('img/prebuilt_pc_lenova_p20-1.png', 3),
    ('img/prebuilt_pc_lenova_p20-2.png', 3),
    ('img/car_porschal_913-1.png', 4),
    ('img/car_porschal_913-2.png', 4);

INSERT INTO user VALUES 
    ('lad','LAD','weboe123','0256322788','2000-05-03',0),
    ('hackerman1120','HACKERMAN','weboe123','0984372666','2000-11-20',1),
    ('user','USER TEST','user','0123456789','2000-01-01',0);

INSERT INTO category VALUES
    ('electronic'),
    ('household'),
    ('transportation');

INSERT INTO has VALUES
    ('electronic',1),
    ('household',1),
    ('electronic',2),
    ('household',2),
    ('electronic',3),
    ('household',3),
    ('transportation',4);

INSERT INTO review VALUES  
    ('user',1,4.6,'pretty good'),
    ('lad',1,2.6,'kinda meh');