<!-- app/Views/licitaciones/create.php -->

<!-- Vista para la creación de una nueva Licitación -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Licitación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(4, 1fr);
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
        }

        .div5 {
            grid-column: span 2 / span 2;
            grid-row-start: 3;
        }

        .div6 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 3;
        }

        .div7 {
            grid-column: span 2 / span 2;
            grid-row-start: 4;
        }

        .div8 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 4;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Licitación</h1>

        <!-- Formulario para crear una nueva licitación -->
        <form action="<?= base_url('licitaciones/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el numero publico de licitación -->
                <div class="div1">
                    <label for="ID_PUBLICO_LICITACION" class="form-label">ID Público</label>
                    <input type="text" class="form-control" id="ID_PUBLICO_LICITACION" name="ID_PUBLICO_LICITACION" required>
                </div>

                <!-- Campo para el nombre de licitcion -->
                <div class="div2">
                    <label for="NOMBRE_LICITACION" class="form-label">Nombre de la Licitación</label>
                    <input type="text" class="form-control" id="NOMBRE_LICITACION" name="NOMBRE_LICITACION" required>
                </div>

                <!-- Campo para la resolucion exenta -->
                <div class="div3">
                    <label for="RESOLUCION_EXENTA" class="form-label">Resolucion Exenta</label>
                    <input type="number" class="form-control" id="RESOLUCION_EXENTA" name="RESOLUCION_EXENTA" required>
                </div>

                <!-- Campo para la referencia de licitacion -->
                <div class="div4">
                    <label for="REFERENCIA" class="form-label">Referencia</label>
                    <input type="number" class="form-control" id="REFERENCIA" name="REFERENCIA" required>
                </div>

                <!-- Campo para la fecha de inicio de la licitacion-->
                <div class="div5">
                    <label for="FECHA_INICIO" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="FECHA_INICIO" name="FECHA_INICIO" required>
                </div>

                <!-- Campo para la fecha de fin de la licitacion -->
                <div class="div6">
                    <label for="FECHA_FIN" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control" id="FECHA_FIN" name="FECHA_FIN" required>
                </div>

                <!-- Campo para el monto licitado de la licitacion -->
                <div class="div7">
                    <label for="MONTO_LICITADO" class="form-label">Monto Licitado</label>
                    <input type="number" class="form-control" id="MONTO_LICITADO" name="MONTO_LICITADO" required>
                </div>

                <!-- Campo para el proveedor de la licitacion -->
                <div class="div8">
                    <label for="ID_PROVEEDOR_LICITACION" class="form-label">Proveedor</label>
                    <select class="form-control" id="ID_PROVEEDOR_LICITACION" name="ID_PROVEEDOR_LICITACION" required>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?= $proveedor['ID_PROVEEDOR'] ?>"><?= $proveedor['NOMBRE_PROVEEDOR'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Campo para el insumo de la licitacion -->
            <div class="mb-3">
                <label for="ID_INSUMO_LICITACION" class="form-label">Insumo</label>
                <select class="form-control" id="ID_INSUMO_LICITACION" name="ID_INSUMO_LICITACION" required>
                    <?php foreach ($insumos as $insumo): ?>
                        <option value="<?= $insumo['ID_INSUMO'] ?>"><?= $insumo['NOMBRE_INSUMO'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Licitación</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
