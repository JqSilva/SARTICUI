<!-- app/Views/stock.php -->

<!-- Visualizar el Stock Disponible -->

<?= $this->extend($layout) ?>

<?= $this->Section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

    <h1 class="text-center mb-4 text-dark">Stock Disponible</h1>

    <!-- Tabla para visualizar el Stock -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle" id="tablaStock">
            <thead class="table-dark text-light">
                <tr>
                    <th>ID Lote</th>
                    <th>Nombre Insumo</th>
                    <th>Marca</th>
                    <th>Cantidad Disponible</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php foreach ($insumos as $insumo) : ?>
                    <tr>
                        <td><?= esc($insumo['ID_LOTE']) ?></td>
                        <td><?= esc($insumo['NOMBRE_INSUMO']) ?></td>
                        <td><?= esc($insumo['MARCA_LOTE']) ?></td>
                        <td><?= esc($insumo['CANTIDAD_DISPONIBLE']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script para mejorar la visualización y búsqueda en la tabla -->
<script>
    document.getElementById("buscador").addEventListener("keyup", function() {
        let filtro = this.value.toUpperCase();
        let filas = document.querySelectorAll("#tablaStock tbody tr");

        filas.forEach(fila => {
            fila.style.display = fila.innerText.toUpperCase().includes(filtro) ? "" : "none";
        });
    });
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