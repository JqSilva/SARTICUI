<!-- app/Views/proveedores/create.php -->

<!-- Crear un nuevo Proveedor -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proveedor</title>
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
        <h1>Crear Proveedor</h1>

        <!-- Formulario para crear un nuevo proveedor -->
        <form action="<?= base_url('proveedores/store') ?>" method="POST">
            <div class="parent">

                <!-- Campo para el nombre del proveedor -->
                <div class="div1">
                    <label for="NOMBRE_PROVEEDOR" class="form-label">Nombre del Proveedor</label>
                    <input type="text" class="form-control" id="NOMBRE_PROVEEDOR" name="NOMBRE_PROVEEDOR" required>
                </div>

                <!-- Campo para el contacto del proveedor -->
                <div class="div2">
                    <label for="CONTACTO_PROVEEDOR" class="form-label">Número de Contacto</label>
                    <input type="number" class="form-control" id="CONTACTO_PROVEEDOR" name="CONTACTO_PROVEEDOR" required>
                </div>

                <!-- Campo para el correo electrónico del proveedor -->
                <div class="div3">
                    <label for="CORREO_PROVEEDOR" class="form-label">Correo Electrónico</label>
                    <input type="text" class="form-control" id="CORREO_PROVEEDOR" name="CORREO_PROVEEDOR">
                </div>

                <!-- Campo para el estado del proveedor -->
                <div class="div4">
                    <label for="ESTADO_PROVEEDOR" class="form-label">Estado del Proveedor</label>
                    <select class="form-control" id="ESTADO_PROVEEDOR" name="ESTADO_PROVEEDOR" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Proveedor</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>