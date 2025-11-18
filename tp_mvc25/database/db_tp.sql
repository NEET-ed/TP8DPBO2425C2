CREATE database tp_mvc25
USE tp_mvc25;

CREATE TABLE lecturers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nidn VARCHAR(20) NOT NULL UNIQUE,
    phone VARCHAR(20),
    join_date DATE NOT NULL
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    course_code VARCHAR(20) NOT NULL UNIQUE,
    lecturer_id INT NOT NULL,
    credits INT DEFAULT 3,
    FOREIGN KEY (lecturer_id) REFERENCES lecturers(id)
);

