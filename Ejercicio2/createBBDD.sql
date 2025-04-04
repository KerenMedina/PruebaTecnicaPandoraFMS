-- Keren Medina Costa 03/04/2025
-- Create database
CREATE DATABASE IF NOT EXISTS clinic;

-- Use database
USE clinic;

-- create table patients
CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    dni VARCHAR(9) NOT NULL UNIQUE,
    phone VARCHAR(15),
    email VARCHAR(100)
);

-- create table appoinments
CREATE TABLE IF NOT EXISTS appointment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_patient INT,
    appointment_type ENUM('Primera consulta', 'Revisión') NOT NULL,
    date_appointment DATE NOT NULL,
    time_appointment TIME NOT NULL,
    FOREIGN KEY (id_patient) REFERENCES patients(id)
);
