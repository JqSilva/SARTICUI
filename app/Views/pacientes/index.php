<!-- app/Views/pacientes/index.php -->

<!-- Visualización de Pacientes Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="text-center mb-4 text-dark">Listado de Pacientes</h1>

    <!-- Barra de búsqueda y botón para crear nuevo paciente -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Paciente...">
        <a href="<?= base_url('pacientes/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Paciente
        </a>
    </div>

    <!-- Tabla para visualizar los pacientes -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaPaciente">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID</th>
                    <th>RUT</th>
                    <th>Nombres</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($pacientes)): ?>
                    <?php foreach ($pacientes as $paciente): ?>
                        <tr>
                            <td><?= $paciente['ID_PACIENTE'] ?></td>
                            <td><?= $paciente['RUT_PACIENTE'] ?></td>
                            <td><?= $paciente['NOMBRE_PACIENTE'] ?></td>
                            <td><?= $paciente['APATERNO_PACIENTE'] ?></td>
                            <td><?= $paciente['AMATERNO_PACIENTE'] ?></td>
                            <td><?= $paciente['FECHA_NACIMIENTO'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('pacientes/edit/'.$paciente['ID_PACIENTE']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $paciente['ID_PACIENTE'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron pacientes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este paciente? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>

    // Filtrar Pacientes en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        var filtro = this.value.toUpperCase();
        var filas = document.querySelectorAll("#tablaPaciente tbody tr");

        filas.forEach(function(fila) {
            var textoFila = fila.innerText.toUpperCase();
            if (textoFila.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });

    // Manejo de la eliminación de Paciente
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var pacienteId = button.getAttribute('data-id');  // Obtener el ID del paciente
            confirmDeleteButton.href = "<?= base_url('pacientes/delete/') ?>" + pacienteId;  // Actualizar el enlace de eliminación
        });
    });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
        background-color: #9AB5D9;
    }

    .table th {
        background-color: #343a40 !important;
        color: white;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-outline-secondary {
        border-radius: 8px;
    }

    .modal-content {
        border-radius: 8px;
    }
</style>

<?= $this->endSection() ?>
