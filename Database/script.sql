USE house_rental_db;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS tbl_genders;

CREATE TABLE tbl_genders(
    gender_id INT NOT NULL AUTO_INCREMENT,
    gender VARCHAR(55) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(gender_id)
);

INSERT INTO tbl_genders(gender)
VALUES('Male');
INSERT INTO tbl_genders(gender)
VALUES('Female');
INSERT INTO tbl_genders(gender)
VALUES('Others');

DROP TABLE IF EXISTS tbl_user_roles;

CREATE TABLE tbl_user_roles(
	user_role_id INT NOT NULL AUTO_INCREMENT,
    `role` VARCHAR(55) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_role_id)
);

INSERT INTO tbl_user_roles(`role`)
VALUES('Admin');
INSERT INTO tbl_user_roles(`role`)
VALUES('Cashier');
INSERT INTO tbl_user_roles(`role`)
VALUES('Client');

DROP TABLE IF EXISTS tbl_users;

CREATE TABLE tbl_users(
	user_id INT NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(55) NOT NULL,
    middle_name VARCHAR(55) DEFAULT NULL,
    last_name VARCHAR(55) NOT NULL,
    age INT NOT NULL,
    gender_id INT NOT NULL,
    email VARCHAR(55) NOT NULL,
    contact_number VARCHAR(55) NOT NULL,
    username VARCHAR(55) NOT NULL,
    `password` VARBINARY(55) NOT NULL,
    user_role_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id),
    FOREIGN KEY(gender_id) REFERENCES tbl_genders(gender_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(user_role_id) REFERENCES tbl_user_roles(user_role_id) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO tbl_users(first_name, middle_name, last_name, age, gender_id, email, contact_number, username, `password`, user_role_id)
VALUES('Hello', NULL, 'There', 24, 3, 'devhellothere@admin.com', '09123456789', 'admin', AES_ENCRYPT('admin', 's3cretp4as$w0rd!!'), 1);
INSERT INTO tbl_users(first_name, middle_name, last_name, age, gender_id, email, contact_number, username, `password`, user_role_id)
VALUES('Juan', 'Santos', 'Dela Cruz', 35, 1, 'juansantos@user.com', '09123456789', 'user', AES_ENCRYPT('user', 's3cretp4as$w0rd!!'), 3);

DROP TABLE IF EXISTS tbl_categories;

CREATE TABLE tbl_categories(
	category_id INT NOT NULL AUTO_INCREMENT,
    category VARCHAR(55) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(category_id)
);

INSERT INTO tbl_categories(category)
VALUES('Duplex');
INSERT INTO tbl_categories(category)
VALUES('Single-Family Home');
INSERT INTO tbl_categories(category)
VALUES('Multi-Family Home');
INSERT INTO tbl_categories(category)
VALUES('2-Story House');


DROP TABLE IF EXISTS tbl_houses;

CREATE TABLE tbl_houses(
	house_id INT NOT NULL AUTO_INCREMENT,
    house_no VARCHAR(55) DEFAULT NULL,
    category_id INT NOT NULL,
    `description` TEXT DEFAULT NULL,
    price DOUBLE NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(house_id),
    FOREIGN KEY(category_id) REFERENCES tbl_categories(category_id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS tbl_client_houses;

CREATE TABLE tbl_client_houses(
    client_house_id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    house_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(client_house_id),
    FOREIGN KEY(user_id) REFERENCES tbl_users(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(house_id) REFERENCES tbl_houses(house_id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS tbl_payments;

CREATE TABLE tbl_payments(
	payment_id INT NOT NULL AUTO_INCREMENT,
    invoice VARCHAR(55) NOT NULL,
    user_id INT NOT NULL,
    house_id INT NOT NULL,
    amount DOUBLE NOT NULL,
    `change` DOUBLE NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(payment_id),
    FOREIGN KEY(user_id) REFERENCES tbl_users(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(house_id) REFERENCES tbl_houses(house_id) ON UPDATE CASCADE ON DELETE CASCADE
);

SET foreign_key_checks = 1;