<!-- app/Views/bodega.php -->

<!-- Visualizar el Inventario de Bodega -->

<?= $this->extend($layout) ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="text-center mb-4 text-dark">Inventario de Bodega</h1>

    <!-- Barra de búsqueda -->
    <div class="input-group mb-4">
        <input type="text" id="buscador" class="form-control" placeholder="Buscar en el inventario...">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
    </div>

    <!-- Tabla para visualizar el Inventario -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaInventario">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID Lote</th>
                    <th>Código Producto</th>
                    <th>Nombre Insumo</th>
                    <th>Marca</th>
                    <th>Cantidad Total</th>
                    <th>Insumos Retirados</th>
                    <th>Cantidad en Bodega</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php foreach ($insumos as $insumo) : ?>
                    <tr>
                        <td><?= esc($insumo['ID_LOTE']) ?></td>
                        <td><?= esc($insumo['CODIGO_PRODUCTO_LOTE']) ?></td>
                        <td><?= esc($insumo['NOMBRE_INSUMO']) ?></td>
                        <td><?= esc($insumo['MARCA_LOTE']) ?></td>
                        <td><?= esc($insumo['CANTIDAD_TOTAL_LOTE']) ?></td>
                        <td><?= esc($insumo['INSUMOS_RETIRADOS']) ?></td>
                        <td><?= esc($insumo['CANTIDAD_DISPONIBLE']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script para búsqueda en la tabla -->
<script>
    document.getElementById("buscador").addEventListener("keyup", function() {
        let filtro = this.value.toUpperCase();
        let filas = document.querySelectorAll("#tablaInventario tbody tr");

        filas.forEach(fila => {
            fila.style.display = fila.innerText.toUpperCase().includes(filtro) ? "" : "none";
        });
    });

    function confirmarEliminacion(id) {
        if (confirm("¿Seguro que deseas eliminar este lote? Esta acción no se puede deshacer.")) {
            window.location.href = "<?= base_url('bodega/eliminar/') ?>" + id;
        }
    }
</script>

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
</style>

<?= $this->endSection() ?>
