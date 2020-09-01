<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <?php $title="Registro | RedCovery" ?>
    <?php include("head.php");?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h1 class="h3 text-center">
                    <strong>Regístrate</strong>
                </h1>
                <div class="form-group">
                    <label for="">CODIGO DE CURSO</label>
                    <div class="input-group">
                        <input id="dni" type="text" class="form-control" placeholder="Ingresar Codigo">
                        <span class="input-group-btn">
                            <button id="btnFetchDNI" class="btn btn-success" type="button">
                                <i class="fa fa-fw fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <span id="loadingFetchDNI" style="display:none" class="text-muted">
                        <small>
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i> Buscando...
                        </small>
                    </span>
                </div>
                <form id="frmRegistro">

                    <div class="form-group">
                        <label for="">Curso</label>
                        <input name="nombres" type="text" id="nombres" class="form-control" required placeholder="Curso">
                    </div>
                    <div class="form-group">
                        <label for="">Nombre de Estudiante</label>
                        <input name="apellidos" type="text" id="apellidos" class="form-control" required placeholder="Nombre de estudiante">
                    </div>
                    <div class="form-group">
                        <label for="">Codigo de estudiante</label>
                        <input name="direccion" type="text" id="direccion" class="form-control" placeholder="Codigo de estudiante">
                    </div>
                    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function fetchDNI (dni) {
            if (dni.length != 8) return alert('Ingrese un DNI válido')

            $("#loadingFetchDNI").css({display: 'block'})

            $("#nombres").val('').attr('readonly', true);
            $("#apellidos").val('').attr('readonly', true);
            $("#direccion").val('').attr('readonly', true);

            $.get('https://ekorp-api.herokuapp.com/api/v1/dniruc/?type=dni&code=' + dni, function (data) {
                console.log("api dni", data.apellidoMaterno);
                $("#nombres").val( (data.nombres || '').trim() )
                $("#apellidos").val(((data.apellidoPaterno || '') + ' ' + (data.apellidoMaterno || '')).trim())
                $("#direccion").val(data.direccion || '')
                        
            })
            .fail(function() {
                alert('Error desconocido al traer los datos, por favor intente más tarde...')
            })
            .always(function() {
                $("#loadingFetchDNI").css({display: 'none'})
                $("#nombres").removeAttr('readonly');
                $("#apellidos").removeAttr('readonly');
                $("#direccion").removeAttr('readonly');
            });
        }

        $("#dni").keyup(function (e) {
            e.preventDefault()
            if (e.keyCode == 13) {
                let dni = $(this).val()
                fetchDNI(dni)
            }
        })

        $("#btnFetchDNI").click(function (e) {
            let dni = $("#dni").val()
            fetchDNI(dni)
        })

        $("#frmRegistro").on('submit', function(e) {
            e.preventDefault()

            let nombres = $("input[name=nombres]").val().trim(),
                apellidos = $("input[name=apellidos]").val().trim(),
                direccion = $("input[name=direccion]").val().trim(),
                email = $("input[name=email]").val().trim(),
                usuario = $("input[name=usuario]").val().trim(),
                password = $("input[name=password]").val().trim(),
                passwordConfirmation = $("input[name=password_confirmation]").val().trim()
            
            if ( !(nombres && apellidos && email && usuario && password && passwordConfirmation) ) {
                return alert('Completa todos los campos')
            }

            if (password != passwordConfirmation) {
                return alert('Las contraseñas no coinciden')
            }

            $("#btnRegistrame").attr('disabled', true)

            $.post('/ajax/registro.php', {
                nombres, apellidos, direccion, email, usuario, password, passwordConfirmation
            }, function (data) {
                console.log(data);
                if (data.status == 'error') {
                    return alert(data.message)
                }

                alert(data.message)
                window.location.href = '/login.php'
            })
            .fail(function(error) {
                console.error(error);
                alert('Error al registrar tus datos, por favor inténtelo más tarde...')
            })
            .always(function () {
                $("#btnRegistrame").removeAttr('disabled')
            })

        })
    </script>
</body>
</html>