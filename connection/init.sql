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
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NULL,
    enseignant_id INT NOT NULL,
    category_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (enseignant_id) REFERENCES users(id) 
    FOREIGN KEY (category_id) REFERENCES category(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id) 

);


CREATE TABLE enrollment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date DATE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id) 
);


CREATE TABLE notification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read') NOT NULL,
    date DATETIME NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES users(id)
);


CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NULL,
    amin_id INT NOT NULL,
    FOREIGN KEY (amin_id) REFERENCES users(id)
);


CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    amin_id INT NOT NULL,
    FOREIGN KEY (amin_id) REFERENCES users(id)
);

CREATE TABLE courseTags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);



INSERT INTO roles (id, name) VALUES (1, "ADMIN");
INSERT INTO roles (id, name) VALUES (2, "Enseignant");
INSERT INTO roles (id, name) VALUES (3, "Étudiant");