
  <?php $this->load->view('admin/header', [ 'title' => 'Data Kategori']);?>

<!-- Main content -->

<div class="main-content" id="panel">
  <?php $this->load->view('admin/topnav')?>

  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Kategori</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-12">
          <button type="button" class="btn btn-success mb-2"
          data-toggle='modal' data-target='#modalForm'>
            <i class="fas fa-plus"></i> Tambah
          </button>
        <div class="card p-2">
          <div class="table-responsive">
            <!-- Projects table -->
            <table id="tables" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">ID Kategori</th>
                  <th scope="col">Jenis RAB/Pekerjaan</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    
    <?php $this->load->view('admin/footer');?>
  </div>

    <!-- Modal Input -->
    <div class="modal fade" id="modalForm" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form id="formUpdateData" class="modal-content">
                <input type="hidden" name="id" id="id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Update Data</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputNama">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="..." required>
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



<?php $this->load->view('admin/script');?>
  <script>
    // $(document).ready( function () {
    //   $('#tables').DataTable();
    // });
    getData()
    function getData(){
        $('#tables').DataTable({
            lengthMenu: [[10, 50, 200, 1000], [10, 50, 200, 1000]],
            ajax:{
                url: "<?php echo base_url("user/kategori/get_datatables");?>",
                type: "POST",
                cache: false,
            },
        });
    }

    function updateInformasi(id){
      $.ajax({
          type: "GET",
          url: `<?=base_url();?>user/kategori/getByID/${id}`,
          cache: false,
          success: function(data){
              const dataOk = JSON.parse(data)
              $('#id').val(dataOk.id);
              $('#inputNama').val(dataOk.nama_kategori);
          }
      })
    }
    
    $('#formUpdateData').on('submit',function(e){
      e.preventDefault()
      if($('#id').val() === ''){
          $.ajax({
              url: "<?=base_url();?>user/kategori/insertdata",
              method: 'POST',
              type: 'POST',
              dataType: 'json',
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false
          }).done(function (data, textStatus, jqXHR){
            if(data.status){
              clearForm('formUpdateData')
              $('#tables').DataTable().ajax.reload();
              $('#modalForm').modal('hide')
              Swal.fire(
                  'Berhasil',
                  data.message,
                  'success'
              )
            }else{
              Swal.fire(
                  'Gagal!',
                  data.message,
                  'error'
              )
            }
          }).fail(function (jqXHR, textStatus, errorThrown){
              Swal.fire(
                  'Gagal!',
                  errorThrown,
                  'error'
              )
          })
      }else{
          $.ajax({
              url: "<?=base_url();?>user/kategori/updatedata",
              method: 'POST',
              type: 'POST',
              dataType: 'json',
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false
          }).done(function (data, textStatus, jqXHR){
              clearForm('formUpdateData')
              $('#tables').DataTable().ajax.reload();
              $('#modalForm').modal('hide')
              Swal.fire(
                  'Berhasil',
                  data.message,
                  'success'
              )
          }).fail(function (jqXHR, textStatus, errorThrown){
              Swal.fire(
                  'Gagal!',
                  errorThrown,
                  'error'
              )
          })
      }
      
    });

    function hapusData(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
              type: "GET",
              url: `<?=base_url();?>user/kategori/hapusdata/${id}`,
              cache: false,
              success: function(data){
                var data = JSON.parse(data)
                $('#tables').DataTable().ajax.reload();
                Swal.fire(
                  'Deleted!',
                  data.message,
                  'success'
                )
                  // const dataOk = JSON.parse(data)
              }
          })
        }
      })
    }
  
    function clearForm(data){
      document.getElementById(data).reset();
    }
  </script>
</body>

</html>