<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://kit.fontawesome.com/937f402df2.js" crossorigin="anonymous"></script>
    <title>Generar QR</title>
</head>

<body>
    <main class="container-fluid">
        <h1 class="text-center">Generador de códigos QR</h1>
        <p class="text-center">Ingrese el valor que desea convertir en codigo QR</p>
        <section>
            <form class="row g-3" id="formularioCreateCodQr">
                <div class="col-md-6">
                    <label for="textToQr" class="visually-hidden">Texto a Qr</label>
                    <input type="text" class="form-control" id="textToQr" name="textToQr" placeholder="Ingrese Texto que quiera convertir en QR" required>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary mb-3">Convertir a Qr</button>
                </div>
            </form>
        </section>
        <section>
            <?php
            $directorio = './back/QRS';
            $archivos = scandir($directorio);

            ?>

            <table id="tablaCodQrs" class="table table-sm table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Codigo Qr</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($archivos as $archivo) :
                        // Ignorar los directorios "." y ".."
                        if ($archivo != '.' && $archivo != '..') :
                    ?>
                            <tr>
                                <td><?php echo $archivo; ?></td>
                                <td><img src="./back/QRS/<?php echo $archivo; ?>" alt="CodQr"> </td>
                                <td>Descargar</td>
                            </tr>
                    <?php
                        endif;
                    endforeach;

                    ?>

                </tbody>
            </table>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let table = new DataTable('#tablaCodQrs');

        formularioCreateCodQr.addEventListener('submit', e => {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target))
            if (data.textToQr.length == 0) {
                console.log("Campos Vacios");
            } {
                $.ajax({
                    type: "POST",
                    url: "./back/generarQr.php",
                    data: {
                        textToQr: data.textToQr
                    },
                    async: true,
                    beforeSend: function() {},
                    success: function(response) {
                        Swal.fire("Alerta", `${response.mensaje}`, "success");
                        document.getElementById("textToQr").value = "";
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            }

        });
    </script>
</body>

</html>