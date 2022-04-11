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
            var color = ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];
			var bordercolor =  ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];

            for (var i in data) {
                name.push(data[i].Pais);
                cantidad.push(data[i].total);
            }

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Personas por pais',
                        backgroundColor: color,
                        borderColor: bordercolor,
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

    $.ajax({
        type: "POST",
        url: "./src/php/funciones/graficos/grafico2.php",
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var name = [];
            var cantidad = [];
            var color = ['RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)','RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)'];
			var bordercolor =  ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];

            for (var i in data) {
                name.push(data[i].Ciudad);
                cantidad.push(data[i].total);
            }

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Personas por ciudades',
                        backgroundColor: color,
                        borderColor: bordercolor,
                        data: cantidad
                    }
                ]
            };

            var graphTarget = $("#grafico2");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "./src/php/funciones/graficos/grafico3.php",
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var name = [];
            var cantidad = [];
            var color = ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];
			var bordercolor =  ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];

            for (var i in data) {
                name.push(data[i].Pais);
                cantidad.push(data[i].total);
            }

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Mujeres por pais',
                        backgroundColor: color,
                        borderColor: bordercolor,
                        data: cantidad
                    }
                ]
            };

            var graphTarget = $("#grafico3");

            var barGraph = new Chart(graphTarget, {
                type: 'line',
                data: chartdata
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "./src/php/funciones/graficos/grafico4.php",
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var name = [];
            var cantidad = [];
            var color = ['RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)','RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)'];
			var bordercolor =  ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];
            for (var i in data) {
                name.push(data[i].Pais);
                cantidad.push(data[i].total);
            }

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Hombres por pais',
                        backgroundColor: color,
                        borderColor: bordercolor,
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: cantidad
                    }
                ]
            };

            var graphTarget = $("#grafico4");

            var barGraph = new Chart(graphTarget, {
                type: 'line',
                data: chartdata
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "./src/php/funciones/graficos/grafico5.php",
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var name = [];
            var cantidad = [];
            var color = ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];
			var bordercolor =  ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];

            for (var i in data) {
                name.push(data[i].Ciudad);
                cantidad.push(data[i].total);
            }

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Mujeres por ciudad',
                        backgroundColor: color,
                        bordercolor: bordercolor,
                        data: cantidad
                    }
                ]
            };

            var graphTarget = $("#grafico5");

            var barGraph = new Chart(graphTarget, {
                type: 'pie',
                data: chartdata
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "./src/php/funciones/graficos/grafico6.php",
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var name = [];
            var cantidad = [];
            var color = ['RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)','RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)'];
			var bordercolor =  ['RGB(255, 51, 51)','RGB(255, 131, 51)','RGB(255, 79, 51 )','RGB(255, 181, 51 )','RGB(51, 255, 131)','RGB(51, 227, 255)','RGB(51, 116, 255)','RGB(85, 51, 255)','RGB(144, 51, 255)','RGB(255, 51, 209)','RGB(57, 255, 150)','RGB(0, 58, 159)'];

            for (var i in data) {
                name.push(data[i].Ciudad);
                cantidad.push(data[i].total);
            }

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Hombres por ciudad',
                        backgroundColor: color,
                        bordercolor: bordercolor,
                        data: cantidad
                    }
                ]
            };

            var graphTarget = $("#grafico6");

            var barGraph = new Chart(graphTarget, {
                type: 'pie',
                data: chartdata
            });
        }
    });
});

$("#graficas").dblclick(function () {
    $("#mostrarGraficas").addClass("d-none");
});