<!-- app/Views/usuarios/create.php -->

<!-- Vista para la creación de un nuevo Usuario -->

<?= $this->extend('main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Librería para alertas -->

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 8px;
        }

        .div1 {
            grid-column: span 2 / span 2;
        }

        .div2 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
        }

        .div3 {
            grid-column: span 2 / span 2;
            grid-row-start: 2;
            grid-column-start: 1;
        }

        .div4 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
        }

        .div5 {
            grid-column: span 2 / span 2;
            grid-row-start: 3;
            grid-column-start: 1;
        }
        .div6 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5" bg="light">
        <h1>Crear Usuario</h1>

        <!-- Formulario para crear un nuevo usuario -->
        <form action="<?= base_url('usuarios/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el número del Usuario -->
                <div class="div1">
                    <label for="ID_USUARIO" class="form-label">ID Usuario</label>
                    <input type="number" class="form-control" id="ID_USUARIO" name="ID_USUARIO" required>
                </div>

                <!-- Campo para el nombre del Usuario -->
                <div class="div2">
                    <label for="NOMBRE_USUARIO" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="NOMBRE_USUARIO" name="NOMBRE_USUARIO" required>
                </div>

                <!-- Campo para el correo del Usuario -->
                <div class="div3">
                    <label for="CORREO_USUARIO" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="CORREO_USUARIO" name="CORREO_USUARIO">
                </div>

                <!-- Campo para la contraseña del Usuario -->
                <div class="div4">
                    <label for="CONTRASENA_USUARIO" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="CONTRASENA_USUARIO" name="CONTRASENA_USUARIO" required>
                </div>

                <!-- Selección del estamento del Usuario -->
                <div class="div5">
                    <label for="ID_ESTAMENTO_USUARIO" class="form-label">Estamento del Usuario</label>
                    <select class="form-control" id="ID_ESTAMENTO_USUARIO" name="ID_ESTAMENTO_USUARIO" required>
                        <?php foreach ($estamentos as $estamento): ?>
                            <option value="<?= esc($estamento['ID_ESTAMENTO']) ?>">
                                <?= esc($estamento['NOMBRE_ESTAMENTO']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección del perfil del Usuario -->
                <div class="div6">
                    <label for="ID_PERFIL_USUARIO" class="form-label">Perfil del Usuario</label>
                    <select class="form-control" id="ID_PERFIL_USUARIO" name="ID_PERFIL_USUARIO" required>
                        <?php foreach ($perfiles as $perfil): ?>
                            <option value="<?= esc($perfil['ID_PERFIL']) ?>">
                                <?= esc($perfil['NOMBRE_PERFIL']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Usuario</button>
            <button type="button" class="btn btn-danger" id="cancelar-btn">Cancelar</button>
        </form>
    </div>

<script>
    // Confirmación antes de cancelar
    document.getElementById('cancelar-btn').addEventListener('click', function () {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Los cambios no se guardarán.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('usuarios') ?>"; // Redirige a la lista de solicitudes
            }
        });
    });
</script>

</body>
</html>

<?= $this->endSection() ?>
