function mostrarPassword() {
    var cambio = document.getElementById("txtPassword");

    if (cambio.type == "password") {
        cambio.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}
$(document).ready(function () {
    $('#usernam').on('input change', function () { //El boton se habilita cuando se escribe el formulario nombre
        if ($(this).val() != '') {
            $('#entrar').prop('disabled', false);
        } else {
            $('#entrar').prop('disabled', true);
        }
    });
    //CheckBox mostrar contraseña
    $('#ShowPassword').click(function () {
        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
});
