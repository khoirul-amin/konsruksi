
  <?php $this->load->view('/admin/header', [ 'title' => 'Data Proyek']);?>

<!-- Main content -->

<div class="main-content" id="panel">
  <?php $this->load->view('/admin/topnav')?>

  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Data Pemesanan</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
        <div class="card p-2">
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="tables1" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Kode Invoice</th>
                  <th scope="col">Nama Pelanggan</th>
                  <th scope="col">Tgl. Pemesanan</th>
                  <th scope="col">Admin</th>
                  <th scope="col">Status</th>
                  <!-- <th scope="col">File RAB</th> -->
                  <th scope="col">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    
    <?php $this->load->view('/admin/footer');?>
  </div>

    <!-- Modal Input -->
    <div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form id="formUpdateData" class="modal-content">
                <input type="hidden" name="id" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Proses Pesanan</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="proses">Proses</label>
                        <select name="proses" class="form-control" id="proses">
                            <option value=2>Proses</option>
                            <option value=3>Tolak</option>
                            <option value=4>Menunggu Pembayaran</option>
                            <option value=5>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="inputKeterangan" placeholder="..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearForm('formUpdateData')" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Modal Bukti -->
    <div class="modal fade" id="modalBukti" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Bukti Pembayaran</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" width="300px" alt="bukti" id="img_bukti">
                </div>
            </div>
        </div>
    </div>

  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- DataTables -->
  <script src="/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
  <!-- Optional JS -->
  <script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.2.0"></script>
  <script>
    getData()
    function getData(){
        $('#tables1').DataTable({
            lengthMenu: [[5, 10, 50, 200, 1000], [5, 10, 50, 200, 1000]],
            ajax:{
                url: "<?php echo base_url("user/pesanan/get_datatables1");?>",
                type: "POST",
                cache: false,
            },
        });
    }
    function viewBukti(url){
        var url = '/assets/img/imageUpload/'+url;
        $('#img_bukti').attr("src", url)
    }
  
    function clearForm(data){
      document.getElementById(data).reset();
    }
  
  </script>
</body>

</html>