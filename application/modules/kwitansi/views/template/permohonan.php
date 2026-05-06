  <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
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

<div class="container-fluid mt-3">

    <div class="row mb-3">
        <div class="col-md-3">
            <label>Tanggal Pengajuan</label>
            <input type="date" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>">
        </div>

        <div class="col-md-2 align-self-end">
            <button class="btn btn-success w-100" onclick="load_data()">Filter</button>
        </div>
    </div>


    <!-- TABLE -->
    <div class="card">
        <div class="card-body">
    <table class="table table-bordered" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>No Kwitansi</th>
                <th>Total</th>
                <th>Alasan</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
                <th>Tools</th>
            </tr>
        </thead>
    </table></div></div>
</div>


<div class="modal fade" id="modalTindak" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tindak Lanjut Permohonan</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <table class="table table-sm table-bordered">
            <tr><th>No Kwitansi</th><td id="tl_no"></td></tr>
            <tr><th>Tanggal</th><td id="tl_tgl"></td></tr>
            <tr><th>Total</th><td id="tl_total"></td></tr>
            <tr><th>Alasan</th><td id="tl_alasan"></td></tr>
            <tr><th>Status</th><td id="tl_status"></td></tr>
        </table>

        <input type="hidden" id="tl_id">

      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

        <button class="btn btn-success" onclick="proses()"><i class="bi bi-box2-heart-fill"></i> Proses</button>
      </div>

    </div>
  </div>
</div>

          </div></div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

let table;

$(document).ready(function () {

    table = $('#table').DataTable({
        ajax: {
            url: "<?= base_url('kwitansi/ajax_permohonan') ?>", // 🔥 FIX INI
            type: "POST",
            data: function(d){
                d.tanggal = $('#tanggal').val();
            }
        }
    });

});

// 🔥 FILTER
function load_data(){
    table.ajax.reload();
}

// 🔥 DETAIL
function detail_permohonan(id){
    alert("Detail ID: " + id);
}

// 🔥 APPROVE
function approve(id){
    alert("Approve ID: " + id);
}


function tindakLanjut(id){

    $.ajax({
        url: "<?= base_url('kwitansi/detail_permohonan') ?>",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function(d){

            $('#tl_id').val(d.id);
            $('#tl_no').text(d.no_kwitansi);
            $('#tl_tgl').text(d.tanggal_kwitansi);
            $('#tl_total').text(parseFloat(d.total_bayar).toLocaleString('id-ID'));
            $('#tl_alasan').text(d.alasan);
            $('#tl_status').text(d.status_pengajuan);

            $('#modalTindak').modal('show');
        }
    });

}

function proses(){

    let id = $('#tl_id').val();

    Swal.fire({
        title: 'Proses permohonan?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya Proses'
    }).then((result) => {

        if(result.isConfirmed){

            $.ajax({
                url: "<?= base_url('kwitansi/proses_pengajuan') ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(res){

                    if(res.status){
                        Swal.fire('Berhasil', 'Status jadi PROSES', 'success');
                        $('#modalTindak').modal('hide');
                        table.ajax.reload(null,false);
                    }

                }
            });

        }

    });

}


function sinkronisasi(id){

    Swal.fire({
        title: 'Sinkronisasi data?',
        text: "Data akan disinkron ke sistem utama",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya Sinkron'
    }).then((result) => {

        if(result.isConfirmed){

            $.ajax({
                url: "<?= base_url('kwitansi/sinkronisasi') ?>",
                type: "POST",
                data: { id: id },
                dataType: "json",
                success: function(res){

                    if(res.status){
                        Swal.fire('Berhasil', 'Data tersinkron', 'success');
                        table.ajax.reload(null,false);
                    }

                }
            });

        }

    });

}

function detailSinkron(id) {
    $.ajax({
        url: "<?= base_url('kwitansi/detail_sinkron') ?>",
        type: "POST",
        data: { id: id },
        success: function(res) {
            let r = JSON.parse(res);

            let html = '';

            r.data.forEach(function(v) {
                html += `
                    <tr>
                        <td>${v.kode}</td>
                        <td>${v.tanggal}</td>
                        <td>${v.aplikasi}</td>
                        <td>${v.kegiatan}</td>
                        <td>${v.nomor}</td>
                        <td>${v.petugas}</td>
                    </tr>
                `;
            });

            Swal.fire({
                title: 'Detail Transaksi Syslog',
                html: `
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Aplikasi</th>
                                <th>Kegiatan</th>
                                <th>Nomor</th>
                                <th>Petugas</th>
                            </tr>
                        </thead>
                        <tbody>${html}</tbody>
                    </table>
                `,
                width: '90%'
            });
        }
    });
}
</script>