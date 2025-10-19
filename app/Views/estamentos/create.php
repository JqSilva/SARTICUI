<!-- app/Views/estamentos/create.php -->

<!-- Vista para la creación de un nuevo Estamento -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Estamento</title>
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
        <h1>Crear Estamento</h1>

        <!-- Formulario para crear una nuevo estamento -->
        <form action="<?= base_url('estamentos/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre del estamento -->
                <div class="mb-3">
                    <label for="NOMBRE_ESTAMENTO" class="form-label">Nombre del Estamento</label>
                    <input type="text" class="form-control" id="NOMBRE_ESTAMENTO" name="NOMBRE_ESTAMENTO" required>
                </div>
                <!-- Campo para el sueldo por hora del estamento -->
                <div class="mb-3">
                    <label for="SUELDO_HORA_ESTAMENTO" class="form-label">Sueldo por Hora</label>
                    <input type="number" class="form-control" id="SUELDO_HORA_ESTAMENTO" name="SUELDO_HORA_ESTAMENTO" required>
                </div>
                <!-- Campo para el estado del estamento -->
                <div class="mb-3">
                    <label for="ESTADO_ESTAMENTO" class="form-label">Estado del Estamento</label>
                    <select class="form-control" id="ESTADO_ESTAMENTO" name="ESTADO_ESTAMENTO" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Estamento</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
