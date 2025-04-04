
---
## Requisitos Generales

- PHP 8
- MySQL
- Servidor Apache
- Docker instalado

---

## Docker

### Para ejecutar ambas aplicaciones utilizando Docker Compose, sigue los pasos a continuación.
1. Clonar el repositorio y navegar al directorio del proyecto
    Si aún no has clonado el repositorio, ejecuta:
```bash
    git clone https://github.com/KerenMedina/PruebaTecnicaPandoraFMS.git
    cd PruebaTecnicaPandoraFMS
```
2. Logearse a docker si aún no lo has hecho
    Ejecuta el siguiente comando y sigue las instrucciones
```bash
    docker login
```
3. Crear y ejecutar los contenedores Docker
    Ejecuta el siguiente comando para iniciar los servicios en Docker:
```bash
    docker compose up -d
```

4. Accede a las aplicaciones:

- **Ejercicio 1**: Accede a la aplicación a través de `http://localhost/ejercicio1/decodeFile.php`
- **Ejercicio 2**: Accede a la aplicación a través de `http://localhost/ejercicio2/index.php`
- **phpMyAdmin**: Accede a `http://localhost:8080` para gestionar la base de datos.
                    Usuario: root
                    Contraseña: root

---


# EJERCICIO 1

Este es un segundo ejercicio que contiene un archivo CSV con datos que deben ser procesados. El archivo `decodeFile.php` decodifica un puntaje inicial de acuerdo a una serie de reglas definidas en una función `decode`, utilizando una cadena de dígitos y un puntaje inicial. El resultado es un puntaje final calculado y ordenado en orden descendente.

### Estructura del proyecto Ejercicio1

```
ejercicio1/
├── data.csv
└── decodeFile.php
```

## Uso

1. Acceder a `decodeFile.php`, leerá el fichero que tenga el nombre `data.csv` y decodificará los datos.

---

# EJERCICIO 2

## Descripción

Este es un sistema para gestionar las citas de pacientes en una clínica. Permite a los pacientes registrarse con su nombre, DNI, teléfono, correo electrónico y seleccionar el tipo de cita (Primera consulta o Revisión). El sistema asegura que las citas sean asignadas de manera eficiente según la disponibilidad de horarios.

### Características:
- Registro de pacientes con validación de datos.
- Asignación automática de la fecha y hora de la cita, respetando el horario de funcionamiento.
- Control de citas para evitar la sobreasignación de horas.

---

## Instalación

### 1. Archivos del proyecto

- `index.php`: Página principal para que el usuario ingrese los datos de la cita.
- `appointment.php`: Archivo que procesa la información del paciente y genera la cita.
- `checkDni.php`: Verifica si el DNI ya está registrado en la base de datos.
- `validations.js`: Contiene las validaciones de los datos introducidos por el usuario.
- `conn.php`: Conexión a la base de datos MySQL.

### 2. Estructura del proyecto

```
ejercicio2/
├── appointment.php
├── checkDni.php
├── conn.php
├── createBBDD.sql
├── index.php
└── validations.js
```

---

## Uso

1. Al acceder a `index.php`, el usuario puede ingresar su nombre, DNI, teléfono, correo electrónico y seleccionar el tipo de cita (Primera consulta o Revisión).
2. La validación del DNI se realiza automáticamente y, si el DNI ya está registrado, el tipo de cita será habilitado para que el usuario pueda elegir entre "Primera consulta" o "Revisión".
3. Al enviar el formulario, se verifican todos los campos y, si todo está correcto, se genera una cita en la base de datos y se muestra el día y hora de la cita asignada.

---

## Funcionalidad de la Cita

La hora y fecha de la cita se asignan de acuerdo a la disponibilidad, con las siguientes reglas:

- La primera cita se asigna a las 10:00 del día actual, si la hora actual es antes de las 10:00 AM.
- Si la hora actual es posterior a las 10:00 AM pero antes de las 10:00 PM, la cita se asigna al siguiente horario disponible (una hora después de la última cita registrada).
- Si la hora actual es posterior a las 10:00 PM, la cita se asigna al día siguiente a las 10:00 AM.



CÓDIGO DESARROLLADO POR KEREN MEDINA COSTA 03/04/2025
