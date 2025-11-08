<!-- app/Views/disponibilidades/index.php -->

<!-- Visualización de Disponibilidades Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón de regreso -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="text-center mb-4 text-dark">Listado de Disponibilidades</h1>

    <!-- Barra de búsqueda y botón para crear nueva disponibilidad -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Disponibilidad...">
        <a href="<?= base_url('disponibilidades/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Disponibilidad
        </a>
    </div>

    <!-- Tabla para visualizar las disponibilidades -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaDisponibilidades">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($disponibilidades)): ?>
                    <?php foreach ($disponibilidades as $disponibilidad): ?>
                        <tr>
                            <td><?= esc($disponibilidad['ID_DISPONIBILIDAD']) ?></td>
                            <td><?= esc($disponibilidad['NOMBRE_DISPONIBILIDAD']) ?></td>
                            <td><?= esc($disponibilidad['ESTADO_DISPONIBILIDAD']) ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('disponibilidades/edit/'.$disponibilidad['ID_DISPONIBILIDAD']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $disponibilidad['ID_DISPONIBILIDAD'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron disponibilidades</td>
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
                ¿Estás seguro de que deseas eliminar esta disponibilidad? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmDeleteButton" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>

    // Filtrar Disponibilidades en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        let filtro = this.value.toUpperCase();
        let filas = document.querySelectorAll("#tablaDisponibilidades tbody tr");

        filas.forEach(fila => {
            fila.style.display = fila.innerText.toUpperCase().includes(filtro) ? "" : "none";
        });
    });

    // Manejo de la eliminación de Disponibilidad
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var disponibilidadId = button.getAttribute('data-id');
            confirmDeleteButton.href = "<?= base_url('disponibilidades/delete/') ?>" + disponibilidadId;
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