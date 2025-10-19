<!-- app/Views/insumossalas/edit.php -->

<!-- Vista para la edición de un Insumo en Sala -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Movimiento a Sala</title>
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
        <h1>Editar Despacho a Sala</h1>

        <!-- Formulario para actualizar una clasificación existente -->
        <form action="<?= base_url('insumossalas/update/'.$insumosala['ID_INSUMO_SALA']) ?>" method="POST">
            <div class="parent">
                <!-- Campo para la cantidad de Insumo en Sala -->
                <div class="div1">
                    <label for="CANTIDAD_INSUMO_SALA" class="form-label">Cantidad a Sala</label>
                    <input type="text" class="form-control" id="CANTIDAD_INSUMO_SALA" name="CANTIDAD_INSUMO_SALA" value="<?= $insumosala['CANTIDAD_INSUMO_SALA'] ?>" required>
                </div>

                <!-- Campo para el nombre de Insumo en Sala -->
                <div class="div2">
                    <label for="ID_INSUMO" class="form-label">Insumo</label>
                    <select class="form-control" id="ID_INSUMO" name="ID_INSUMO" required onchange="filtrarLotes()">
                        <option value="">Seleccione un insumo</option>
                        <?php foreach ($insumos as $insumo): ?>
                            <option value="<?= $insumo['ID_INSUMO'] ?>" <?= ($insumosala['ID_INSUMO'] ?? '') == $insumo['ID_INSUMO'] ? 'selected' : '' ?>>
                                <?= $insumo['NOMBRE_INSUMO'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el lote de Insumo en Sala -->
                <div class="div3">
                    <label for="ID_LOTE_INSUMO_SALA" class="form-label">Lote</label>
                    <select class="form-control" id="ID_LOTE_INSUMO_SALA" name="ID_LOTE_INSUMO_SALA" required>
                        <option value="">Seleccione un lote</option>
                        <?php foreach ($lotes as $lote): ?>
                            <option value="<?= $lote['ID_LOTE'] ?>" data-insumo="<?= $lote['ID_INSUMO_LOTE'] ?>" 
                                <?= $insumosala['ID_LOTE_INSUMO_SALA'] == $lote['ID_LOTE'] ? 'selected' : '' ?>>
                                <?= $lote['ID_LOTE'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el nombre de sala de Insumo en Sala -->
                <div class="div4">
                    <label for="ID_SALA_INSUMO_SALA" class="form-label">Sala</label>
                    <select class="form-control" id="ID_SALA_INSUMO_SALA" name="ID_SALA_INSUMO_SALA" required>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= $sala['ID_SALA'] ?>" <?= $insumosala['ID_SALA_INSUMO_SALA'] == $sala['ID_SALA'] ? 'selected' : '' ?>>
                                <?= $sala['NOMBRE_SALA'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Movimiento a Sala</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <!-- Filtrar los lotes -->
    <script>
    function filtrarLotes() {
        let insumoSeleccionado = document.getElementById('ID_INSUMO').value;
        let opcionesLotes = document.querySelectorAll('#ID_LOTE_INSUMO_SALA option');

        opcionesLotes.forEach(opcion => {
            if (opcion.value === "") {
                opcion.style.display = "block"; // Mostrar opción por defecto
            } else {
                opcion.style.display = opcion.getAttribute('data-insumo') === insumoSeleccionado ? "block" : "none";
            }
        });
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
