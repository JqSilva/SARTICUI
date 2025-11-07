<?= $this->extend($layout) ?>
<?= $this->section('content') ?>

<div class="tw-bg-[#f9fafb] tw-min-h-screen tw-p-8">
  <div class="tw-bg-white tw-rounded-2xl tw-shadow tw-p-6">
    <h1 class="tw-text-2xl tw-font-semibold tw-text-gray-800 tw-mb-2">
      <?= esc($titulo) ?>
    </h1>
    <p class="tw-text-gray-500 tw-mb-6"><?= esc($descripcion) ?></p>

    <?php if (empty($acciones)): ?>
      <p class="tw-text-gray-500 tw-italic">No hay acciones registradas aún.</p>
    <?php else: ?>
      <div class="tw-overflow-x-auto">
        <table class="tw-w-full tw-text-sm tw-border-collapse">
          <thead class="tw-bg-gray-100 tw-text-gray-700">
            <tr>
              <th class="tw-px-3 tw-py-2 tw-text-left">Fecha</th>
              <th class="tw-px-3 tw-py-2 tw-text-left">Usuario</th>
              <th class="tw-px-3 tw-py-2 tw-text-left">Insumo</th>
              <th class="tw-px-3 tw-py-2 tw-text-left">Cantidad</th>
              <th class="tw-px-3 tw-py-2 tw-text-left">Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($acciones as $a): ?>
              <tr class="tw-border-b hover:tw-bg-gray-50">
                <td class="tw-px-3 tw-py-2"><?= esc($a['FECHA_ACCION']) ?></td>
                <td class="tw-px-3 tw-py-2"><?= esc($a['NOMBRE_USUARIO']) ?></td>
                <td class="tw-px-3 tw-py-2"><?= esc($a['NOMBRE_INSUMO']) ?></td>
                <td class="tw-px-3 tw-py-2"><?= esc($a['CANTIDAD']) ?></td>
                <td class="tw-px-3 tw-py-2 tw-font-semibold 
                  <?= match ($a['ACCION']) {
                      'Ingreso' => 'tw-text-green-600',
                      'Retiro' => 'tw-text-orange-600',
                      'Uso' => 'tw-text-blue-600',
                      'Devolución' => 'tw-text-purple-600',
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

<?= $this->endSection() ?>
