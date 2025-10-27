<?= $this->extend('layouts/base_login') ?>

<?= $this->section('content') ?>
<div class="tw-bg-white tw-rounded-3xl tw-w-[450px] tw-px-10 tw-pt-6 tw-pb-8 tw-shadow-lg tw-border tw-border-slate-100">
  <div class="tw-flex tw-flex-col tw-items-center">
    <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="tw-w-[200px] tw-mb-2"/>
    <h1 class="tw-text-2xl tw-font-bold tw-text-[#262626]">Bienvenido</h1>
    <p class="tw-text-slate-500 tw-text-sm">Por favor ingresa tus credenciales</p>
  </div>

  <form class="tw-mt-8" method="post" action="<?= site_url('login') ?>">


    <div>
      <label for="rut" class="tw-block tw-text-sm tw-font-semibold tw-text-slate-700 tw-px-4 tw-py-2">RUT</label>
      <input id="rut" name="rut" type="text" placeholder="Ingresa tu RUT"
             class="tw-w-full tw-px-4 tw-py-2.5 tw-mb-4 tw-rounded-xl tw-border tw-border-slate-300 tw-text-slate-800
                    focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-[#0f398b] focus:tw-border-transparent" />
    </div>

    <div>
      <label for="password" class="tw-block tw-text-sm tw-font-semibold tw-text-slate-700 tw-px-4 tw-py-2">Contraseña</label>
      <div class="tw-flex tw-items-center tw-justify-between tw-border tw-border-slate-300 tw-rounded-xl focus-within:tw-ring-2 focus-within:tw-ring-[#0f398b] focus-within:tw-border-transparent">
        <input id="password" name="password" type="password" placeholder="Ingresa tu contraseña"
               class="tw-w-full tw-px-4 tw-py-2.5 tw-rounded-xl tw-text-slate-800 tw-bg-transparent focus:tw-outline-none" />
        <button type="button" id="togglePassword"
                class="tw-px-3 tw-text-gray-500 hover:tw-text-[#0f398b] focus:tw-outline-none tw-flex-shrink-0">
          <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="eye-icon tw-h-5 tw-w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3l18 18M9.88 9.88A3 3 0 0012 15a3 3 0 002.12-.88M15 12a3 3 0 00-3-3m0 0a3 3 0 00-2.12.88M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.275.908-.664 1.77-1.152 2.558M15.536 15.536A8.969 8.969 0 0112 17c-4.478 0-8.268-2.943-9.542-7" />
          </svg>
          <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="eye-icon tw-h-5 tw-w-5 tw-hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
          </svg>
        </button>
      </div>
    </div>

    <a href="#" class="tw-block tw-text-center tw-mt-4 tw-mb-4 tw-text-sm tw-text-[#0f398b] hover:tw-text-[#6D7CFD]">¿Olvidaste tu contraseña?</a>

    <button type="submit" class="tw-w-full tw-py-2.5 tw-mt-6 tw-rounded-lg tw-font-semibold tw-text-white tw-bg-[#0f398b] hover:tw-bg-[#1347ae] tw-transition-colors">
      Ingresar
    </button>
  </form>
  <?php if(session('error')): ?>
    <p class="tw-text-center tw-text-red-600 tw-text-sm tw-mt-5"><?= esc(session('error')) ?></p>
  <?php endif; ?>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  const togglePassword = document.getElementById("togglePassword");
  const passwordInput = document.getElementById("password");
  const eyeOpen = document.getElementById("eyeOpen");
  const eyeClosed = document.getElementById("eyeClosed");
  togglePassword.addEventListener("click", () => {
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    eyeOpen.classList.toggle("tw-hidden");
    eyeClosed.classList.toggle("tw-hidden");
  });
</script>
<?= $this->endSection() ?>
