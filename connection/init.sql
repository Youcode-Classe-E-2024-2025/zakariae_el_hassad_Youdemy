CREATE DATABASE croise2;
USE croise2;

-- Table des rôles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Table des catégories (créée avant courses pour éviter les erreurs de clé étrangère)
CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    admin_id INT NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES users(id)
);

-- Table des cours
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

-- Table d'inscription des étudiants aux cours
CREATE TABLE enrollment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    enrollment_date DATE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Table des notifications
CREATE TABLE notification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read') NOT NULL,
    date DATETIME NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES users(id)
);

-- Table des tags
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    admin_id INT NOT NULL,  -- Correction de 'amin_id' en 'admin_id'
    FOREIGN KEY (admin_id) REFERENCES users(id)
);

-- Table de liaison entre cours et tags
CREATE TABLE courseTags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    tag_id INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Insérer les rôles (AUTO_INCREMENT gère l'ID automatiquement)
INSERT INTO roles (name) VALUES ("ADMIN");
INSERT INTO roles (name) VALUES ("Enseignant");
INSERT INTO roles (name) VALUES ("Étudiant");
