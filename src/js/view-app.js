$("#formEdit").submit(function (e) { 
    let alertPlaceholder = document.getElementById('msg');
    var opc1 = check($("#ciudad"));
    var opc2 = check($("#hombres"));
    var opc3 = check($("#mujeres"));

    if(opc1 == false) {
        alerta("Debe seleccionar una ciudad");
    }else if(opc2 == false) {
        alerta("Debe ingresar la cantidad de hombres");
    }else if(opc3 == false) {
        alerta("Debe ingresar la cantidad de mujeres");
    }else return;

    function check(object) {
        if ($(object).val().length < 1) return false;
        else return true;
    }

    function alerta($message) {
        $('#close').click();
        var wrapper = document.createElement('div');
        wrapper.innerHTML = '<div class="alert alert-danger fs-6 alert-dismissible" role="alert">'+$message+'<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        alertPlaceholder.append(wrapper);
    }

    e.preventDefault();
});

$("#btnCancelar").click(function () { 
    window.location = "../../../";
});

$("#hombres").keypress(function (e) {
    var teclado = (e.which) ? e.which : e.keyCode;

    if (teclado == 8) {
        return true;
    } else if (teclado >= 48 && teclado <= 57) {
        return true;
    } else {
        return false;
    }
});

$("#mujeres").keypress(function (e) {
    var teclado = (e.which) ? e.which : e.keyCode;

    if (teclado == 8) {
        return true;
    } else if (teclado >= 48 && teclado <= 57) {
        return true;
    } else {
        return false;
    }
});