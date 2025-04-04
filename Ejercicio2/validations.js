// Keren Medina Costa 03/04/2025

// add events to check
window.addEventListener("load", function () {
    var dni = document.getElementById('dni');
    var submit = document.getElementById("submit");

    dni.addEventListener("keyup", existsDni);
    dni.addEventListener("change", existsDni);
    submit.addEventListener("click", checkButton);
});

// check if phone is valid
function checkPhone(phone) {
    var phoneRegex = /^[0-9]{9}$/;
    if (!phoneRegex.test(phone)) {
        $("#phone_error").html("El teléfono no es válido");
        return false;
    } else {
        $("#phone_error").html("");
        return true;
    }
}

// check if email is valid
function checkEmail(email) {
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(email)) {
        $("#email_error").html("El email no es válido");
        return false;
    } else {
        $("#email_error").html("");
        return true;
    }
}

// check if name is valid
function checkName(name) {
    var nameRegex = /^[a-zA-Z\s]+$/;
    if (!nameRegex.test(name)) {
        $("#name_error").html("El nombre no es válido");
        return false;
    } else {
        $("#name_error").html("");
        return true;
    }
}
// check if dni is valid
function checkDNI(dni) {
    var letter = dni.substring(8, 9).toUpperCase();
    var num = parseInt(dni.substring(0, 8));
    var l = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

    var validLetter = l[num % 23]; //calculate correct letter
    if (dni.length == 9 && letter.length == 1) {
        // check if dni has correct letter
        if (letter.toUpperCase() != validLetter) {
            $("#dni_error").html("El DNI no es válido");
            return false;
        } else {
            $("#dni_error").html("");
            return true;
        }
    } else {
        $("#dni_error").html("El DNI no es válido");
        return false;
    }
}

// check if dni exists in the database
function existsDni() {
    var dni = $("#dni").val();
    let params = {
        "dni": dni,
    };
    // ajax call to check if dni actually exists in ddbb
    $.ajax({
        url: 'checkDni.php',
        cache: false,
        method: 'POST',
        dataType: "json",
        data: params

    })
        .done(function (response) {
            if (response.success == true) {
                $("#appointment_type").prop("disabled", false);
                return true;
            } else {
                $("#appointment_type").prop("disabled", true);
                return false;
            }
        });
}
// check if all fields are valid and send the data to the server
function checkButton() {
    $("#appointment_type").prop("disabled", false);
    var dni = $("#dni").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    var name = $("#name").val();

    var okphone = false;
    var okdni = false;
    var okname = false;
    var okemail = false;

    if (checkName(name)) {
        okname = true;
    }
    if (checkEmail(email)) {
        okemail = true;
    }
    
    if (checkPhone(phone)) {
        okphone = true;
    }
    if (checkDNI(dni)) {
        okdni = true;
    }

    //check if fields are ok
    if (okdni && okphone && okname && okemail) {
        let params = {
            "name": $("#name").val(),
            "dni": dni,
            "phone": phone,
            "email": $("#email").val(),
            "appointment_type": $("#appointment_type").val()
        };
        // ajax call to insert the patient and get the appointment
        $.ajax({
            url: "appointment.php",
            cache: false,
            dataType: "json",
            data: params,
            method: "POST"
        })
            .done(function (response) {
                // if ajax correct shows message with the appointment
                let divResult = $("#result");
                if (response.success) divResult.html('Se ha generado la cita para el día ' + response.appointmentDate + ' a las ' + response.appointmentTime);
                else {
                    divResult.html("Error al generar la cita");
                }
            })
            .fail(function (jqXHR, textStatus) {
                console.log("No se ha podido realizar la petición");
                console.log("Error: Numero " + jqXHR.status.toString() + "Texto " + textStatus);
            });
    } else {

        return false;
    }

}

