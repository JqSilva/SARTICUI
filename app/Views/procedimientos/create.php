<!-- app/Views/procedimientos/create.php -->

<!-- Vista para la creación de un nuevo Procedimiento -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Procedimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
            gap: 8px;
        }
        .div1 {
            grid-column-start: 1;
        }
        .div2 {
            grid-column-start: 2;
        }
        .div3 {
            grid-column: span 2 / span 2;
            grid-row-start: 2;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Procedimiento</h1>

        <!-- Formulario para crear un nuevo procedimiento -->
        <form action="<?= base_url('procedimientos/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el número de procedimiento -->
                <div class="div1">
                    <label for="ID_PROCEDIMIENTO" class="form-label">ID</label>
                    <input type="number" class="form-control" id="ID_PROCEDIMIENTO" name="ID_PROCEDIMIENTO" required>
                </div>

                <!-- Campo para el nombre del procedimiento -->
                <div class="div2">
                    <label for="NOMBRE_PROCEDIMIENTO" class="form-label">Nombre del Procedimiento</label>
                    <input type="text" class="form-control" id="NOMBRE_PROCEDIMIENTO" name="NOMBRE_PROCEDIMIENTO" required>
                </div>

                <!-- Campo para el estado del procedimiento -->
                <div class="div3">
                    <label for="ESTADO_PROCEDIMIENTO" class="form-label">Estado</label>
                    <select class="form-control" id="ESTADO_PROCEDIMIENTO" name="ESTADO_PROCEDIMIENTO" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Procedimiento</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
