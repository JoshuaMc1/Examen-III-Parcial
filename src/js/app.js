$("#formRegistro").submit(function (e) {
    let alertPlaceholder = document.getElementById('msg');
    var opc1 = check($("#ciudad"));
    var opc2 = check($("#hombres"));
    var opc3 = check($("#mujeres"));

    if (opc1 == false) {
        alerta("Debe seleccionar una ciudad");
    } else if (opc2 == false) {
        alerta("Debe ingresar la cantidad de hombres");
    } else if (opc3 == false) {
        alerta("Debe ingresar la cantidad de mujeres");
    } else return;

    function check(object) {
        if ($(object).val().length < 1) return false;
        else return true;
    }

    function alerta($message) {
        $('#close').click();
        var wrapper = document.createElement('div');
        wrapper.innerHTML = '<div class="alert alert-danger fs-6 alert-dismissible" role="alert">' + $message + '<button type="button" id="close" class="btn-close btnClose" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        alertPlaceholder.append(wrapper);
    }

    e.preventDefault();
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

$("#graficas").click(function () {
    $("#mostrarGraficas").removeClass("d-none");


    $.ajax({
        type: "POST",
        url: "./src/php/funciones/graficos/grafico1.php",
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var name = [];
            var cantidad = [];

            for (var i in data) {
                name.push(data[i].Pais);
                cantidad.push(data[i].total);
            }

            const COLORS = [
                '#4dc9f6',
                '#f67019',
                '#f53794',
                '#537bc4',
                '#acc236',
                '#166a8f',
                '#00a950',
                '#58595b',
                '#8549ba'
            ];

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Personas por pais',
                        backgroundColor: '#49e2ff',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: cantidad
                    }
                ]
            };

            var graphTarget = $("#grafico1");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
        }
    });
});

$("#graficas").dblclick(function () {
    $("#mostrarGraficas").addClass("d-none");
});