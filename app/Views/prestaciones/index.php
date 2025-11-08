<!-- app/Views/prestaciones/index.php -->

<!-- Visualización de Prestaciones Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #9AB5D9;">

<!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <div class="container mt-5">
        <h1 class="mb-4">Prestación</h1>

        <!-- Barra de búsqueda y botón para crear nueva prestación -->
        <div class="mb-4 d-flex justify-content-between">
            <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Prestación...">
            <a href="<?= base_url('prestaciones/create') ?>" class="btn btn-success"><i class="bi bi-plus-circle"></i> Crear Prestación</a>
        </div>

        <!-- Tabla para visualizar las prestaciones -->
        <table class="table table-bordered table-light" id="tablaPrestacion">
            <thead class="table-secondary">
                <tr>
                    <th>Fecha de Prestación</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Termino</th>
                    <th>Horas Trabajadas</th>
                    <th>Procedimiento</th>
                    <th>Condición del Paciente</th>
                    <th>Paciente</th>
                    <th>Sala</th>
                    <th>Lotes</th>
                    <th>Equipos</th>
                    <th>Usuarios</th>
                    <th>Costo de Usuarios</th>
                    <th>Costo Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($prestaciones)): ?>
                    <?php foreach ($prestaciones as $prestacion): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($prestacion['FECHA_PRESTACION'])) ?></td>
                            <td><?= $prestacion['HORA_INICIO'] ?></td>
                            <td><?= $prestacion['HORA_FIN'] ?></td>
                            <td><?= $prestacion['HORAS_TRABAJADAS'] ?> hrs</td>
                            <td><?= $prestacion['PROCEDIMIENTO_NOMBRE'] ?></td>
                            <td><?= $prestacion['CONDICION_PACIENTE_NOMBRE'] ?></td>
                            <td><?= $prestacion['PACIENTE_NOMBRE'] ?></td>
                            <td><?= $prestacion['SALA_NOMBRE'] ?></td>
                            <td>
                                <?php if (!empty($prestacion['PRESTACIONES_LOTES'])): ?>
                                    <ul>
                                        <?php foreach ($prestacion['PRESTACIONES_LOTES'] as $prestacionlote): ?>
                                            <li>
                                                <?= $prestacionlote['CANTIDAD_UTILIZADA'] ?> x <?= $prestacionlote['ID_LOTE_LT'] ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <span>No hay lotes</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($prestacion['PRESTACIONES_EQUIPOS'])): ?>
                                    <ul>
                                        <?php foreach ($prestacion['PRESTACIONES_EQUIPOS'] as $prestacionequipo): ?>
                                            <li>
                                                <?= $prestacionequipo['NOMBRE_EQUIPO'] ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <span>No hay equipos</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($prestacion['PRESTACIONES_USUARIOS'])): ?>
                                    <ul>
                                        <?php foreach ($prestacion['PRESTACIONES_USUARIOS'] as $prestacionusuario): ?>
                                            <li>
                                                <?= $prestacionusuario['NOMBRE_USUARIO'] ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <span>No hay usuarios</span>
                                <?php endif; ?>
                            </td>
                            <td><?= number_format($prestacion['COSTO_USUARIO']) ?> CLP</td>
                            <td><?= number_format($prestacion['COSTO_TOTAL_PRESTACION']) ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('prestaciones/edit/'.$prestacion['ID_PRESTACION']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>   <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $prestacion['ID_PRESTACION'] ?>">
                                    <i class="bi bi-x-circle"></i>   <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14" class="text-center">No se encontraron prestaciones</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Script para filtrar prestaciones en la tabla -->
    <script>
        document.getElementById("buscador").addEventListener("keyup", function() {
            var filtro = this.value.toUpperCase();
            var filas = document.querySelectorAll("#tablaPrestacion tbody tr");

            filas.forEach(function(fila) {
                var textoFila = fila.innerText.toUpperCase();
                if (textoFila.includes(filtro)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta prestacion? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar la eliminación de prestaciones -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            var confirmDeleteButton = document.getElementById('confirmDeleteButton');

            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;  // Botón que activó el modal
                var prestacionId = button.getAttribute('data-id');  // Obtener el ID de la prestacion
                confirmDeleteButton.href = "<?= base_url('prestaciones/delete/') ?>" + prestacionId;  // Actualizar el enlace de eliminación
            });
        });
    </script>
</body>
</html>

<?= $this->endSection() ?>