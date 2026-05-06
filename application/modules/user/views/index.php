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
        <h3 class="card-title">Data Users</h3>
    </div>

    <div class="card-body">
      <div class="mb-3">
    <a href="<?= base_url('user/add') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>
</div>
        <table id="tableUser" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Last Login</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($users as $u): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $u->nama ?></td>
                    <td><?= $u->username ?></td>
                    <td><?= $u->email ?></td>
                    <td><?= $u->no_hp ?></td>
                    <td><?= $u->role_id ?></td>
                    <td>
                        <?= $u->is_active == 1 
                            ? '<span class="badge bg-success">Aktif</span>' 
                            : '<span class="badge bg-danger">Nonaktif</span>' ?>
                    </td>
                    <td><?= $u->last_login ?></td>
                    <td>
                        <a href="<?= base_url('user/edit/'.$u->id) ?>" class="btn btn-sm btn-warning">
    <i class="bi bi-pencil"></i> 
</a>

                   <a href="javascript:void(0)" 
   class="btn btn-sm btn-danger btn-delete" 
   data-id="<?= $u->id ?>">
   <i class="bi bi-trash"></i> 
</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      


