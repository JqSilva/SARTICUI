<!-- app/Views/lotes/edit.php -->

<!-- Vista para la edición de un Lote de Insumos -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Lote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(3, 1fr);
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
            grid-column-start: 1;
            grid-row-start: 2;
        }

        .div6 {
            grid-column-start: 2;
        }

        .div7 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
        }

        .div8 {
            grid-column: span 2 / span 2;
            grid-row-start: 3;
            grid-column-start: 1;
        }

        .div9 {
            grid-column-start: 3;
            grid-row-start: 3;
        }

        .div10 {
            grid-column-start: 4;
            grid-row-start: 3;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Lote</h1>

        <!-- Formulario para actualizar un lote existente -->
        <form action="<?= base_url('lotes/update/'.$lote['ID_LOTE']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para la marca del lote -->
                <div class="div1">
                    <label for="MARCA_LOTE" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="MARCA_LOTE" name="MARCA_LOTE" value="<?= $lote['MARCA_LOTE'] ?>" required>
                </div>

                <!-- Campo para el codigo del producto del lote -->
                <div class="div2">
                    <label for="CODIGO_PRODUCTO_LOTE" class="form-label">Código de Barras</label>
                    <input type="number" class="form-control" id="CODIGO_PRODUCTO_LOTE" name="CODIGO_PRODUCTO_LOTE" value="<?= $lote['CODIGO_PRODUCTO_LOTE'] ?>" required>
                </div>

                <!-- Campo para la unidad abas del lote -->
                <div class="div3">
                    <label for="UNIDAD_ABAS_LOTE" class="form-label">Unidad</label>
                    <input type="text" class="form-control" id="UNIDAD_ABAS_LOTE" name="UNIDAD_ABAS_LOTE" value="<?= $lote['UNIDAD_ABAS_LOTE'] ?>" required>
                </div>

                <!-- Campo para la cantidad total del lote -->
                <div class="div4">
                    <label for="CANTIDAD_TOTAL_LOTE" class="form-label">Cantidad Total</label>
                    <input type="number" class="form-control" id="CANTIDAD_TOTAL_LOTE" name="CANTIDAD_TOTAL_LOTE" value="<?= $lote['CANTIDAD_TOTAL_LOTE'] ?>" required>
                </div>

                <!-- Campo para el costo unitario del lote -->
                <div class="div5">
                    <label for="COSTO_UNITARIO_LOTE" class="form-label">Costo Unitario</label>
                    <input type="number" class="form-control" id="COSTO_UNITARIO_LOTE" name="COSTO_UNITARIO_LOTE" value="<?= $lote['COSTO_UNITARIO_LOTE'] ?>" required>
                </div>

                <!-- Campo para la fecha de vencimiento del lote -->
                <div class="div6">
                    <label for="FECHA_VENCIMIENTO" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" class="form-control" id="FECHA_VENCIMIENTO" name="FECHA_VENCIMIENTO" value="<?= $lote['FECHA_VENCIMIENTO'] ?>" required>
                </div>

                <!-- Campo para el número del insumo del lote -->
                <div class="div7">
                    <label for="ID_INSUMO_LOTE" class="form-label">Insumo</label>
                    <select class="form-control" id="ID_INSUMO_LOTE" name="ID_INSUMO_LOTE" required>
                        <?php foreach ($insumos as $insumo): ?>
                            <option value="<?= $insumo['ID_INSUMO'] ?>" <?= $lote['ID_INSUMO_LOTE'] == $insumo['ID_INSUMO'] ? 'selected' : '' ?>>
                                <?= $insumo['NOMBRE_INSUMO'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el número del proveedor del lote -->
                <div class="div8">
                    <label for="ID_PROVEEDOR_LOTE" class="form-label">Proveedor</label>
                    <select class="form-control" id="ID_PROVEEDOR_LOTE" name="ID_PROVEEDOR_LOTE" required>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <option value="<?= $proveedor['ID_PROVEEDOR'] ?>" <?= $lote['ID_PROVEEDOR_LOTE'] == $proveedor['ID_PROVEEDOR'] ? 'selected' : '' ?>>
                                <?= $proveedor['NOMBRE_PROVEEDOR'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el número de la procedencia del lote -->
                <div class="div9">
                    <label for="ID_PROCEDENCIA_LOTE" class="form-label">Procedencia</label>
                    <select class="form-control" id="ID_PROCEDENCIA_LOTE" name="ID_PROCEDENCIA_LOTE" required>
                        <?php foreach ($procedencias as $procedencia): ?>
                            <option value="<?= $procedencia['ID_PROCEDENCIA'] ?>" <?= $lote['ID_PROCEDENCIA_LOTE'] == $procedencia['ID_PROCEDENCIA'] ? 'selected' : '' ?>>
                                <?= $procedencia['NOMBRE_PROCEDENCIA'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el número del tipo de compra del lote -->
                <div class="div10">
                    <label for="ID_TIPO_COMPRA_LOTE" class="form-label">Tipo de Compra</label>
                    <select class="form-control" id="ID_TIPO_COMPRA_LOTE" name="ID_TIPO_COMPRA_LOTE" required>
                        <?php foreach ($tiposcompras as $tipocompra): ?>
                            <option value="<?= $tipocompra['ID_TIPO_COMPRA'] ?>" <?= $lote['ID_TIPO_COMPRA_LOTE'] == $tipocompra['ID_TIPO_COMPRA'] ? 'selected' : '' ?>>
                                <?= $tipocompra['NOMBRE_TIPO_COMPRA'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Campo para las observaciones del lote -->
            <div class="mb-3">
                <label for="OBSERVACION_LOTE" class="form-label">Observaciones</label>
                <input type="text" class="form-control" id="OBSERVACION_LOTE" name="OBSERVACION_LOTE" value="<?= $lote['OBSERVACION_LOTE'] ?>">
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Lote</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
