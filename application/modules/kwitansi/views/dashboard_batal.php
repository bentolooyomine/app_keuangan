      <style>

.danger-area {
    background: linear-gradient(135deg, #fff5f5, #ffe5e5);
    border: 2px solid #dc3545;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 0 15px rgba(220,53,69,0.15);
}

.danger-title {
    color: #b02a37;
    font-weight: bold;
}

.danger-warning {
    background: #dc3545;
    color: white;
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
}

#table thead {
    background: #dc3545;
    color: white;
}

.card-danger-soft {
    border: 2px solid #dc3545;
    border-radius: 15px;
}

</style>

      
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
        <div class="container-fluid">

    <div class="danger-area">

        <div class="danger-warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Menu ini digunakan untuk MEMBATALKAN status pembayaran BPD.
            Semua perubahan akan langsung mempengaruhi data transaksi.
        </div>

            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0"><?=  $nama_app; ?></h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item " aria-current="page"><?= $nama_app ?></li>
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
            <!-- Info boxes -->
          

    <!-- <h4 class="mb-3">Pembatalan Pembayaran BPD</h4> -->

    <!-- FILTER -->
 <div class="row mb-3">

    <!-- FILTER TANGGAL -->
    <div class="col-md-3">
        <label>Tanggal</label>
        <input type="date" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
    </div>

    <div class="col-md-2 align-self-end">
        <button class="btn btn-success w-100" onclick="filter_tanggal()">Filter Tanggal</button>
    </div>

    <!-- SEARCH KWITANSI -->
    <div class="col-md-4">
        <label>No Kwitansi</label>
        <input type="text" id="no_kwitansi" class="form-control" placeholder="Contoh: KWI2602000977">
    </div>

    <div class="col-md-2 align-self-end">
        <button class="btn btn-primary w-100" onclick="cari_kwitansi()">Cari</button>
    </div>

</div>

    <!-- TABLE -->
    <div class="card">
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Kwitansi</th>
                        <th>Tanggal</th>
                        <th>Bayar</th>
                        <th>Petugas</th>
                        <th>Tools</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


<!-- 1. JQUERY DULU -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DATATABLE -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
var table;
var mode_filter = 'tanggal';

$(document).ready(function() {

    table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('kwitansi/ajax_list_batal') ?>",
            type: "POST",
            data: function (d) {
                d.mode = mode_filter;

                if (mode_filter === 'tanggal') {
                    d.tanggal = $('#tanggal').val();
                    d.no_kwitansi = '';
                } else {
                    d.no_kwitansi = $('#no_kwitansi').val();
                    d.tanggal = '';
                }
            }
        }
    });

});

// 🔥 WAJIB DI LUAR
function filter_tanggal() {
    mode_filter = 'tanggal';
    table.ajax.reload();
}

function cari_kwitansi() {
    let kw = $('#no_kwitansi').val().trim();

    if (kw === '') {
        Swal.fire('Warning', 'Masukkan No Kwitansi dulu!', 'warning');
        return;
    }

    mode_filter = 'kwitansi';

    // 🔥 RESET PAGINATION KE HALAMAN PERTAMA
    table.page(0).draw('page');

    table.ajax.reload(function(json) {

        if (json.data.length === 0) {
            Swal.fire('Tidak ditemukan', 'No Kwitansi tidak ada!', 'error');
        }

    }, false);
}


function detail(kode) {

    $.ajax({
        url: "<?= base_url('kwitansi/detail') ?>",
        type: "POST",
        data: { kode: kode },
        dataType: "json",
        success: function(d) {

            // BASIC
            $('#d_no').text(d.NoKwitansi);
            $('#d_kode').text(d.Kode);
            $('#d_tgl').text(d.Tanggal);
            $('#d_kunjungan').text(d.KodeKunjungan);
            $('#d_jual').text(d.KodeJual);
            $('#d_periksa').text(d.KodePeriksa);

            // FORMAT RUPIAH
            $('#d_bayar').text(
                parseFloat(d.Bayar).toLocaleString('id-ID')
            );

            // PETUGAS
            $('#d_petugas').text(d.NamaPetugas);

            // MASTER DATA
            $('#d_rekening').text(d.KodeRekening);
            $('#d_loket').text(d.KodeLoket);
            $('#d_setor').text(d.KodeSetor);

            // STATUS
            $('#d_aktif').text(d.Aktif);
            $('#d_status').text(d.Status);
            $('#d_cetak').text(d.StCetak);

            // SYSTEM LOG
            $('#d_createdby').text(d.CreatedBy);
            $('#d_createdtime').text(d.CreatedTime);
            $('#d_deletedby').text(d.DeletedBy);
            $('#d_deletedtime').text(d.DeletedTime);

            $('#d_ref').text(d.NoRefference);
            $('#d_oid').text(d.Oid);
            $('#d_oidrev').text(d.OidReversal);

            $('#modalDetail').modal('show');
        }
    });

}


function ajukanHapus(kode) {

    $.ajax({
        url: "<?= base_url('kwitansi/detail') ?>",
        type: "POST",
        data: { kode: kode },
        dataType: "json",
        success: function(d) {
      console.log(d);
      
            $('#h_kode').val(d.Kode);
            $('#h_no').text(d.NoKwitansi);
            $('#h_tgl').text(d.Tanggal);
            $('#h_bayar').text(parseFloat(d.Bayar).toLocaleString('id-ID'));

            $('#modalHapus').modal('show');
        }
    });

}



function kirim_pengajuan() {

    let kode = $('#h_kode').val();
    let alasan = $('#alasan').val();

    if (alasan === '') {
        Swal.fire('Warning', 'Alasan wajib diisi!', 'warning');
        return;
    }

    $.ajax({
        url: "<?= base_url('kwitansi/ajukan_penghapusan') ?>",
        type: "POST",
        data: {
            kode: kode,
            alasan: alasan
        },
        dataType: "json",
        success: function(res) {

            if (res.status) {
                Swal.fire('Berhasil', 'Pengajuan terkirim', 'success');
                $('#modalHapus').modal('hide');
                table.ajax.reload(null, false);
            }

        }
    });

}
</script>


            <!-- /.row -->

            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->


    <div class="modal fade" id="modalDetail" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Detail Kwitansi Lengkap</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row">

          <!-- LEFT -->
          <div class="col-md-6">
            <table class="table table-sm table-bordered">

              <tr><th>No Kwitansi</th><td id="d_no"></td></tr>
              <tr><th>Kode</th><td id="d_kode"></td></tr>
              <tr><th>Tanggal</th><td id="d_tgl"></td></tr>
              <tr><th>Bayar</th><td id="d_bayar"></td></tr>
              <tr><th>Kode Kunjungan</th><td id="d_kunjungan"></td></tr>
              <tr><th>Kode Jual</th><td id="d_jual"></td></tr>
              <tr><th>Kode Periksa</th><td id="d_periksa"></td></tr>

            </table>
          </div>

          <!-- RIGHT -->
          <div class="col-md-6">
            <table class="table table-sm table-bordered">

              <tr><th>Petugas</th><td id="d_petugas"></td></tr>
              <tr><th>Kode Rekening</th><td id="d_rekening"></td></tr>
              <tr><th>Kode Loket</th><td id="d_loket"></td></tr>
              <tr><th>Kode Setor</th><td id="d_setor"></td></tr>

              <tr><th>Status Aktif</th><td id="d_aktif"></td></tr>
              <tr><th>Status Bayar</th><td id="d_status"></td></tr>
              <tr><th>Status Cetak</th><td id="d_cetak"></td></tr>

            </table>
          </div>

        </div>

        <hr>

        <!-- LOG / SYSTEM INFO -->
        <div class="row">
          <div class="col-md-12">
            <table class="table table-sm table-bordered">

              <tr><th>Created By</th><td id="d_createdby"></td></tr>
              <tr><th>Created Time</th><td id="d_createdtime"></td></tr>
              <tr><th>Deleted By</th><td id="d_deletedby"></td></tr>
              <tr><th>Deleted Time</th><td id="d_deletedtime"></td></tr>

              <tr><th>No Reference</th><td id="d_ref"></td></tr>
              <tr><th>OID</th><td id="d_oid"></td></tr>
              <tr><th>OID Reversal</th><td id="d_oidrev"></td></tr>

            </table>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>





<div class="modal fade" id="modalHapus" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Ajukan Penghapusan Kwitansi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <!-- DETAIL KWITANSI -->
        <table class="table table-sm table-bordered">
            <tr><th>No Kwitansi</th><td id="h_no"></td></tr>
            <tr><th>Tanggal</th><td id="h_tgl"></td></tr>
            <tr><th>Total</th><td id="h_bayar"></td></tr>
        </table>

        <input type="hidden" id="h_kode">

        <!-- ALASAN -->
        <div class="form-group">
            <label>Alasan Penghapusan</label>
            <textarea id="alasan" class="form-control" rows="3"></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-danger" onclick="kirim_pengajuan()">Ajukan</button>
      </div>

    </div>
  </div>
</div>





      </main>
      
      <script>
        function batalBpd(kode)
{
    Swal.fire({
        title: 'Batal BPD?',
        text: 'Pembayaran Akan diubah Secara Cash',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Batalkan!',
        cancelButtonText: 'Tidak'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "<?= base_url('kwitansi/proses_batal_bpd') ?>",
                type: "POST",
                data: {
                    kode: kode
                },
                dataType: "json",
                success: function(res){

                    if(res.status){

                        Swal.fire(
                            'Berhasil',
                            'Status BPD berhasil dibatalkan',
                            'success'
                        );

                        table.ajax.reload(null, false);

                    } else {

                        Swal.fire(
                            'Error',
                            res.message,
                            'error'
                        );
                    }
                }
            });

        }

    });
}


      </script>