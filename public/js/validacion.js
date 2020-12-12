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

    $("#pokepartnerformatform").validate({
        rules: {
            'pokemon_tiene_partner[porcentajeUso]' : {
                required: true,
                range: [0.001,100]
            },
            'pokemon_tiene_partner[formato]' : {
                required: true,
            },
            'pokemon_tiene_partner[pokemonIdpoke]' : {
                required: true,
            },
            'pokemon_tiene_partner[pokemonIdpoke1]' : {
                required: true,
            }

        },messages : {
            'pokemon_tiene_partner[porcentajeUso]' : {
                required: "No puede dejar este campo vacío.",
                range: "Debe ser un valor entre 0,001 y 100."
            },
            'pokemon_tiene_partner[formato]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'pokemon_tiene_partner[pokemonIdpoke]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'pokemon_tiene_partner[pokemonIdpoke1]' : {
                required: "No puedes dejar este campo vacío.",
            }
        }
    })
    
    $("#pokehabformatform").validate({
        rules: {
            'poke_tiene_habilidad[porcentajeUso]' : {
                required: true,
                range: [0.001,100]
            },
            'poke_tiene_habilidad[formato]' : {
                required: true,
            },
            'poke_tiene_habilidad[pokemonIdpoke]' : {
                required: true,
            },
            'poke_tiene_habilidad[habilidad]' : {
                required: true,
            }

        },messages : {
            'poke_tiene_habilidad[porcentajeUso]' : {
                required: "No puede dejar este campo vacío.",
                range: "Debe ser un valor entre 0,001 y 100."
            },
            'poke_tiene_habilidad[formato]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'poke_tiene_habilidad[pokemonIdpoke]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'poke_tiene_habilidad[habilidad]' : {
                required: "No puedes dejar este campo vacío.",
            }
        }
    })

    $("#pokespreadformatform").validate({
        rules: {
            'pokemon_tiene_spread[porcentajeUso]' : {
                required: true,
                range: [0.001,100]
            },
            'pokemon_tiene_spread[formato]' : {
                required: true,
            },
            'pokemon_tiene_spread[pokemonIdpoke]' : {
                required: true,
            },
            'pokemon_tiene_spread[spreadIdspread]' : {
                required: true,
            }

        },messages : {
            'pokemon_tiene_spread[porcentajeUso]' : {
                required: "No puede dejar este campo vacío.",
                range: "Debe ser un valor entre 0,001 y 100."
            },
            'pokemon_tiene_spread[formato]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'pokemon_tiene_spread[pokemonIdpoke]' : {
                required: "No puedes dejar este campo vacío.",
            },
            'pokemon_tiene_spread[spreadIdspread]' : {
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

    $("#articuloform").validate({
            rules: {
                'articulo[titulo]' : {
                    required: true,
                    rangelength: [2, 40]
                },
                'articulo[contenido]' : {
                    required: true,
                    rangelength: [10, 65535]
                }
            },messages : {
                'articulo[titulo]' : {
                    required: "No puede dejar este campo vacío.",
                    rangelength: "El rango del título debe ser de 2 a 40 caractéres."
                   
                },
                'articulo[contenido]' : {
                    required: "No puede dejar este campo vacío.",
                    rangelength: "El rango del título debe ser de 10 a 65535 caractéres."
                }
            }
        })

    $("#registrationform").validate({
        rules: {
            'registration_form[email]' : {
                required: true,
                email: true,
                rangelength: [5,50]
            },
            'registration_form[password]' : {
                required: true,
                rangelength: [4,20]
            }
        },messages : {
            'registration_form[email]' : {
                required: "No puede dejar este campo vacío.",
                email: "Debe ser un email correcto.",
                rangelength: "El número de caractéres del email debe ser de 5 a 50."
               
            },
            'registration_form[password]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango de la contraseña debe ser de 4 a 20 caractéres."
            }
        }
    })
    
    $("#loginform").validate({
        rules: {
            'email' : {
                required: true,
                email: true,
                rangelength: [5,50]
            },
            'password' : {
                required: true,
                rangelength: [4,20]
            }
        },messages : {
            'email' : {
                required: "No puede dejar este campo vacío.",
                email: "Debe ser un email correcto.",
                rangelength: "El número de caractéres del email debe ser de 5 a 50."
               
            },
            'password' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango de la contraseña debe ser de 4 a 20 caractéres."
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

    $("#campeonatoform").validate({
        rules: {
            'campeonato1[nombre]' : {
                required: true,
                rangelength: [2, 45]
            },
            'campeonato1[categoria]' : {
                required: true,
                rangelength: [2, 45]
            },
            'campeonato1[formato]': {
                required: true
            }
        },messages : {
            'movimiento[nombre]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango del nombre debe ser de 2 a 45 caractéres."
            },
            'campeonato1[categoria]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango del nombre debe ser de 2 a 45 caractéres."
            },
            'campeonato1[formato]': {
                required: true
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

    $("#equipoform").validate({
        rules: {
            'equipo[nombre]' : {
                required: true,
            },
            'equipo[usuarioEmail]' : {
                required: true
            }
        },messages : {
            'equipo[nombre]' : {
                required: "No puede dejar este campo vacío.",
            },
            'equipo[usuarioEmail]' : {
                required: "No puedes dejar este campo vacío."
            }
        }
    })

    $("#jugadorform").validate({
        rules: {
            'jugador1[nombre]' : {
                required: true,
                rangelength: [2, 45]
            }
        },messages : {
            'jugador1[nombre]' : {
                required: "No puede dejar este campo vacío.",
                rangelength: "El rango del nombre debe ser de 2 a 45 caractéres."
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

    $("#jugadorpokecampform").validate({
        rules: {
            'jugador_pokes_campeonato[pokemonIdpoke]' : {
                required: true
            },
            'jugador_pokes_campeonato[mov1]' : {
                required: true
            },
            'jugador_pokes_campeonato[mov2]' : {
                required: true
            },
            'jugador_pokes_campeonato[mov3]' : {
                required: true
            },
            'jugador_pokes_campeonato[mov4]' : {
                required: true
            },
            'jugador_pokes_campeonato[objeto]' : {
                required: true
            },
            'jugador_pokes_campeonato[habilidad]' : {
                required: true
            },
            'jugador_pokes_campeonato[campeonatoIdcampeonato]' : {
                required: true
            },
            'jugador_pokes_campeonato[jugadorIdjugador]' : {
                required: true
            },
            
        },messages : {
            'jugador_pokes_campeonato[pokemonIdpoke]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[mov1]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[mov2]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[mov3]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[mov4]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[objeto]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[habilidad]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[campeonatoIdcampeonato]' : {
                required: "No puede dejar este campo vacío."
            },
            'jugador_pokes_campeonato[jugadorIdjugador]' : {
                required: "No puede dejar este campo vacío."
            }
        }
    })
  });