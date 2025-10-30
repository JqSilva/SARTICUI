<h1 class="tw-text-2xl tw-font-bold tw-text-blue-700">Panel del Administrador</h1>
<p>Bienvenido, <?= esc(session('nombre')) ?>.</p>
<a href="<?= base_url('logout') ?>" class="tw-text-red-500">Cerrar sesión</a>