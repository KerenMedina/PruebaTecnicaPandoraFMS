<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva tu Cita</title>
    <link rel="stylesheet" href="css.css">

</head>
<body>
    <h1>Reserva tu cita</h1>
    <form action="">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required><br><br>
        <div id="name_error"class="error" ></div>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required "><br><br>
        <div id="dni_error" class="error" ></div>

        <label for="phone">Teléfono:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        <div id="phone_error" class="error" ></div>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <div id="email_error" class="error" ></div>

        <label for="appointment_type">Tipo de cita:</label>
        <select id="appointment_type" name="appointment_type" disabled required>
            <option selected value="Primera consulta">Primera consulta</option>
            <option value="Revisión">Revisión</option>
        </select><br><br>
        <div id="appointment_type_error" class="error" style="color: yellow;"></div>

        <div id="result" class="success" ></div>
        <button type="button" id="submit">Pedir Cita</button>
    </form>

   
  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="validations.js"></script>
</html>
