<!-- app/Views/condicionespacientes/index.php -->

<!-- Visualización de la Condición de Paciente Existente -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condición de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body style="background-color: #9AB5D9;">

<!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <div class="container mt-5">
        <h1 class="mb-4">Listado de Condición de Paciente</h1>

        <!-- Barra de búsqueda y botón para crear nueva condicion del paciente -->
        <div class="mb-4 d-flex justify-content-between">
            <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Condición de Paciente...">
            <a href="<?= base_url('condicionespacientes/create') ?>" class="btn btn-success"><i class="bi bi-plus-circle"></i> Crear Condición de Paciente</a>
        </div>

        <!-- Tabla para visualizar las condiciones del paciente -->
        <table class="table table-bordered table-light" id="tablaCondicionPaciente">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Nombre de la Condición de Paciente</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($condicionespacientes)): ?>
                    <?php foreach ($condicionespacientes as $condicionpaciente): ?>
                        <tr>
                            <td><?= $condicionpaciente['ID_CONDICION_PACIENTE'] ?></td>
                            <td><?= $condicionpaciente['NOMBRE_CONDICION_PACIENTE'] ?></td>
                            <td><?= $condicionpaciente['ESTADO_CONDICION_PACIENTE'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('condicionespacientes/edit/'.$condicionpaciente['ID_CONDICION_PACIENTE']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>   <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $condicionpaciente['ID_CONDICION_PACIENTE'] ?>">
                                    <i class="bi bi-x-circle"></i>   <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron condiciones de pacientes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Script para filtrar condiciones de pacientes en la tabla -->
    <script>
        document.getElementById("buscador").addEventListener("keyup", function() {
            var filtro = this.value.toUpperCase();
            var filas = document.querySelectorAll("#tablaCondicionPaciente tbody tr");

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
                    ¿Estás seguro de que deseas eliminar esta condición de paciente? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para manejar la eliminación de condiciones -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            var confirmDeleteButton = document.getElementById('confirmDeleteButton');

            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;  // Botón que activó el modal
                var condicionpacienteId = button.getAttribute('data-id');  // Obtener el ID de la condicion de paciente
                confirmDeleteButton.href = "<?= base_url('condicionespacientes/delete/') ?>" + condicionpacienteId;  // Actualizar el enlace de eliminación
            });
        });
    </script>
</body>
</html>

<?= $this->endSection() ?>
