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
    FOREIGN KEY (product_id) REFERENCES product(product_id)
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
    FOREIGN KEY (product_id) REFERENCES product(product_id)
);

CREATE TABLE has (
    category_name VARCHAR(255),
    product_id INT,
    PRIMARY KEY (category_name, product_id),
    FOREIGN KEY (product_id) REFERENCES product(product_id),
    FOREIGN KEY (category_name) REFERENCES category(category_name)
);

CREATE TABLE cart (
    number INT,
    username VARCHAR(255),
    product_id INT,
    PRIMARY KEY (username, product_id),
    FOREIGN KEY (username) REFERENCES user(username),
    FOREIGN KEY (product_id) REFERENCES product(product_id)
);

INSERT INTO product (product_name, price, description, stock) VALUES
    ('product1', 10, '', 10),
    ('product1', 10, '', 10),
    ('product1', 10, '', 10);

INSERT INTO imgurl VALUES
    ('placeholder.png', 1),
    ('placeholder.png', 2),
    ('placeholder.png', 3);