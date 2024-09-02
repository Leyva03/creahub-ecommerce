$(document).ready(function() {
    console.log("El script menureg.js se está ejecutando correctamente.");
    $('#moñeco').click(function() {
        event.preventDefault();
        console.log("Se hizo clic en #moñeco.");
        $('#menureg').toggle('fast'); //
    });
});
