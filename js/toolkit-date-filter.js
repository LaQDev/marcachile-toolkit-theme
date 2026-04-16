document.getElementById('ordenarSelect').addEventListener('change', function() {
    var orden = this.value;
    ordenarElementos(orden);
});

function ordenarElementos(orden) {
    // Ordenar elementos basados en las fechas obtenidas de h6 o de la tabla
    var fechas = [];
    var elementos = document.querySelectorAll('.marca-chile-filt-box-toolkit');
    elementos.forEach(function(elemento) {
        var fecha = obtenerFechaDesdeElemento(elemento);
        if (fecha) {
            fechas.push({
                elemento: elemento,
                fecha: fecha
            });
        }
    });

    fechas.sort(function(a, b) {
        if (orden === 'ascendente') {
            return a.fecha - b.fecha;
        } else if (orden === 'descendente') {
            return b.fecha - a.fecha;
        }
    });

    // Reordenar los elementos en su contenedor
    var contenedor = document.querySelector('.marca-chile-toolkit-date-wrap');
    fechas.forEach(function(fecha) {
        contenedor.appendChild(fecha.elemento);
    });

    // Ordenar las filas de la tabla si existe
    ordenarFilasEnTabla(orden);
}

function obtenerFechaDesdeElemento(elemento) {
    var h6 = elemento.querySelector('h6');
    if (h6) {
        return obtenerFecha(h6.textContent.replace('Fecha: ', ''));
    } else {
        var tabla = elemento.querySelector('.marca-chile-table');
        if (tabla) {
            var primeraCelda = tabla.querySelector('tr.marca-chile-filt-box-toolkit td');
            if (primeraCelda) {
                return obtenerFecha(primeraCelda.textContent.trim());
            }
        }
    }
    return null;
}

function obtenerFecha(textoFecha) {
    var numDD = textoFecha.match(/\d{1,2}/)[0];
    var numMM = textoFecha.match(/[a-zA-Z]+/)[0];
    var numAA = textoFecha.match(/\d{4}/)[0];
    return new Date(numAA, obtenerIndiceMes(numMM), numDD);
}

function obtenerIndiceMes(mes) {
    var meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    return meses.indexOf(mes.toLowerCase());
}

function ordenarFilasEnTabla(orden) {
    var table = document.querySelector('.marca-chile-table');
    if (!table) return;

    var tbody = table.querySelector('tbody');
    if (!tbody) return;

    var filas = Array.from(tbody.querySelectorAll('tr.marca-chile-filt-box-toolkit'));

    filas.sort(function(a, b) {
        var fechaA = obtenerFechaDesdeFila(a);
        var fechaB = obtenerFechaDesdeFila(b);
        if (orden === 'ascendente') {
            return fechaA - fechaB;
        } else if (orden === 'descendente') {
            return fechaB - fechaA;
        }
    });

    filas.forEach(function(fila) {
        tbody.appendChild(fila);
    });
}

function obtenerFechaDesdeFila(fila) {
    var td = fila.querySelector('td');
    if (td) {
        return obtenerFecha(td.textContent.trim());
    }
    return null;
}
