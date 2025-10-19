<!-- app/Views/usospacientes/edit.php -->

<!-- Vista para la edición de un Uso en Paciente -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consumo</title>
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
            grid-row-start: 2;
        }

        .div4 {
            grid-row-start: 2;
        }

        .div5 {
            grid-row-start: 2;
        }

        .div6 {
            grid-row-start: 2;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Editar Consumo</h1>

        <!-- Formulario para actualizar un uso de paciente existente -->
        <form action="<?= base_url('usospacientes/update/'.$usopaciente['ID_USO_PACIENTE']) ?>" method="POST">
            <div class="parent">
                <!-- Selección de la Sala -->
                <div class="div1">
                    <label for="ID_SALA_USO" class="form-label">Sala</label>
                    <select class="form-control" id="ID_SALA_USO" name="ID_SALA_USO" onchange="filterInsumos()" required>
                        <option value="">Seleccionar Sala</option>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= $sala['ID_SALA'] ?>"><?= $sala['NOMBRE_SALA'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección del Insumo  -->
                <div class="div2">
                    <label for="ID_INSUMO_SALA_USO" class="form-label">Insumo</label>
                    <select class="form-control" id="ID_INSUMO_SALA_USO" name="ID_INSUMO_SALA_USO" required>
                        <?php foreach ($insumossalas as $insumosala): ?>
                            <option value="<?= $insumosala['ID_INSUMO_SALA'] ?>" <?= $usopaciente['ID_INSUMO_SALA_USO'] == $insumosala['ID_INSUMO_SALA'] ? 'selected' : '' ?>>
                                <?= $insumosala['NOMBRE_INSUMO'] ?> <!-- Aquí mostramos el nombre del insumo -->
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la cantidad utilizada de Insumo -->
                <div class="div3">
                    <label for="CANTIDAD_UTILIZADA_USO" class="form-label">Cantidad Utilizada</label>
                    <input type="number" class="form-control" id="CANTIDAD_UTILIZADA_USO" name="CANTIDAD_UTILIZADA_USO" value="<?= $usopaciente['CANTIDAD_UTILIZADA_USO'] ?>" required>
                </div>

                <!-- Campo para la fecha de uso del Insumo -->
                <div class="div4">
                    <label for="FECHA_USO" class="form-label">Fecha de Uso</label>
                    <input type="date" class="form-control" id="FECHA_USO" name="FECHA_USO" value="<?= $usopaciente['FECHA_USO'] ?>" required>
                </div>

                <!-- Selección del Paciente -->
                <div class="div5">
                    <label for="ID_PACIENTE_USO" class="form-label">Paciente</label>
                    <select class="form-control" id="ID_PACIENTE_USO" name="ID_PACIENTE_USO" required>
                        <?php foreach ($pacientes as $paciente): ?>
                            <option value="<?= $paciente['ID_PACIENTE'] ?>" <?= $usopaciente['ID_PACIENTE_USO'] == $paciente['ID_PACIENTE'] ? 'selected' : '' ?>>
                                <?= $paciente['NOMBRE_PACIENTE'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección del Tipo de Registro -->
                <div class="div6">
                    <label for="ID_TIPO_REGISTRO_USO" class="form-label">Tipo de Registro</label>
                    <select class="form-control" id="ID_TIPO_REGISTRO_USO" name="ID_TIPO_REGISTRO_USO" required>
                        <?php foreach ($tiposregistros as $tiporegistro): ?>
                            <option value="<?= $tiporegistro['ID_TIPO_REGISTRO'] ?>" <?= $usopaciente['ID_TIPO_REGISTRO_USO'] == $tiporegistro['ID_TIPO_REGISTRO'] ? 'selected' : '' ?>>
                                <?= $tiporegistro['NOMBRE_TIPO_REGISTRO'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Actualizar Consumo</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script>
        // Datos de insumos disponibles en cada sala (provienen del backend)
        const insumosAlmacenados = <?= json_encode($insumossalas); ?>;

        // Función para filtrar insumos según la sala seleccionada
        function filterInsumos() {
            const salaId = document.getElementById('ID_SALA_USO').value;
            const insumoSelect = document.getElementById('ID_INSUMO_SALA_USO');

            // Limpiar el select de insumos
            insumoSelect.innerHTML = '<option value="">Seleccionar Insumo</option>';

            // Filtrar los insumos de la sala seleccionada
            const insumosDisponibles = insumosAlmacenados.filter(insumosala => insumosala.ID_SALA_INSUMO_SALA == salaId);

            // Llenar el select con los insumos filtrados
            insumosDisponibles.forEach(insumosala => {
                const option = document.createElement('option');
                option.value = insumosala.ID_INSUMO_SALA;
                option.textContent = insumosala.NOMBRE_INSUMO;
                insumoSelect.appendChild(option);
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
