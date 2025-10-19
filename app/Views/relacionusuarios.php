<!-- app/Views/relacionusuarios.php -->

<!-- Visualizar lo Relacionado con Usuarios -->

<?= $this->extend('/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <!-- Botón para regresar a la vista anterior -->
    <a href="<?= base_url('catalogosistema') ?>" class="btn btn-light">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </a>

    <h1 class="text-center mb-4 text-dark">Relacionado con Usuarios</h1>
    <div class="row justify-content-center">

        <?php
            $relacionados = [
                ["Perfiles", "perfiles"],
                ["Estamentos", "estamentos"],
                ["Usuarios", "usuarios"]
            ];
        ?>

        <?php foreach ($relacionados as $item): ?>
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
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-primary, .btn-outline-secondary {
        border-radius: 8px;
    }
</style>

<?= $this->endSection() ?>
