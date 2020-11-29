$(document).ready(function() {


    $("#crearpokes").validate({
        rules: {
            'poke[nombre]' : {
                required: true,
                rangelength: [3, 12]
            },
            'poke[hp]' : {
                required: true,
                digits: true,
                min: 1,
                max: 200
            },
            'poke[atq]' : {
                required: true,
                digits: true,
                 min: 1,
                max: 200
            },
            'poke[def]' : {
                required: true,
                digits: true,
                 min: 1,
                max: 200
            },
            'poke[spa]' : {
                required: true,
                digits: true,
                 min: 1,
                max: 200
            },
            'poke[spd]' : {
                required: true,
                digits: true,
                 min: 1,
                max: 200
            },
            'poke[vel]' : {
                required: true,
                digits: true,
                 min: 1,
                max: 200
            },
           /* 'poke[Fileimg]' : {
                required: true,
                accept: "image/png"
            },
            'poke[formato]' : {
                required: true
            },
            'poke[porcentajeuso]' : {
                required: true,
                number: true,
                min: 0.01,
                max: 100
            },*/
            'poke[tipoNombre][]' : {
                required: true,
            },
        },
        messages : {
            'poke[nombre]' : {
                required: "Debes introducir un nombre.",
                rangelength: "El nombre debe contener entre de 3 a 12 caractéres."
            },
            'poke[hp]' : {
                required: "No puedes dejar este campo vacío.",
                digits: "Solo puedes introducir números enteros.",
                min: "Debes introducir un valor mayor a 1.",
                max: "Debes introducir un valor menor a 200."
            },
            'poke[atq]' : {
                required: "No puedes dejar este campo vacío.",
                digits: "Solo puedes introducir números enteros.",
                min: "Debes introducir un valor mayor a 1.",
                max: "Debes introducir un valor menor a 200."
            },
            'poke[def]' : {
                required: "No puedes dejar este campo vacío.",
                digits: "Solo puedes introducir números enteros.",
                min: "Debes introducir un valor mayor a 1.",
                max: "Debes introducir un valor menor a 200."
            },
            'poke[spa]' : {
                required: "No puedes dejar este campo vacío.",
                digits: "Solo puedes introducir números enteros.",
                min: "Debes introducir un valor mayor a 1.",
                max: "Debes introducir un valor menor a 200."
            },
            'poke[spd]' : {
                required: "No puedes dejar este campo vacío.",
                digits: "Solo puedes introducir números enteros.",
                min: "Debes introducir un valor mayor a 1.",
                max: "Debes introducir un valor menor a 200."
            },
            'poke[vel]' : {
                required: "No puedes dejar este campo vacío.",
                digits: "Solo puedes introducir números enteros.",
                min: "Debes introducir un valor mayor a 1.",
                max: "Debes introducir un valor menor a 200."
            },
           /* 'poke[Fileimg]' : {
                required: "Debes subir una foto.",
                accept: "El formato de la imagen debe ser png."
            },
            'poke[formato]' : {
                required: "Selecciona un formato.",
            },
            'poke[porcentajeuso]' : {
                required: "No puedes dejar este campo vacío.",
                number: "Solo puedes introducir números.",
                min: "Debes introducir un valor mayor a 0.01.",
                max: "Debes introducir un valor menor a 100."
            },*/
            'poke[tipoNombre][]' : {
                required: "Debe seleccionar 1 o 2 tipos."
            },
        }
    });
  });