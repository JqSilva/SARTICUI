<!-- app/Views/prestaciones/create.php -->

<!-- Vista para la creación de una nueva Clasificación de Insumos -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Prestación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Librería para alertas -->

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(3, auto);
            gap: 8px;
        }

        .div1 {
            grid-column: span 2 / span 2;
        }

        .div2 {
            grid-column-start: 3;
        }

        .div3 {
            grid-column-start: 4;
        }

        .div4 {
            grid-column: span 2 / span 2;
            grid-row-start: 2;
        }

        .div5 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 2;
        }

        .div6 {
            grid-column: span 2 / span 2;
            grid-row-start: 3;
        }

        .div7 {
            grid-column: span 2 / span 2;
            grid-column-start: 3;
            grid-row-start: 3;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Prestación</h1>

        <!-- Formulario para crear una nueva prestación -->
        <form action="<?= base_url('prestaciones/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para la fecha de prestación -->
                <div class="div1">
                    <label for="FECHA_PRESTACION" class="form-label">Fecha de Prestación</label>
                    <input type="date" class="form-control" id="FECHA_PRESTACION" name="FECHA_PRESTACION" required>
                </div>

                <!-- Campo para la hora de inicio de la prestación -->
                <div class="div2">
                    <label for="HORA_INICIO" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control" id="HORA_INICIO" name="HORA_INICIO" required>
                </div>

                <!-- Campo para la hora de fin de la prestación -->
                <div class="div3">
                    <label for="HORA_FIN" class="form-label">Hora de Termino</label>
                    <input type="time" class="form-control" id="HORA_FIN" name="HORA_FIN" required>
                </div>

                <!-- Campo para el procedimiento de la prestación -->
                <div class="div4">
                    <label for="ID_PROCEDIMIENTO_PRES" class="form-label">Procedimiento</label>
                    <select class="form-control" id="ID_PROCEDIMIENTO_PRES" name="ID_PROCEDIMIENTO_PRES" required>
                        <?php foreach ($procedimientos as $procedimiento): ?>
                            <option value="<?= $procedimiento['ID_PROCEDIMIENTO'] ?>"><?= $procedimiento['NOMBRE_PROCEDIMIENTO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la condicion del paciente de la prestación -->
                <div class="div5">
                    <label for="ID_CONDICION_PACIENTE_PRES" class="form-label">Condición del Paciente</label>
                    <select class="form-control" id="ID_CONDICION_PACIENTE_PRES" name="ID_CONDICION_PACIENTE_PRES" required>
                        <?php foreach ($condicionespacientes as $condicionpaciente): ?>
                            <option value="<?= $condicionpaciente['ID_CONDICION_PACIENTE'] ?>"><?= $condicionpaciente['NOMBRE_CONDICION_PACIENTE'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el paciente de la prestación -->
                <div class="div6">
                    <label for="ID_PACIENTE_PRES" class="form-label">Paciente</label>
                    <select class="form-control" id="ID_PACIENTE_PRES" name="ID_PACIENTE_PRES" required>
                        <option value="" disabled selected>Seleccione un paciente</option>
                        <?php foreach ($pacientes as $paciente): ?>
                            <option value="<?= $paciente['ID_PACIENTE'] ?>"
                            data-nombre="<?= $paciente['NOMBRE_PACIENTE'] ?>"
                            data-apaterno="<?= $paciente['APATERNO_PACIENTE'] ?>">
                            <?= $paciente['RUT_PACIENTE'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p id="nombre_paciente" class="fw-bold mt-2"></p>
                </div>

                <!-- Campo para la sala de prestación -->
                <div class="div7">
                    <label for="ID_SALA_PRES" class="form-label">Sala</label>
                    <select class="form-control" id="ID_SALA_PRES" name="ID_SALA_PRES" required>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= $sala['ID_SALA'] ?>"><?= $sala['NOMBRE_SALA'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <hr class="my-4" />
            <!-- Insumos y Cantidades -->
            <div id="lotes-container">
                <h4>Lotes Utilizados</h4>
                <div class="mb-3 lote-row">
                    <label for="lote_1" class="form-label">Lote</label>
                    <select class="form-control" id="lote_1" name="lotes[0][ID_LOTE_LT]" required>
                        <?php foreach ($lotes as $lote): ?>
                            <option value="<?= $lote['ID_LOTE'] ?>"><?= $lote['ID_LOTE'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="cantidad_1" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad_1" name="lotes[0][CANTIDAD_UTILIZADA]" required min="1">
                </div>
            </div>
            <hr class="my-4" />
            <!-- Equipos -->
            <div id="equipos-container">
                <h4>Equipos Utilizados</h4>
                <div class="mb-3 equipo-row">
                    <label for="equipo_1" class="form-label">Equipo</label>
                    <select class="form-control" id="equipo_1" name="equipos[0][ID_EQUIPO_MEDICO_PRE]" required>
                        <?php foreach ($equipos as $equipo): ?>
                            <option value="<?= $equipo['ID_EQUIPO_MEDICO'] ?>"><?= $equipo['NOMBRE_EQUIPO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <hr class="my-4" />
            <!-- Usuarios -->
            <div id="usuarios-container">
                <h4>Usuarios Involucrados</h4>
                <div class="mb-3 usuario-row">
                    <label for="usuario_1" class="form-label">Usuario</label>
                    <select class="form-control" id="usuario_1" name="usuarios[0][ID_USUARIO_USU]" required>
                        <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['ID_USUARIO'] ?>"><?= $usuario['NOMBRE_USUARIO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <hr class="my-4" />

            <!-- Botones de acción -->
            <button type="button" class="btn btn-secondary" id="add-lote">Agregar Lote</button>
            <button type="button" class="btn btn-secondary" id="add-equipo">Agregar Equipo</button>
            <button type="button" class="btn btn-secondary" id="add-usuario">Agregar Usuario</button>
            <button type="submit" class="btn btn-primary">Crear Prestación</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" id="cancelar-btn">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let loteIndex = 1;
        let equipoIndex = 1;
        let usuarioIndex = 1;

        // Agregar nuevo lote
        document.getElementById('add-lote').addEventListener('click', function () {

            let newRow = document.createElement('div');
            newRow.classList.add('mb-3', 'lote-row');
            newRow.innerHTML = `
                <label for="lote_${loteIndex}" class="form-label">Lote</label>
                <select class="form-control" id="lote_${loteIndex}" name="lotes[${loteIndex}][ID_LOTE_LT]" required>
                    <?php foreach ($lotes as $lote): ?>
                        <option value="<?= $lote['ID_LOTE'] ?>"><?= $lote['ID_LOTE'] ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="cantidad_${loteIndex}" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad_${loteIndex}" name="lotes[${loteIndex}][CANTIDAD_UTILIZADA]" required min="1">
            `;
            document.getElementById('lotes-container').appendChild(newRow);
            loteIndex++;
        });

        // Agregar nuevo equipo
        document.getElementById('add-equipo').addEventListener('click', function () {

            let newRow = document.createElement('div');
            newRow.classList.add('mb-3', 'equipo-row');
            newRow.innerHTML = `
                <label for="equipo_${equipoIndex}" class="form-label">Equipo</label>
                <select class="form-control" id="equipo_${equipoIndex}" name="equipos[${equipoIndex}][ID_EQUIPO_MEDICO_PRE]" required>
                    <?php foreach ($equipos as $equipo): ?>
                        <option value="<?= $equipo['ID_EQUIPO_MEDICO'] ?>"><?= $equipo['NOMBRE_EQUIPO'] ?></option>
                    <?php endforeach; ?>
                </select>
            `;
            document.getElementById('equipos-container').appendChild(newRow);
            equipoIndex++;
        });

        // Agregar nuevo usuario
        document.getElementById('add-usuario').addEventListener('click', function () {

            let newRow = document.createElement('div');
            newRow.classList.add('mb-3', 'usuario-row');
            newRow.innerHTML = `
                <label for="usuario_${usuarioIndex}" class="form-label">Usuario</label>
                <select class="form-control" id="usuario_${usuarioIndex}" name="usuarios[${usuarioIndex}][ID_USUARIO_USU]" required>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['ID_USUARIO'] ?>"><?= $usuario['NOMBRE_USUARIO'] ?></option>
                    <?php endforeach; ?>
                </select>
            `;
            document.getElementById('usuarios-container').appendChild(newRow);
            usuarioIndex++;
        });

        // Confirmación antes de cancelar
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
                    window.location.href = "<?= base_url('prestaciones') ?>"; // Redirige a la lista de prestaciones
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            let selectPaciente = document.getElementById('ID_PACIENTE_PRES');
            let nombrePaciente = document.getElementById('nombre_paciente');

            selectPaciente.addEventListener('change', function () {
                let selectedOption = this.options[this.selectedIndex];
                let nombre = selectedOption.getAttribute('data-nombre') || '';
                let apaterno = selectedOption.getAttribute('data-apaterno') || '';
                nombrePaciente.textContent = nombre ? "Nombre: " + nombre + " " + apaterno : "";
            });
        });
    </script>
</body>
</html>

<?= $this->endSection() ?>
