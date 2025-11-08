<!-- app/Views/estamentos/index.php -->

<!-- Visualización de Estamentos Existentes -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="mb-4">Listado de Estamentos</h1>

    <!-- Barra de búsqueda y botón para crear nuevo estamento -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Estamentos...">
        <a href="<?= base_url('estamentos/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Estamento
        </a>
    </div>

    <!-- Tabla para visualizar los estamentos -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaEstamentos">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Sueldo por Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php if (!empty($estamentos)): ?>
                    <?php foreach ($estamentos as $estamento): ?>
                        <tr>
                            <td><?= $estamento['ID_ESTAMENTO'] ?></td>
                            <td><?= $estamento['NOMBRE_ESTAMENTO'] ?></td>
                            <td><?= number_format($estamento['SUELDO_HORA_ESTAMENTO']) ?> CLP</td>
                            <td><?= $estamento['ESTADO_ESTAMENTO'] ?></td>
                            <td>
                                <!-- Botón de edición -->
                                <a href="<?= base_url('estamentos/edit/'.$estamento['ID_ESTAMENTO']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                </a>
                                <!-- Botón para abrir el modal de eliminación -->
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $estamento['ID_ESTAMENTO'] ?>">
                                    <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron estamentos</td>
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
                ¿Estás seguro de que deseas eliminar esta estamento? Esta acción no se puede deshacer.
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

    // Filtrar Estamentos en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        var filtro = this.value.toUpperCase();
        var filas = document.querySelectorAll("#tablaEstamentos tbody tr");

        filas.forEach(function(fila) {
            var textoFila = fila.innerText.toUpperCase();
            if (textoFila.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });

    // Manejo de la eliminación de Estamento
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var estamentoId = button.getAttribute('data-id');  // Obtener el ID del estamento
            confirmDeleteButton.href = "<?= base_url('estamentos/delete/') ?>" + estamentoId;  // Actualizar el enlace de eliminación
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
