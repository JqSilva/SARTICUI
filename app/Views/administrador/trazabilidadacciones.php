<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<div class="tw-container tw-mx-auto tw-mt-10 tw-px-6">

  <!-- Botón para regresar a la vista anterior -->
    <button type="button" class="btn btn-light" onclick="window.history.back()">
        <i class="bi bi-arrow-left-circle"></i> Volver
    </button>

  <!-- Título principal -->
  <h1 class="tw-text-center tw-text-3xl tw-font-bold tw-text-gray-800 tw-my-6">
    <?= esc($titulo) ?>
  </h1>

  <p class="tw-text-center tw-text-gray-600 tw-mb-8"><?= esc($descripcion) ?></p>

  <!-- Tabla principal -->
  <div class="tw-rounded-xl">
    <?php if (empty($acciones)): ?>
      <p class="tw-text-gray-500 tw-italic tw-text-center">No hay acciones registradas aún.</p>
    <?php else: ?>
      <div class="tw-overflow-x-auto">
        <table class="tw-w-full tw-border tw-border-gray-200 tw-rounded-lg tw-text-center tw-text-sm tw-bg-white">
          <thead class="tw-bg-gray-800 tw-text-white">
            <tr>
              <th class="tw-px-3 tw-py-3">Fecha</th>
              <th class="tw-px-3 tw-py-3">Usuario</th>
              <th class="tw-px-3 tw-py-3">Insumo</th>
              <th class="tw-px-3 tw-py-3">Cantidad</th>
              <th class="tw-px-3 tw-py-3">Acción</th>
            </tr>
          </thead>
          <tbody class="tw-text-gray-700">
            <?php foreach ($acciones as $a): ?>
              <tr class="hover:tw-bg-gray-100 tw-border-b tw-border-gray-200">
                <td class="tw-px-3 tw-py-2"><?= esc($a['FECHA_ACCION']) ?></td>
                <td class="tw-px-3 tw-py-2"><?= esc($a['NOMBRE_USUARIO']) ?></td>
                <td class="tw-px-3 tw-py-2"><?= esc($a['NOMBRE_INSUMO']) ?></td>
                <td class="tw-px-3 tw-py-2"><?= esc($a['CANTIDAD']) ?></td>
                <td class="tw-px-3 tw-py-2 tw-font-semibold
                  <?= match ($a['ACCION']) {
                      'Ingreso' => 'tw-text-green-600',
                      'Actualización' => 'tw-text-yellow-600',
                      'Eliminación' => 'tw-text-red-600',
                      'Retiro' => 'tw-text-orange-600',
                      'Uso' => 'tw-text-blue-600',
                      default => 'tw-text-gray-600'
                  } ?>">
                  <?= esc($a['ACCION']) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</div>

<style>
  body {
    background-color: #9AB5D9; /* mismo fondo que el resto del sistema */
  }
</style>

<?= $this->endSection() ?>
