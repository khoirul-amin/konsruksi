
  <?php $this->load->view('/admin/header', [ 'title' => 'Setting Profile']);?>

<!-- Main content -->

<div class="main-content" id="panel">
  <?php $this->load->view('/admin/topnav')?>

  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Profile Setting</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-xl-3">
        <div class="card p-2">
            <h5>Poto Profile</h5>
            <img src="" width="200" class="mb-2 ml-2" alt="user_img" id="user_img">
            <button type="button" 
						data-toggle='modal' data-target='#modalForm'
            class="btn btn-secondary" ><i class="far fa-save"></i> Upload</button> <br/>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="card p-2">
            <h5>Personal information</h5><br>
            <div class="form-group row mb-3">
                <label for="inputNama" class="col-sm-2 col-form-label col-form-label-sm">Nama</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control form-control-sm" id="inputNama">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputTglLahir" class="col-sm-2 col-form-label col-form-label-sm">Tgl Lahir</label>
                <div class="col-sm-10">
                    <input type="date" name="tgl_lahir" class="form-control form-control-sm" id="inputTglLahir">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="inputAlamat" class="col-sm-2 col-form-label col-form-label-sm">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" name="alamat" class="form-control form-control-sm" id="inputAlamat">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="inputOldPassword" class="col-sm-2 col-form-label col-form-label-sm">Password Lama</label>
                <div class="col-sm-10">
                    <input type="password" name="old_password" placeholder="Password Lama" class="form-control form-control-sm" id="inputOldPassword">
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="inputNewPassword" class="col-sm-2 col-form-label col-form-label-sm">Password Baru</label>
                <div class="col-sm-10">
                    <input type="password" name="new_password" placeholder="Password Baru" class="form-control form-control-sm" id="inputNewPassword">
                </div>
            </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="card p-2">
            <h5>Personal information</h5><br>
            <button onclick="save()" class="btn btn-secondary" ><i class="far fa-save"></i> Simpan Data</button> <br/>
            <button class="btn btn-secondary"><i class="far fa-times-circle"></i> Batalkan</button> <br/>
            <button onclick="logout()" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Logout</button><br><br><br>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12">
        <div class="card p-2">
            <b>Note :</b> 
            - Jika anda tidak merubah password. cukup kosongi kolom password lama dan password baru.
            <br> - Jika lupa password silahkan hubungi admin untuk reset password.
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
                    <h5 class="modal-title" id="modalFormLabel">Update Data</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputGroupFile01">Image</label>
                        <div class="custom-file">
                            <input type="file" required name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
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
  <script src="/assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
  <!-- Argon JS -->
  <script src="/assets/js/argon.js?v=1.2.0"></script>
  <script>

    getData()
    function getData(){
      var id = <?=$user->id?>;
      $.ajax({
          type: "GET",
          url: `/user/setting/getData/${id}`,
          cache: false,
          success: function(data){
              $('#modalForm').modal('hide')
              clearForm('formUpdateData')
              const dataOk = JSON.parse(data)
              if(!dataOk.avatar){
                var image = 'default.jpeg'
              }else{
                var image = dataOk.avatar
              }
              $('#inputNama').val(dataOk.nama);
              $('#inputTglLahir').val(dataOk.tgl_lahir);
              $('#inputAlamat').val(dataOk.alamat);
              $('#user_img').attr("src", '/assets/img/imageProfile/'+image);
          }
      })
    }

    function logout(){
      Swal.fire({
        title: 'Anda yakin?',
        text: "Apakah anda yakin mau LogOut ?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oke'
      }).then((result) => {
        if (result.value) {
          window.location.href = "/logout";
        }
      })
    }

    function save(){
      const nama = $('#inputNama').val()
      const tgl_lahir = $('#inputTglLahir').val()
      const alamat = $('#inputAlamat').val()
      const old_password = $('#inputOldPassword').val()
      const new_password = $('#inputNewPassword').val()
      if(new_password || old_password){
        var dataJson = {
          nama : nama,
          tgl_lahir : tgl_lahir,
          alamat : alamat,
          old_password: old_password,
          new_password : new_password
        }
      }else{
        var dataJson = {
          nama : nama,
          tgl_lahir : tgl_lahir,
          alamat : alamat
        }
      }
      $.ajax({
            url: "/user/setting/updatedata",
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            data: dataJson,
        }).done(function (data, textStatus, jqXHR){
            if(data.status){
              getData()
              $('#inputOldPassword').val("")
              $('#inputNewPassword').val("")
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
    }

    $('#formUpdateData').on('submit',function(e){
        e.preventDefault()
        $.ajax({
            url: "/user/setting/uploadimage",
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false
        }).done(function (data, textStatus, jqXHR){
            getData();
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
      
    });

    function clearForm(data){
      document.getElementById(data).reset();
    }
  </script>
</body>

</html>