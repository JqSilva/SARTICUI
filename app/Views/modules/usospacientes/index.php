<!-- app/Views/usospacientes/index.php -->

<!-- Visualización de Usos en Pacientes Existentes -->

<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <button class="btn btn-light bi bi-arrow-left-circle" onclick="window.history.back();"> Volver</button>

    <h1 class="text-center mb-4 text-dark">Listado de Consumo</h1>

    <!-- Barra de búsqueda y botón para crear nuevo uso de paciente -->
    <div class="mb-4 d-flex justify-content-between">
        <input type="text" id="buscador" class="form-control w-50" placeholder="Buscar Consumo...">
        <a href="<?= base_url('usospacientes/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Crear Consumo
        </a>
    </div>

    <!-- Tabla para visualizar los usos de pacientes -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaUsoPaciente">
            <thead class="table-dark text-light">
                <tr>
                    <th>Sala</th>
                    <th>Insumo</th>
                    <th>Cantidad Utilizada</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                    <th>Fecha de Uso</th>
                    <th>Paciente</th>
                    <th>Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <!-- Calculo de los Costos Totales en Pantalla -->
                <?php
                    $totalCosto = 0; // Variable para calcular el total
                    if (!empty($usospacientes)):
                        foreach ($usospacientes as $usopaciente):
                            $costoTotal = $usopaciente['COSTO_UNITARIO'] * $usopaciente['CANTIDAD_UTILIZADA_USO']; // Costo por insumo
                            $totalCosto += $costoTotal; // Sumar al total general
                ?>
                            <tr>
                                <td><?= $usopaciente['SALA_NOMBRE'] ?></td>
                                <td><?= $usopaciente['NOMBRE_INSUMO'] ?></td>
                                <td class="cantidad-utilizada"><?= $usopaciente['CANTIDAD_UTILIZADA_USO'] ?></td>
                                <td class="costo-unitario" data-costo="<?= $usopaciente['COSTO_UNITARIO'] ?>">
                                    $<?= number_format($usopaciente['COSTO_UNITARIO']) ?>
                                </td>
                                <td class="costo-total" data-total="<?= $costoTotal ?>">
                                    $<?= number_format($costoTotal) ?>
                                <td><?= date('d/m/Y', strtotime($usopaciente['FECHA_USO'])) ?></td>
                                <td><?= $usopaciente['PACIENTE_NOMBRE'] ?></td>
                                <td><?= $usopaciente['TIPO_REGISTRO_NOMBRE'] ?></td>
                                <td>
                                    <!-- Botón de edición -->
                                    <a href="<?= base_url('usospacientes/edit/'.$usopaciente['ID_USO_PACIENTE']) ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Editar  <!-- Ícono de editar -->
                                    </a>
                                    <!-- Botón para abrir el modal de eliminación -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?= $usopaciente['ID_USO_PACIENTE'] ?>">
                                        <i class="bi bi-x-circle"></i> Eliminar  <!-- Ícono de borrar -->
                                    </button>
                                </td>
                            </tr>
                    <?php
                            endforeach;
                        else:
                    ?>
                        <tr>
                            <td colspan="10" class="text-center">No se encontraron consumos</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        <!-- Sección para mostrar el total -->
        <div class="text-end mt-3">
            <h4>Total Costo General: <span id="totalCosto">$<?= number_format($totalCosto) ?></span></h4>
        </div>
    </div>

    <!-- Aviso de Cantidad Superada de Sala -->
    <?php if (session()->getFlashdata('error')): ?>
        <div id="error-message" class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-message').style.display = 'none';
            }, 3000);
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('message')): ?>
        <div id="success-message" class="alert alert-success">
            <?= session()->getFlashdata('message') ?>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
            }, 3000);
        </script>
    <?php endif; ?>
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
                ¿Estás seguro de que deseas eliminar este movimiento? Esta acción no se puede deshacer.
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

    // Filtrar Usos de Pacientes en la Tabla
    document.getElementById("buscador").addEventListener("keyup", function() {
        var filtro = this.value.toUpperCase();
        var filas = document.querySelectorAll("#tablaUsoPaciente tbody tr");
        var total = 0; // Reiniciar total

        filas.forEach(function(fila) {
            var textoFila = fila.innerText.toUpperCase();
            var costoTotal = parseFloat(fila.querySelector(".costo-total").getAttribute("data-total"));

            if (textoFila.includes(filtro)) {
                fila.style.display = "";
                total += costoTotal;
            } else {
                fila.style.display = "none";
            }
        });

        // Actualizar el total mostrado
        document.getElementById("totalCosto").textContent = "$" + total.toFixed(2);
    });

    // Manejo de la eliminación de Usos de Pacientes
    document.addEventListener("DOMContentLoaded", function() {
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        var confirmDeleteButton = document.getElementById('confirmDeleteButton');

        confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;  // Botón que activó el modal
            var usopacienteId = button.getAttribute('data-id');  // Obtener el ID del movimiento
            confirmDeleteButton.href = "<?= base_url('usospacientes/delete/') ?>" + usopacienteId;  // Actualizar el enlace de eliminación
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
