
  <?php $this->load->view('admin/header', [ 'title' => 'Dashboard']);?>

  <!-- Main content -->

<div class="main-content" id="panel">
  <?php $this->load->view('admin/topnav')?>
  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Dashboard</h6>
          </div>
        </div>
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-2">Jumlah Pelanggan</h5>
                    <span class="h2 font-weight-bold mb-0"><?=$jumlah_pelanggan?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                      <i class="ni ni-active-40"></i>
                    </div>
                  </div>
                </div>
                <!-- <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                  <span class="text-nowrap">Since last month</span>
                </p> -->
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-2">Pesanan Baru</h5>
                    <span class="h2 font-weight-bold mb-0">0</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="ni ni-chart-pie-35"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-2">Total Kunjungan Hari Ini</h5>
                    <span class="h2 font-weight-bold mb-0">924</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-money-coins"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
        <div class="card bg-default">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                <h5 class="h3 text-white mb-0">Total Pesanan Tiap Bulan</h5>
              </div>
              <div class="mr-3 ml-auto">
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pilih Tahun
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php $thn = 2021; 
                      for($thn; $thn<=date('Y'); $thn++){
                        echo "<a href='#' onclick='event.preventDefault();coba(".$thn.")' class='dropdown-item'>".$thn."</a>";
                      }
                    ?>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Chart -->
            <div class="chart">
              <!-- Chart wrapper -->
              <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $this->load->view('admin/footer');?>
  </div>
</div>



  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?=base_url();?>assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?=base_url();?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url();?>assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?=base_url();?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?=base_url();?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="<?=base_url();?>assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?=base_url();?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="<?=base_url();?>assets/js/argon.js?v=1.2.0"></script>
</body>
<script>
    // Variables

    var $chart = $('#chart-sales-dark');


    // Methods

    function init($chart,tahun) {
      var dataJson = {
        'tahun' : tahun
      }
      $.ajax({
            url: "<?=base_url();?>user/home/overview",
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            data: dataJson,
        }).done(function (dataRes, textStatus, jqXHR){
          console.log(dataRes)
            var salesChart = new Chart($chart, {
              type: 'line',
              options: {
                scales: {
                  yAxes: [{
                    gridLines: {
                      lineWidth: 1,
                      color: Charts.colors.gray[900],
                      zeroLineColor: Charts.colors.gray[900]
                    }
                  }]
                },
              },
              data: {
                // labels: ['jan', 'Feb', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                labels: dataRes.bulan,
                datasets: [{
                  label: 'Transaksi',
                  // data: [10, 100, 10, 30, 15],
                  data: dataRes.trx
                }]
              }
            });


            // Save to jQuery object

            $chart.data('chart', salesChart);
        }).fail(function (jqXHR, textStatus, errorThrown){
            console.log('error')
        })


    };


    // Events

    if ($chart.length) {
      init($chart,2021);
    }

    function coba(tahun){
      if ($chart.length) {
        init($chart,tahun);
      }
    }

</script>
</html>