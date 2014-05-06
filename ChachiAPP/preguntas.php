<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8" />
    <title>Hello, World</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="jquery-mobile/styles/jquery.mobile-1.3.1.min.css" rel="stylesheet" />
    <link href="styles/main.css" rel="stylesheet" />

    <script src="cordova.js" type="text/javascript"></script>
    <script src="jquery-mobile/js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="jquery-mobile/js/jquery.mobile-1.3.1.min.js" type="text/javascript"></script>
    <title>INICIO</title>
    <script src="jquery.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var question = 0;

            function loadQuestion() {
                $('#cuestionario').html('').load('preguntas.php?q=' + (++question));
            }

            $('a.empezar_quiz').click(function () {
                loadQuestion()
                $(this).hide();
                $('#next').show();
            });

            $('#next').click(function () {
                if (getN() == $('.activo').length) {
                    var val = $('#answers').val();
                    val = (val != '') ? val + '|' : val;

                    var respuestas = '';
                    $('.activo').each(function (i) {
                        respuestas += $(this).attr('id').split('-')[1];
                        if (i != ($('.activo').length - 1))
                            respuestas += ',';
                    });

                    val += getPregunta() + ':' + respuestas;
                    $('#answers').val(val);
                    loadQuestion();
                } else {
                    var n = getN();
                    var text = (n > 1) ? ' preguntas' : ' pregunta';
                    alert('Debe seleccionar ' + getN() + text);
                }
            });

            function getN() {
                return $("#cuestionario dl").attr('class').split('n')[1].split(']')[0].split('[')[1];
            }

            function getPregunta() {
                return $("#cuestionario dl").attr('id').split('-')[1];
            }

            $("#cuestionario dl dd").live('click', function () {
                if ($(this).hasClass('activo') || $('.activo').length < getN()) {
                    $(this).toggleClass('activo');
                    $("#debug").text("Hay " + $('.activo').length + " elementos seleccionados");
                }
            });

            //Una vez empieza el test el boton empezar debe desaparecer
            $('a.empezar_quiz').hide();
        });
    </script>
</head>
<body>
<?php
//EN EL ID DE CADA dl COLOCAMOS q- SEGUIDO POR EL NUMERO DE LA PREGUNTA, ESTO ES PARA SABER EN QUE PREGUNTA VAMOS
//CADA RESPUESTA SERA ALGO PARECIDO, TENDRA UN ID r- SEGUIDO POR EL NUMERO DE LA RESPUESTA
//LA CLASE QUE TIENE EL dl, SERA PARA INDICAR CUANTAS PREGUNTAS DEBEN SER SELECCIONADAS ANTES DE CONTINUAR
echo 'aqui '.$_REQUEST['q'];
 
if ($_GET['q']==1){?>
<dl id="q-1" class="n[3]">
    <dt>Pregunta 1: <b>Selecciona 3 colores:</b></dt> 
    <dd id="r-1">Rojo</dd>
    <dd id="r-2">Verde</dd> 
    <dd id="r-3">Azul</dd> 
    <dd id="r-4">Amarillo</dd> 
    <dd id="r-5">Negro</dd>
    <dd id="r-6">Naranja</dd> 
</dl>
<?php }elseif($_GET['q']==2) {?>
<dl id="q-2" class="n[1]">
    <dt>Pregunta 2: <b>Que lenguaje de programacion te gusta mas?</b></dt> 
    <dd id="r-1">JAVA</dd>
    <dd id="r-2">PHP</dd> 
    <dd id="r-3">ASP</dd> 
    <dd id="r-4">C</dd> 
</dl>
<?php }?>
<body>