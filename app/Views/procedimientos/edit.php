<!-- app/Views/procedimientos/edit.php -->

<!-- Vista para la edición de un Procedimiento -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Procedimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(1, 1fr);
            gap: 8px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Procedimiento</h1>

        <!-- Formulario para actualizar un procedimiento existente -->
        <form action="<?= base_url('procedimientos/update/'.$procedimiento['ID_PROCEDIMIENTO']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre del procedimiento -->
                <div class="mb-3">
                    <label for="NOMBRE_PROCEDIMIENTO" class="form-label">Nombre del Procedimiento</label>
                    <input type="text" class="form-control" id="NOMBRE_PROCEDIMIENTO" name="NOMBRE_PROCEDIMIENTO" value="<?= $procedimiento['NOMBRE_PROCEDIMIENTO'] ?>" required>
                </div>

                <!-- Campo para el estado del procedimiento -->
                <div class="mb-3">
                    <label for="ESTADO_PROCEDIMIENTO" class="form-label">Estado</label>
                    <select class="form-control" id="ESTADO_PROCEDIMIENTO" name="ESTADO_PROCEDIMIENTO" required>
                        <option value="1" <?= $procedimiento['ESTADO_PROCEDIMIENTO'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $procedimiento['ESTADO_PROCEDIMIENTO'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Procedimiento</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>