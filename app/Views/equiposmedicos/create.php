<!-- app/Views/equiposmedicos/create.php -->

<!-- Vista para la creación de un nuevo Equipo Médico -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Equipo Médico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Diseño de la cuadrícula para organizar los campos del formulario */
        .parent {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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
            grid-column-start: 1;
            grid-row-start: 2;
        }
        .div5 {
            grid-column-start: 2;
        }
        .div6 {
            grid-column-start: 3;
        }
        .div7 {
            grid-column-start: 1;
            grid-row-start: 3;
        }
        .div8 {
            grid-column: span 2 / span 2;
            grid-column-start: 2;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Equipo Médico</h1>

        <!-- Formulario para crear un nuevo equipo medico -->
        <form action="<?= base_url('equiposmedicos/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el numero de serie del equipo -->
                <div class="div1">
                    <label for="NUM_SERIE_EQUIPO" class="form-label">Número de Serie</label>
                    <input type="text" class="form-control" id="NUM_SERIE_EQUIPO" name="NUM_SERIE_EQUIPO" required>
                </div>

                <!-- Campo para el nombre del equipo -->
                <div class="div2">
                    <label for="NOMBRE_EQUIPO" class="form-label">Nombre del Equipo</label>
                    <input type="text" class="form-control" id="NOMBRE_EQUIPO" name="NOMBRE_EQUIPO" required>
                </div>

                <!-- Campo para la marca del equipo -->
                <div class="div3">
                    <label for="MARCA_EQUIPO" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="MARCA_EQUIPO" name="MARCA_EQUIPO" required>
                </div>

                <!-- Campo para el valor por hora del equipo -->
                <div class="div4">
                    <label for="VALOR_HORA" class="form-label">Valor por Hora</label>
                    <input type="number" class="form-control" id="VALOR_HORA" name="VALOR_HORA">
                </div>

                <!-- Campo para la vida útil del equipo -->
                <div class="div5">
                    <label for="VIDA_UTIL_EQUIPO" class="form-label">Vida Útil (Años)</label>
                    <input type="number" class="form-control" id="VIDA_UTIL_EQUIPO" name="VIDA_UTIL_EQUIPO" required>
                </div>

                <!-- Campo para la fecha de adquisición del equipo -->
                <div class="div6">
                    <label for="FECHA_ADQUISICION_EQUIPO" class="form-label">Fecha de Adquisición</label>
                    <input type="date" class="form-control" id="FECHA_ADQUISICION_EQUIPO" name="FECHA_ADQUISICION_EQUIPO" required>
                </div>

                <!-- Campo para el estado del equipo -->
                <div class="div7">
                    <label for="ESTADO_EQUIPO" class="form-label">Estado del Equipo Médico</label>
                    <select class="form-control" id="ESTADO_EQUIPO" name="ESTADO_EQUIPO" required>
                        <option value="1">Activa</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <!-- Campo para la observación del equipo -->
                <div class="div8">
                    <label for="OBSERVACION_EQUIPO" class="form-label">Observaciones</label>
                    <input type="text" class="form-control" id="OBSERVACION_EQUIPO" name="OBSERVACION_EQUIPO">
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Equipo Médico</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
