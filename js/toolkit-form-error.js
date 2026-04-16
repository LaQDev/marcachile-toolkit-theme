document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencia al botón de ingresar
    var ingresarButton = document.querySelector(".marca-chile-form-portal__button button");

    // Agregar un event listener para el click en el botón
    ingresarButton.addEventListener("click", function (event) {
        // Obtener referencias a los campos de entrada
        var emailInput = document.getElementById("inputEmail");
        var passwordInput = document.getElementById("inputPassword");

        // Verificar si los campos están vacíos
        if (emailInput.value.trim() === "" || passwordInput.value.trim() === "") {
            // Obtener referencia al contenedor del formulario
            var formContainer = document.querySelector(".marca-chile-form-portal");

            // Agregar la clase de error al contenedor del formulario
            formContainer.classList.add("marca-chile-form-portal-error");
        } else {
            // Si los campos no están vacíos, eliminar la clase de error si existe
            var formContainer = document.querySelector(".marca-chile-form-portal");
            formContainer.classList.remove("marca-chile-form-portal-error");
        }
    });
});
