<!-- app/Views/usuarios/edit.php -->

<!-- Vista para la edición de un Usuario -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 1fr);
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
        }

        .div4 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 2;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Usuario</h1>

        <!-- Formulario para actualizar un usuario existente -->
        <form action="<?= base_url('usuarios/update/'.$usuario['ID_USUARIO']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre del Usuario -->
                <div class="div1">
                    <label for="NOMBRE_USUARIO" class="form-label">Nombre</label>
                    <input type="password" class="form-control" id="NOMBRE_USUARIO" name="NOMBRE_USUARIO" value="<?= $usuario['NOMBRE_USUARIO'] ?>" required>
                </div>

                <!-- Campo para el correo del Usuario -->
                <div class="div2">
                    <label for="CORREO_USUARIO" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="CORREO_USUARIO" name="CORREO_USUARIO" value="<?= $usuario['CORREO_USUARIO'] ?>" required>
                </div>

                <!-- Campo para la contraseña del Usuario -->
                <div class="div3">
                    <label for="CONTRASENA_USUARIO" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="CONTRASENA_USUARIO" name="CONTRASENA_USUARIO" value="<?= $usuario['CONTRASENA_USUARIO'] ?>" required>
                </div>

                <!-- Selección del perfil del Usuario -->
                <div class="div4">
                    <label for="ID_PERFIL_USUARIO" class="form-label">Perfil del Usuario</label>
                    <select class="form-control" id="ID_PERFIL_USUARIO" name="ID_PERFIL_USUARIO" required>
                        <?php foreach ($perfiles as $perfil): ?>
                            <option value="<?= $perfil['ID_PERFIL'] ?>" <?= $usuario['ID_PERFIL_USUARIO'] == $perfil['ID_PERFIL'] ? 'selected' : '' ?>>
                                <?= $perfil['NOMBRE_PERFIL'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
