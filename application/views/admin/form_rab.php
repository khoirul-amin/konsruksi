
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
            <h6 class="h2 d-inline-block mb-0">1. Form RAB Pelanggan</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
          <button type="button" class="btn btn-success mb-2 btn-sm"
          data-toggle='modal' data-target='#modalForm'>
            <i class="fas fa-plus"></i> Tambah
          </button>
          <a href="/user/proyek/cetak/<?=$id;?>" target="new" class="btn btn-danger mb-2 btn-sm">
            <i class="fas fa-plus"></i> Print
          </a>
        <div class="card p-2">
            <?php for($i=0; $i<count($rab);$i++){
                echo $rab[$i];
            }; ?>
        </div>
        <div class="card p-3">
            <div class="row ml-0 mr-0">
                <div class="mr-auto">Jumlah</div>
                <div><b><?="Rp. ".number_format($total->total)?></b></div>
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
                <input type="hidden" name="id" value=<?=$id_projek;?> id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Proses Pesanan</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputKeterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="inputKeterangan" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="Kategori">Kategori</label>
                        <select name="kategori" class="form-control" id="Kategori">
                            <?php foreach($kategori1 as $kategori){ ?>
                                <option value=<?=$kategori->id?>><?=$kategori->nama_kategori;?></option>
                            <?php }; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputSatuan">Satuan</label>
                        <input type="text" name="satuan" class="form-control" id="inputSatuan" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputHargaSatuan">Harga Satuan</label>
                        <input type="number" name="harga" class="form-control" id="inputHargaSatuan" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputVolume">Volume</label>
                        <input type="number" name="volume" class="form-control" id="inputVolume" placeholder="..." required>
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
        $('#tables').DataTable({
            lengthMenu: [[5, 10, 50, 200, 1000], [5, 10, 50, 200, 1000]],
            ajax:{
                url: "<?php echo base_url("user/proyek/get_datatables");?>",
                type: "POST",
                cache: false,
            },
        });
    }

    function updateInformasi(id){
      $.ajax({
          type: "GET",
          url: `/user/proyek/getByID/${id}`,
          cache: false,
          success: function(data){
              const dataOk = JSON.parse(data)
              $('#id').val(dataOk.id);
              $('#proses').val(dataOk.status);
              $('#inputLahir').val(dataOk.tgl_lahir);
          }
      })
    }


    $('#formUpdateData').on('submit',function(e){
      e.preventDefault()
      $.ajax({
          url: "/user/proyek/insertRab",
          method: 'POST',
          type: 'POST',
          dataType: 'json',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false
      }).done(function (data, textStatus, jqXHR){
            window.location.reload();
      }).fail(function (jqXHR, textStatus, errorThrown){
          Swal.fire(
              'Gagal!',
              errorThrown,
              'error'
          )
      })
    });
  
    function clearForm(data){
      document.getElementById(data).reset();
    }
  </script>
</body>

</html>