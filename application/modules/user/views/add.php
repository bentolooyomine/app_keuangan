      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0"><?= $title?></h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                  <li class="breadcrumb-item " aria-current="page"><?= $title?></li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
              <div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Tambah User</h3>
    </div>
     
  <form action="<?= base_url('user/store') ?>" method="post" class="form-add">
        <div class="card-body">
               <?php if (validation_errors()) : ?>
      <div class="alert alert-danger">
          <?= validation_errors() ?>
      </div>
      <?php endif; ?>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>">
            </div>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?= set_value('username') ?>">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= set_value('email') ?>">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp') ?>">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?= set_value('password') ?>">
            </div>

          <div class="mb-3">
    <label>Role</label>
    <select name="role_id" class="form-control" required>

        <!-- default -->
        <option value="">-- pilih role --</option>

        <!-- loop -->
        <?php foreach($roles as $r): ?>
            <option value="<?= $r->id ?>" <?= set_select('role_id', $r->id) ?>>
                <?= $r->nama_role ?>
            </option>
        <?php endforeach; ?>

    </select>
</div>

            <div class="mb-3">
                <label>Status</label>
                <select name="is_active" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="<?= base_url('user') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      


