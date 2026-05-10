<div class="app-content">
<div class="container-fluid">

<div class="card card-primary card-outline">

    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-building"></i>
            Setting Profil Instansi
        </h3>
    </div>

    <form method="post"
          action="<?= base_url('profil/simpan') ?>"
          enctype="multipart/form-data">

    <div class="card-body">

        <input type="hidden"
               name="id"
               value="<?= $setting->id ?>">

        <div class="row">

            <div class="col-md-6">

                <div class="mb-3">
                    <label>Nama Aplikasi</label>
                    <input type="text"
                           name="nama_app"
                           class="form-control"
                           value="<?= $setting->nama_app ?>">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat"
                              class="form-control"><?= $setting->alamat ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Kecamatan</label>
                    <input type="text"
                           name="kecamatan"
                           class="form-control"
                           value="<?= $setting->kecamatan ?>">
                </div>

                <div class="mb-3">
                    <label>Kabupaten</label>
                    <input type="text"
                           name="kabupaten"
                           class="form-control"
                           value="<?= $setting->kabupaten ?>">
                </div>

                <div class="mb-3">
                    <label>Provinsi</label>
                    <input type="text"
                           name="provinsi"
                           class="form-control"
                           value="<?= $setting->provinsi ?>">
                </div>

            </div>

            <div class="col-md-6">

                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="text"
                           name="telepon"
                           class="form-control"
                           value="<?= $setting->telepon ?>">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="<?= $setting->email ?>">
                </div>

                <div class="mb-3">
                    <label>Website</label>
                    <input type="text"
                           name="website"
                           class="form-control"
                           value="<?= $setting->website ?>">
                </div>

                <div class="mb-3">
                    <label>Nama Kepala</label>
                    <input type="text"
                           name="nama_kepala"
                           class="form-control"
                           value="<?= $setting->nama_kepala ?>">
                </div>

                <div class="mb-3">
                    <label>NIP Kepala</label>
                    <input type="text"
                           name="nip_kepala"
                           class="form-control"
                           value="<?= $setting->nip_kepala ?>">
                </div>

                <div class="mb-3">
                    <label>Logo</label>

                    <input type="file"
                           name="logo"
                           class="form-control">

                    <br>

                    <?php if($setting->logo){ ?>

                        <img src="<?= base_url('uploads/logo/'.$setting->logo) ?>"
                             width="120">

                    <?php } ?>

                </div>

            </div>

        </div>

    </div>

    <div class="card-footer">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i>
            Simpan Profil
        </button>
    </div>

    </form>

</div>

</div>
</div>