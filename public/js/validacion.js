$(document).ready(function() {

    $("#pokemovformatform").validate({
        rules: {
            'poke_puede_aprender_mov[porcentajeUso]' : {
                required: true,
                range: [0.001,100]
            },
            'poke_puede_aprender_mov[formato]' : {
                required: true,
            },
            'poke_puede_aprender_mov[pokemonIdpoke]' : {
                required: true,
            },
            'poke_puede_aprender_mov[movimiento]' : {
                required: true,
            }

        },messages : {
            'poke_puede_aprender_mov[porcentajeUso]' : {
                required: "No puede dejar este campo vacío.",
                range: "Debe ser un valor entre 0,001 y 100."
            },
            'poke_puede_aprender_mov[formato]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'poke_puede_aprender_mov[pokemonIdpoke]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'poke_puede_aprender_mov[movimiento]' : {
                required: "No puedes dejar este campo vacío.",
            }
        }
    })
    
    $("#pokeobjformatform").validate({
        rules: {
            'poke_usa_obj[porcentajeUso]' : {
                required: true,
                range: [0.001,100]
            },
            'poke_usa_obj[formato]' : {
                required: true,
            },
            'poke_usa_obj[pokemonIdpoke]' : {
                required: true,
            },
            'poke_usa_obj[objetoIdobjeto]' : {
                required: true,
            }

        },messages : {
            'poke_usa_obj[porcentajeUso]' : {
                required: "No puede dejar este campo vacío.",
                range: "Debe ser un valor entre 0,001 y 100."
            },
            'poke_usa_obj[formato]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'poke_usa_obj[pokemonIdpoke]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'poke_usa_obj[objetoIdobjeto]' : {
                required: "No puedes dejar este campo vacío.",
            }
        }
    })

    $("#pokeformatform").validate({
        rules: {
            'pokemon_esta_en_formato[porcentajeUso]' : {
                required: true,
                range: [0.001,100]
            },
            'pokemon_esta_en_formato[formato]' : {
                required: true,
            },
            'pokemon_esta_en_formato[pokemonIdpoke]' : {
                required: true,
            }

        },messages : {
            'pokemon_esta_en_formato[porcentajeUso]' : {
                required: "No puede dejar este campo vacío.",
                range: "Debe ser un valor entre 0,001 y 100."
            },
            'pokemon_esta_en_formato[formato]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'pokemon_esta_en_formato[pokemonIdpoke]' : {
                required: "No puedes dejar este campo vacío.",
            }
        }
    })

    $("#spreadform").validate({
            rules: {
                'spread[stats]' : {
                    required: true,
                }
            },messages : {
                'spread[stats]' : {
                    required: "No puede dejar este campo vacío.",
                   
                }
            }
        })

    $("#objetoform").validate({
        rules: {
            'objeto[nombre]' : {
                required: true,
                rangelength: [2, 40]
            }
        },messages : {
            'objeto[nombre]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango del nombre debe ser de 2 a 40 caractéres."
            }
        }
    })

    $("#movimientoform").validate({
        rules: {
            'movimiento[nombre]' : {
                required: true,
                rangelength: [2, 40]
            },
            'movimiento[tipoNombre]' : {
                required: true
            }
        },messages : {
            'movimiento[nombre]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango del nombre debe ser de 2 a 40 caractéres."
            },
            'movimiento[tipoNombre]' : {
                required: "No puedes dejar este campo vacío."
            }
        }
    })

    $("#habilidadform").validate({
        rules: {
            'habilidad[nombre]' : {
                required: true,
                rangelength: [2, 20]
            }
        },messages : {
            'habilidad[nombre]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango del nombre debe ser de 2 a 20 caractéres."
            }
        }
    })

    $("#formatoform").validate({
        rules: {
            'formato[nombre]' : {
                required: true,
                rangelength: [2, 20]
            }
        },messages : {
            'formato[nombre]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango del nombre debe ser de 2 a 20 caractéres."
            }
        }
    })

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