<!-- app/Views/lotes/create.php -->

<!-- Vista para la creación de un nuevo Loten de Insumos -->

<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Lote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Librería para alertas -->

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(4, 1fr);
            gap: 8px;
        }
        .div1 {
            grid-column-start: 1;
        }
        .div2 {
            grid-column-start: 2;
        }
        .div3 {
            grid-column-start: 3;
        }
        .div4 {
            grid-column-start: 4;
        }
        .div5 {
            grid-column: span 2 / span 2;
            grid-row-start: 2;
        }

        .div6 {
            grid-column-start: 3;
        }

        .div7 {
            grid-column-start: 4;
        }

        .div8 {
            grid-column: span 2 / span 2;
            grid-row-start: 3;
        }

        .div9 {
            grid-column-start: 3;
            grid-row-start: 3;
        }

        .div10 {
            grid-column-start: 4;
            grid-row-start: 3;
        }

        .div11 {
            grid-row-start: 4;
        }

        .div12 {
            grid-column: span 3 / span 3;
            grid-row-start: 4;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Lote</h1>

        <!-- Formulario para crear una nueva licitación -->
        <form action="<?= base_url('lotes/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el número del lote -->
                <div class="div1">
                    <label for="ID_LOTE" class="form-label">ID Lote</label>
                    <input type="number" class="form-control" id="ID_LOTE" name="ID_LOTE" required>
                </div>

                <!-- Campo para la marca del lote -->
                <div class="div2">
                    <label for="MARCA_LOTE" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="MARCA_LOTE" name="MARCA_LOTE" required>
                </div>

                <!-- Campo para el codigo del producto del lote -->
                <div class="div3">
                    <label for="CODIGO_PRODUCTO_LOTE" class="form-label">Codigo de Barras</label>
                    <input type="number" class="form-control" id="CODIGO_PRODUCTO_LOTE" name="CODIGO_PRODUCTO_LOTE" required>
                </div>

                <!-- Campo para la unidad abas en el lote -->
                <div class="div4">
                    <label for="UNIDAD_ABAS_LOTE" class="form-label">Unidad</label>
                    <input type="text" class="form-control" id="UNIDAD_ABAS_LOTE" name="UNIDAD_ABAS_LOTE" required>
                </div>

                <!-- Campo para la cantidad total del lote -->
                <div class="div5">
                    <label for="CANTIDAD_TOTAL_LOTE" class="form-label">Cantidad Total</label>
                    <input type="number" class="form-control" id="CANTIDAD_TOTAL_LOTE" name="CANTIDAD_TOTAL_LOTE" required>
                </div>

                <!-- Campo para el costo unitario del lote -->
                <div class="div6">
                    <label for="COSTO_UNITARIO_LOTE" class="form-label">Costo Unitario</label>
                    <input type="number" class="form-control" id="COSTO_UNITARIO_LOTE" name="COSTO_UNITARIO_LOTE" required>
                </div>

                <!-- Campo para la fecha de vencimiento del lote -->
                <div class="div7">
                    <label for="FECHA_VENCIMIENTO" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" class="form-control" id="FECHA_VENCIMIENTO" name="FECHA_VENCIMIENTO" required>
                </div>

                <!-- Campo para el insumo en el lote  -->
                <div class="div8">
                    <label for="ID_INSUMO_LOTE" class="form-label">Insumo</label>
                    <select class="form-control" id="ID_INSUMO_LOTE" name="ID_INSUMO_LOTE" required>
                        <?php foreach ($insumos as $insumo): ?>
                            <option value="<?= $insumo['ID_INSUMO'] ?>"><?= $insumo['NOMBRE_INSUMO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el proveedor del lote -->
                <div class="div9">
                    <label for="ID_PROVEEDOR_LOTE" class="form-label">Proveedor</label>
                    <select class="form-control" id="ID_PROVEEDOR_LOTE" name="ID_PROVEEDOR_LOTE" required>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?= $proveedor['ID_PROVEEDOR'] ?>"><?= $proveedor['NOMBRE_PROVEEDOR'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el número de procedencia del lote -->
                <div class="div10">
                    <label for="ID_PROCEDENCIA_LOTE" class="form-label">Procedencia</label>
                    <select class="form-control" id="ID_PROCEDENCIA_LOTE" name="ID_PROCEDENCIA_LOTE" required>
                        <?php foreach ($procedencias as $procedencia): ?>
                            <option value="<?= $procedencia['ID_PROCEDENCIA'] ?>"><?= $procedencia['NOMBRE_PROCEDENCIA'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el número del tipo de compra del lote -->
                <div class="div11">
                    <label for="ID_TIPO_COMPRA_LOTE" class="form-label">Tipo de Compra</label>
                    <select class="form-control" id="ID_TIPO_COMPRA_LOTE" name="ID_TIPO_COMPRA_LOTE" required>
                        <?php foreach ($tiposcompras as $tipocompra): ?>
                            <option value="<?= $tipocompra['ID_TIPO_COMPRA'] ?>"><?= $tipocompra['NOMBRE_TIPO_COMPRA'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para las observaciones del lote -->
                <div class="div12">
                    <label for="OBSERVACION_LOTE" class="form-label">Observaciones</label>
                    <input type="text" class="form-control" id="OBSERVACION_LOTE" name="OBSERVACION_LOTE">
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Lote</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" id="cancelar-btn">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- Confirmación de Cancelar en el Lote -->
<script>
    document.getElementById('cancelar-btn').addEventListener('click', function () {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Los cambios no se guardarán.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "No"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?= base_url('lotes') ?>"; // Redirige a la lista de lotes
            }
        });
    });
</script>

</html>

<?= $this->endSection() ?>
