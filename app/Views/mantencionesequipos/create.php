<!-- app/Views/mantencionesequipos/create.php -->

<!-- Vista para la creación de una nueva Mantención de Equipo -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Mantención de Equipo</title>
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
        .div6 {
            grid-column-start: 1;
            grid-row-start: 3;
        }
        .div8 {
            grid-column: span 2 / span 2;
            grid-column-start: 2;
            grid-row-start: 3;
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color: #9AB5D9;">
    <div class="container mt-5">
        <h1>Crear Mantención de Equipo</h1>

        <!-- Formulario para crear una nueva mantención de equipo -->
        <form action="<?= base_url('mantencionesequipos/store') ?>" method="POST">
            <div class="parent">
                <!-- Campo para el número del equipo médico -->
                <div class="div1">
                    <label for="ID_EQUIPO_MEDICO_ME" class="form-label">Equipo Médico</label>
                    <select class="form-control" id="ID_EQUIPO_MEDICO_ME" name="ID_EQUIPO_MEDICO_ME" required>
                        <?php foreach ($equiposmedicos as $equipomedico): ?>
                            <option value="<?= $equipomedico['ID_EQUIPO_MEDICO'] ?>"><?= $equipomedico['NOMBRE_EQUIPO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para el número del tipo de mantención del equipo médico -->
                <div class="div2">
                    <label for="ID_TIPO_MANTENCION_ME" class="form-label">Tipo de Mantención</label>
                    <select class="form-control" id="ID_TIPO_MANTENCION_ME" name="ID_TIPO_MANTENCION_ME" required>
                        <?php foreach ($tiposmantenciones as $tipomantencion): ?>
                            <option value="<?= $tipomantencion['ID_TIPO_MANTENCION'] ?>"><?= $tipomantencion['NOMBRE_TIPO_MANTENCION'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Campo para la fecha de matención del equipo médico -->
                <div class="div3">
                    <label for="FECHA_MANTENCION" class="form-label">Fecha de Mantención</label>
                    <input type="date" class="form-control" id="FECHA_MANTENCION" name="FECHA_MANTENCION" required>
                </div>

                <!-- Campo para la periocidad del equipo médico -->
                <div class="div4">
                    <label for="PERIOCIDAD_MANTENCION" class="form-label">Periocidad</label>
                    <input type="number" class="form-control" id="PERIOCIDAD_MANTENCION" name="PERIOCIDAD_MANTENCION" required>
                </div>

                <!-- Campo para la próxima mantención del equipo médico -->
                <div class="div5">
                    <label for="PROXIMA_MANTENCION" class="form-label">Próxima Mantención</label>
                    <input type="date" class="form-control" id="PROXIMA_MANTENCION" name="PROXIMA_MANTENCION">
                </div>

                <!-- Campo para el responsable de la mantención del equipo médico -->
                <div class="div6">
                    <label for="RESPONSABLE_MANTENCION" class="form-label">Responsable</label>
                    <input type="text" class="form-control" id="RESPONSABLE_MANTENCION" name="RESPONSABLE_MANTENCION" required>
                </div>

                <!-- Campo para el costo de mantención del equipo médico -->
                <div class="div7">
                    <label for="COSTO_MANTENCION" class="form-label">Costo de Mantención</label>
                    <input type="number" class="form-control" id="COSTO_MANTENCION" name="COSTO_MANTENCION" required>
                </div>

                <!-- Campo para la descripción de la mantención del equipo médico -->
                <div class="div8">
                    <label for="DESCRIPCION_MANTENCION" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="DESCRIPCION_MANTENCION" name="DESCRIPCION_MANTENCION" required>
                </div>
            </div>

            <!-- Botones de acción -->
            <button type="submit" class="btn btn-primary">Crear Mantención de Equipo</button>
            <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
            <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancelar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
