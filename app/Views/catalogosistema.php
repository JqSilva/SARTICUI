<!-- app/Views/catalogosistema.php -->

<!-- Visualizar el Catálogo del Sistema -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-dark">Catálogo del Sistema</h1>
    <div class="row justify-content-center">

        <?php
            $catalogos = [
                ["Relacionado a Insumos", "relacioninsumos"],
                ["Inventario", "bodega"],
                ["Proveedores", "proveedores"],
                ["Licitaciones", "licitaciones"],
                ["Relacionado a Lotes", "relacionlotes"],
                ["Relacionado con Usuarios", "relacionusuarios"],
                ["Relacionado con SubUnidades", "relacionsubunidades"],
                ["Relacionado con Solicitudes", "relacionsolicitudes"],
                ["Pacientes", "pacientes"],
                ["Tipo de Registro", "tiposregistros"]
            ];
        ?>

        <?php foreach ($catalogos as $item): ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card text-center shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item[0] ?></h5>
                        <a href="<?= base_url($item[1]) ?>" class="btn btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<style>
    body {
        background-color: #9AB5D9;
    }

    .card {
        border-radius: 12px;
        background-color: white;
        transition: transform 0.2s, box-shadow 0.2s;
        min-height: 120px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary {
        border-radius: 8px;
    }
</style>

<?= $this->endSection() ?>
