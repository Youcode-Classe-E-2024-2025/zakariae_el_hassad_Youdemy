CREATE DATABASE croise2;
USE croise2;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    admin_id INT NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES users(id)
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    file VARCHAR(255) DEFAULT NULL,
    enseignant_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (enseignant_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    admin_id INT NOT NULL, 
    FOREIGN KEY (admin_id) REFERENCES users(id)
);

CREATE TABLE courseTags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

INSERT INTO roles (name) VALUES ("ADMIN");
INSERT INTO roles (name) VALUES ("Enseignant");
INSERT INTO roles (name) VALUES ("Étudiant");
