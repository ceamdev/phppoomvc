<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?php echo APP_URL;?>"><?php echo APP_NAME;?></a>
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link"> Servicios </a>
        <div class="navbar-dropdown">
          <a class="navbar-item"> Remesas </a>
          <a class="navbar-item"> Recargas & Cambios </a>
          <a class="navbar-item"> Streaming & Cuentas Premium </a>
          <hr class="navbar-divider">
          <strong class="subtitle p-1">Servicios sujetos a:</strong>
          <a class="navbar-item">Terminos de uso</a>
          <a class="navbar-item">Politicas de Privacidad</a>
          <a class="navbar-item">KYC & AML</a>
        </div>
      </div>
      <a href="#referencias" class="navbar-item">Referencias</a>
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light">
            Log in
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>