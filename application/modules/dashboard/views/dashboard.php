      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
          <div class="row mb-3">
  <div class="col-md-12">
    <form method="GET" class="d-flex gap-2 align-items-end">

      <div>
        <label>Tanggal Awal</label>
        <input type="date" name="tgl_awal" value="<?= $tgl_awal ?>" class="form-control">
      </div>

      <div>
        <label>Tanggal Akhir</label>
        <input type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>" class="form-control">
      </div>

      <div>
        <button class="btn btn-primary">
          Filter
        </button>
      </div>

    </form>
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
          <div class="row">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><b>Pendapatan Harian</b></div>
      <div class="card-body">
        <div id="chart_pendapatan"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><b>Jumlah Transaksi</b></div>
      <div class="card-body">
        <div id="chart_transaksi"></div>
      </div>
    </div>
  </div>

</div>

<div class="row mt-3">

  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><b>Akumulasi Pendapatan</b></div>
      <div class="card-body">
        <div id="chart_akumulasi"></div>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <div class="card-header"><b>Distribusi Pendapatan</b></div>
      <div class="card-body">
        <div id="chart_pie"></div>
      </div>
    </div>
  </div>

</div>
              <!-- /.col -->
            </div>
            <!--end::Row-->

         
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      
 <script>
let data = <?= json_encode($chart_ttbayar) ?>;

let kategori = data.map(d => d.tgl);
let total = data.map(d => parseFloat(d.total_bayar));
let jumlah = data.map(d => parseInt(d.jumlah_transaksi));

let akumulasi = [];
let sum = 0;

data.forEach(d => {
    sum += parseFloat(d.total_bayar);
    akumulasi.push(sum);
});
</script>