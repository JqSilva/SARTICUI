<!-- app/Views/tiposmantenciones/edit.php -->

<!-- Vista para la edición de un Tipo de Mantención -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo de Mantención</title>
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
        <h1>Editar Tipo de Mantención</h1>

        <!-- Formulario para actualizar un Tipo de Mantención existente -->
        <form action="<?= base_url('tiposmantenciones/update/'.$tipomantencion['ID_TIPO_MANTENCION']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre del Tipo de Mantención -->
                <div class="mb-3">
                    <label for="NOMBRE_TIPO_MANTENCION" class="form-label">Nombre del Tipo de Mantención</label>
                    <input type="text" class="form-control" id="NOMBRE_TIPO_MANTENCION" name="NOMBRE_TIPO_MANTENCION" value="<?= $tipomantencion['NOMBRE_TIPO_MANTENCION'] ?>" required>
                </div>

                <!-- Selección del estado del Tipo de Mantención -->
                <div class="mb-3">
                    <label for="ESTADO_TIPO_MANTENCION" class="form-label">Estado</label>
                    <select class="form-control" id="ESTADO_TIPO_MANTENCION" name="ESTADO_TIPO_MANTENCION" required>
                        <option value="1" <?= $tipomantencion['ESTADO_TIPO_MANTENCION'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $tipomantencion['ESTADO_TIPO_MANTENCION'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Tipo de Mantención</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>