
  <?php $this->load->view('/admin/header', [ 'title' => 'Data Karyawan']);?>

<!-- Main content -->

<div class="main-content" id="panel">
  <?php $this->load->view('/admin/topnav')?>

  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Karyawan</h6>
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
                  <th scope="col">Nama</th>
                  <th scope="col">Tgl Lahir</th>
                  <th scope="col">No. KTP</th>
                  <th scope="col">No. Telpon</th>
                  <th scope="col">Email</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Username</th>
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
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                        <label for="inputNama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="inputNama" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputLahir">Tgl. Lahir</label>
                        <input type="date" name="lahir" class="form-control" id="inputLahir" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputNIK">No. KTP</label>
                        <input type="text" name="NIK" class="form-control" id="inputNIK" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input type="text" name="email" class="form-control" id="inputEmail" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <input type="text" name="username" class="form-control" id="inputUsername" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputNoTelp">No. Telpon</label>
                        <input type="text" name="no_telp" class="form-control" id="inputNoTelp" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="inputAlamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="inputAlamat" placeholder="..." required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" id="role">
                            <option value=2>Karyawan</option>
                            <option value=3>Pelanggan</option>
                        </select>
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
                url: "<?php echo base_url("user/karyawan/get_datatables");?>",
                type: "POST",
                cache: false,
            },
        });
    }

    function updateInformasi(id){
      $.ajax({
          type: "GET",
          url: `<?=base_url()?>user/karyawan/getByID/${id}`,
          cache: false,
          success: function(data){
              const dataOk = JSON.parse(data)
              $('#id').val(dataOk.id);
              $('#inputNama').val(dataOk.nama);
              $('#inputLahir').val(dataOk.tgl_lahir);
              $('#inputNIK').val(dataOk.NIK);
              $('#inputEmail').val(dataOk.email);
              $('#inputAlamat').val(dataOk.alamat);
              $('#inputUsername').val(dataOk.username);
              $('#inputNoTelp').val(dataOk.no_telp);
              $('#role').val(dataOk.role);
          }
      })
    }
    
    $('#formUpdateData').on('submit',function(e){
      e.preventDefault()
      if($('#id').val() === ''){
          $.ajax({
              url: "<?=base_url()?>user/karyawan/insertdata",
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
              url: "<?=base_url()?>user/karyawan/updatedata",
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
              url: `<?=base_url()?>user/karyawan/hapusdata/${id}`,
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

    function lupaPassword(id){
      Swal.fire({
        title: 'Anda yakin?',
        text: "Apakah anda yakin mau mereset password akun ini ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
          $.ajax({
              type: "GET",
              url: `<?=base_url()?>user/karyawan/lupapassword/${id}`,
              cache: false,
              success: function(data){
                var data = JSON.parse(data)
                // $('#tables').DataTable().ajax.reload();
                Swal.fire(
                  'Deleted!',
                  data.message,
                  'success'
                )
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