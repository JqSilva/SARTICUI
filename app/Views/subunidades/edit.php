<!-- app/Views/subunidades/edit.php -->

<!-- Vista para la edición de una SubUnidad -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar SubUnidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(1, 1fr);
            gap: 8px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar SubUnidad</h1>

        <!-- Formulario para actualizar una subunidad existente -->
        <form action="<?= base_url('subunidades/update/'.$subunidad['ID_SUBUNIDAD']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre de la Subunidad -->
                <div class="mb-3">
                    <label for="NOMBRE_SUBUNIDAD" class="form-label">Nombre de la SubUnidad</label>
                    <input type="text" class="form-control" id="NOMBRE_SUBUNIDAD" name="NOMBRE_SUBUNIDAD" value="<?= $subunidad['NOMBRE_SUBUNIDAD'] ?>" required>
                </div>

                <!-- Campo para el nombre del Responsable de la Subunidad -->
                <div class="mb-3">
                    <label for="RESPONSABLE_SUBUNIDAD" class="form-label">Responsable de la SubUnidad</label>
                    <input type="text" class="form-control" id="RESPONSABLE_SUBUNIDAD" name="RESPONSABLE_SUBUNIDAD" value="<?= $subunidad['RESPONSABLE_SUBUNIDAD'] ?>" required>
                </div>

                <!-- Selección del estado de la Subunidad -->
                <div class="mb-3">
                    <label for="ESTADO_SUBUNIDAD" class="form-label">Estado de la SubUnidad</label>
                    <select class="form-control" id="ESTADO_SUBUNIDAD" name="ESTADO_SUBUNIDAD" required>
                        <option value="1" <?= $subunidad['ESTADO_SUBUNIDAD'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $subunidad['ESTADO_SUBUNIDAD'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Clasificación</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>