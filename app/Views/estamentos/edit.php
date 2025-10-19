<!-- app/Views/estamentos/edit.php -->

<!-- Vista para la edición de un Estamento -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estamento</title>
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
        <h1>Editar Estamento</h1>

        <!-- Formulario para actualizar un estamento existente -->
        <form action="<?= base_url('estamentos/update/'.$estamento['ID_ESTAMENTO']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre del estamento -->
                <div class="mb-3">
                    <label for="NOMBRE_ESTAMENTO" class="form-label">Nombre del Estamento</label>
                    <input type="text" class="form-control" id="NOMBRE_ESTAMENTO" name="NOMBRE_ESTAMENTO" value="<?= $estamento['NOMBRE_ESTAMENTO'] ?>" required>
                </div>

                <!-- Campo para el sueldo por hora del estamento -->
                <div class="mb-3">
                    <label for="SUELDO_HORA_ESTAMENTO" class="form-label">Sueldo por Hora</label>
                    <input type="number" class="form-control" id="SUELDO_HORA_ESTAMENTO" name="SUELDO_HORA_ESTAMENTO" value="<?= $estamento['SUELDO_HORA_ESTAMENTO'] ?>" required>
                </div>

                <!-- Campo para el estado del estamento -->
                <div class="mb-3">
                    <label for="ESTADO_ESTAMENTO" class="form-label">Estado del Estamento</label>
                    <select class="form-control" id="ESTADO_ESTAMENTO" name="ESTADO_ESTAMENTO" required>
                        <option value="1" <?= $estamento['ESTADO_ESTAMENTO'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $estamento['ESTADO_ESTAMENTO'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Estamento</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>