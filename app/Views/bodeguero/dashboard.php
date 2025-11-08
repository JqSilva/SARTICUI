<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<style>
  /* ==== Tarjetas ==== */
  .custom-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 10px;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
  }

  .custom-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
    background-color: #e0e7ff;
  }

  .custom-card i {
    color: #1e40af;
    font-size: 1.9rem;
    transition: color 0.2s ease;
  }

  .custom-card:hover i {
    color: #1c3faa;
  }

  .card-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .card-title {
    font-size: 0.95rem;
    margin-top: 6px;
    color: #1e293b;
    font-weight: 500;
  }

  /* ==== Secciones ==== */
  .section-title {
    text-align: center;
    width: fit-content;
    margin: 1.5rem auto 1rem;
    border-bottom: 2px solid rgba(0,0,0,0.15);
    padding-bottom: 4px;
    font-weight: 600;
    color: #1e293b;
    font-size: 1rem;
  }

  /* ==== Fondo y estructura ==== */
  body {
    background-color: #9ab5d9;
  }
</style>

<body class="tw-min-h-screen tw-py-8">

  <div class="container tw-max-w-5xl tw-px-4">

    <!-- Encabezado -->
    <div class="tw-text-center tw-mb-10">
      <h1 class="tw-text-4xl md:tw-text-5xl tw-font-extrabold tw-text-[#0f172a]">Panel de Bodeguero</h1>
      <p class="tw-text-xl tw-font-medium tw-text-[#334155]">
        Bienvenido, 
        <span class="tw-font-semibold tw-text-[#1d4ed8]">
          <?= ucfirst(strtolower(esc(session('nombre')))) ?>.
        </span>
      </p>
      <div class="tw-w-32 tw-h-[4px] tw-bg-[#1d4ed8] tw-rounded-full tw-mx-auto tw-mt-4"></div>
    </div>

    <!-- === Gestión de Insumos === -->
    <div class="section-title">🧰 Gestión de Insumos</div>
    <div class="row justify-content-center text-center g-4 mb-4">
      <?php
      $gestionCards = [
        ['title' => 'Catálogo de Insumos', 'icon' => 'bi-bandaid', 'link' => 'insumos'],
        ['title' => 'Ingresar Clasificación', 'icon' => 'bi-box-seam', 'link' => 'clasificaciones'],
        ['title' => 'Catálogo del Sistema', 'icon' => 'bi-file-medical', 'link' => 'catalogosistema']
      ];
      foreach ($gestionCards as $card): ?>
        <div class="col-6 col-md-4 col-lg-3 mb-3">
          <a href="<?= base_url($card['link']) ?>" class="text-decoration-none">
            <div class="card text-center shadow custom-card">
              <div class="card-body">
                <i class="bi <?= $card['icon'] ?>"></i>
                <h5 class="card-title"><?= $card['title'] ?></h5>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- === Operaciones Diarias === -->
    <div class="section-title">🚚 Operaciones Diarias</div>
    <div class="row justify-content-center text-center g-4 mb-4">
      <?php
      $opCards = [
        ['title' => 'Ingresar Insumos', 'icon' => 'bi-ui-checks-grid', 'link' => 'lotes'],
        ['title' => 'Despacho a Sala', 'icon' => 'bi-arrow-left-right', 'link' => 'insumossalas'],
        ['title' => 'Solicitud Interna', 'icon' => 'bi-basket', 'link' => 'solicitudes']
      ];
      foreach ($opCards as $card): ?>
        <div class="col-6 col-md-4 col-lg-3 mb-3">
          <a href="<?= base_url($card['link']) ?>" class="text-decoration-none">
            <div class="card text-center shadow custom-card">
              <div class="card-body">
                <i class="bi <?= $card['icon'] ?>"></i>
                <h5 class="card-title"><?= $card['title'] ?></h5>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- === Supervisión === -->
    <div class="section-title">📦 Supervisión</div>
    <div class="row justify-content-center text-center g-4">
      <div class="col-6 col-md-4 col-lg-3 mb-3">
        <a href="<?= base_url('bodega') ?>" class="text-decoration-none">
          <div class="card text-center shadow custom-card">
            <div class="card-body">
              <i class="bi bi-card-checklist"></i>
              <h5 class="card-title">Inventario</h5>
            </div>
          </div>
        </a>
      </div>
    </div>

  </div>
</body>

<?= $this->endSection() ?>
