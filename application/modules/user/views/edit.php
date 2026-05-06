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


     <div class="card-body">
            <?php if (validation_errors()) : ?>
      <div class="alert alert-danger">
          <?= validation_errors() ?>
      </div>
      <?php endif; ?>

<form action="<?= base_url('user/update') ?>" method="post" class="form-update">

<input type="hidden" name="id" value="<?= $data_user->id ?>">

<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control"
        value="<?= set_value('nama', $data_user->nama) ?>">
</div>

<div class="mb-3">
    <label>Username</label>
    <input type="text" name="username" class="form-control"
        value="<?= set_value('username', $data_user->username) ?>">
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
        value="<?= set_value('email', $data_user->email) ?>">
</div>

<div class="mb-3">
    <label>Password (kosongkan jika tidak diubah)</label>
    <input type="password" name="password" class="form-control">
</div>

<div class="mb-3">
    <label>No HP</label>
    <input type="text" name="no_hp" class="form-control"
        value="<?= set_value('no_hp', $data_user->no_hp) ?>">
</div>

<div class="mb-3">
    <label>Role</label>
    <select name="role_id" class="form-control">
        <?php foreach($roles as $r): ?>
            <option value="<?= $r->id ?>"
                <?= $data_user->role_id == $r->id ? 'selected' : '' ?>>
                <?= $r->nama_role ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="is_active" class="form-control">
        <option value="1" <?= $data_user->is_active == 1 ? 'selected' : '' ?>>Aktif</option>
        <option value="0" <?= $data_user->is_active == 0 ? 'selected' : '' ?>>Nonaktif</option>
    </select>
</div>

<button class="btn btn-success">Update</button>
<a href="<?= base_url('user') ?>" class="btn btn-secondary">Kembali</a>

</form>
     </div>
</div>

            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      


