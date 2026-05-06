 <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
           
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
          
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="<?= base_url('assets/template/dist/')?>assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline"><?= $user ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="<?= base_url('assets/template/dist/')?>assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    <?= $user ?>
                    <small>App Desa <?= $versi ?></small>
                  </p>
                </li>
                <!--end::User Image-->
                <!--begin::Menu Body-->
                
                <!--end::Menu Body-->
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="<?= base_url('user/set_profil') ?>" class="btn btn-outline-secondary">Profile</a>
                  <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="<?= base_url('assets/template/dist/')?>assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light"><?= $nama_desa ?></span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
  <nav class="mt-2">
    <ul
      class="nav sidebar-menu flex-column"
      data-lte-toggle="treeview"
      role="navigation"
      data-accordion="false"
    >

      <?php foreach ($menu as $m): ?>
        
        <?php $hasSub = !empty($m->submenu); ?>

        <li class="nav-item <?= $hasSub ?  : '' ?>">

          <a href="<?= $hasSub ? '#' : base_url($m->name) ?>" class="nav-link">

            <!-- ICON (pakai dari DB, tapi pastikan format bi) -->
            <i class="nav-icon <?= $m->icon ?>"></i>

            <p>
              <?= $m->name ?>

              <?php if ($hasSub): ?>
                <i class="nav-arrow bi bi-chevron-right"></i>
              <?php endif; ?>
            </p>
          </a>

          <?php if ($hasSub): ?>
            <ul class="nav nav-treeview">

              <?php foreach ($m->submenu as $sm): ?>
                <li class="nav-item">
                  <a href="<?= base_url($sm->url) ?>" class="nav-link">

                    <i class="nav-icon <?= $sm->icon ?? 'bi bi-circle' ?>"></i>

                    <p><?= $sm->title ?></p>
                  </a>
                </li>
              <?php endforeach; ?>

            </ul>
          <?php endif; ?>

        </li>

      <?php endforeach; ?>

    </ul>
  </nav>
</div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
