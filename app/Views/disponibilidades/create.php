<!-- app/Views/disponibilidades/create.php -->

<!-- Vista para la creación de una nueva Disponibilidad -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Disponibilidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(1, 1fr);
            gap: 8px;
        }

        .div1 {
            grid-column: span 2 / span 2;
        }

        .div2 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Disponibilidad</h1>

        <!-- Formulario para crear una nueva disponibilidad -->
        <form action="<?= base_url('disponibilidades/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre de la disponibilidad -->
                <div class="div1">
                    <label for="NOMBRE_DISPONIBILIDAD" class="form-label">Nombre de la Disponibilidad</label>
                    <input type="text" class="form-control" id="NOMBRE_DISPONIBILIDAD" name="NOMBRE_DISPONIBILIDAD" required>
                </div>

                <!-- Campo para el estado de disponibilidad -->
                <div class="div2">
                    <label for="ESTADO_DISPONIBILIDAD" class="form-label">Estado de la Disponibilidad</label>
                    <select class="form-control" id="ESTADO_DISPONIBILIDAD" name="ESTADO_DISPONIBILIDAD" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Disponibilidad</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
