function formatRut(rut) {
    // Eliminar todos los caracteres que no sean dígitos o 'k'
    rut = rut.replace(/^0+|[^0-9kK]+/g, '').toUpperCase();

    // Validar largo mínimo
    if (rut.length < 2) return rut;

    // Separar el dígito verificador
    var cuerpo = rut.slice(0, -1);
    var dv = rut.slice(-1);

    // Aplicar puntos
    cuerpo = cuerpo.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Retornar cuerpo + '-' + dígito verificador
    return cuerpo + '-' + dv;
}

function validarRut(rut) {
    // Eliminar puntos y guion
    rut = rut.replace(/\./g, '').replace(/-/g, '');

    // Separar cuerpo y dígito verificador
    var cuerpo = rut.slice(0, -1);
    var dv = rut.slice(-1).toUpperCase();

    // Calcular dígito verificador
    var suma = 0;
    var multiplo = 2;

    // Para cada dígito del cuerpo
    for (var i = cuerpo.length - 1; i >= 0; i--) {
        suma += parseInt(cuerpo.charAt(i)) * multiplo;
        multiplo = multiplo == 7 ? 2 : multiplo + 1;
    }

    var dvEsperado = 11 - (suma % 11);
    dvEsperado = dvEsperado == 11 ? '0' : dvEsperado == 10 ? 'K' : dvEsperado.toString();

    // Validar que el dígito verificador coincide
    return dvEsperado === dv;
}

function onRutInput(event) {
    var rutInput = event.target;
    rutInput.value = formatRut(rutInput.value);
}

function onRutBlur(event) {
    var rutInput = event.target;
    var errorMessage = document.getElementById('rut-error-message');

    if (!validarRut(rutInput.value)) {
        rutInput.classList.add('border-red-500', 'border-4');
        rutInput.classList.add('bg-red-100');
        errorMessage.textContent = 'RUT inválido';
        errorMessage.classList.remove('hidden');
    } else {
        rutInput.classList.remove('border-red-500', 'border-4');
        rutInput.classList.remove('bg-red-100');
        errorMessage.classList.add('hidden');
    }
}

function onSubmitForm(event) {
    var rutInput = document.getElementById('rut');
    var errorMessage = document.getElementById('rut-error-message');

    if (!validarRut(rutInput.value)) {
        rutInput.classList.add('border-red-600', 'border-4');
        rutInput.classList.add('bg-red-100');
        errorMessage.textContent = 'RUT inválido';
        errorMessage.classList.remove('hidden');
        rutInput.focus(); // Enfocar automáticamente el campo RUT
        rutInput.select(); // Seleccionar el contenido del campo RUT
        event.preventDefault(); // Prevenir el envío del formulario
    }
}