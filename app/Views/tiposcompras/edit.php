<!-- app/Views/tiposcompras/edit.php -->

<!-- Vista para la edición de un Tipo de Compra -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo de Compra</title>
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
            margin-bottom: 10px;
        }

        .div2 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Tipo de Compra</h1>

        <!-- Formulario para actualizar un tipo de compra existente -->
        <form action="<?= base_url('tiposcompras/update/'.$tipocompra['ID_TIPO_COMPRA']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para el nombre del Tipo de Compra -->
                <div class="div1">
                    <label for="NOMBRE_TIPO_COMPRA" class="form-label">Nombre de Tipo de Compra</label>
                    <input type="text" class="form-control" id="NOMBRE_TIPO_COMPRA" name="NOMBRE_TIPO_COMPRA" value="<?= $tipocompra['NOMBRE_TIPO_COMPRA'] ?>" required>
                </div>

                <!-- Selección del estado del Tipo de Compra -->
                <div class="div2">
                    <label for="ESTADO_TIPO_COMPRA" class="form-label">Estado de Tipo de Compra</label>
                    <select class="form-control" id="ESTADO_TIPO_COMPRA" name="ESTADO_TIPO_COMPRA" required>
                        <option value="1" <?= $tipocompra['ESTADO_TIPO_COMPRA'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= $tipocompra['ESTADO_TIPO_COMPRA'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Tipo de Compra</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
