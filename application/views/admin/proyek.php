
  <?php $this->load->view('admin/header', [ 'title' => 'Data Proyek']);?>

<!-- Main content -->

<div class="main-content" id="panel">
  <?php $this->load->view('admin/topnav')?>

  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Pemesanan Belum Diperiksa</h6>
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
            <table id="tables" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">Kode Invoice</th>
                  <th scope="col">Nama Pelanggan</th>
                  <th scope="col">Tgl. Pemesanan</th>
                  <!-- <th scope="col">File RAB</th> -->
                  <th scope="col">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Header -->
  <div class="header pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 d-inline-block mb-0">Pemesanan Sudah Diperiksa</h6>
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
    
    <?php $this->load->view('admin/footer');?>
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

    <!-- Modal view -->
    <div class="modal fade" id="modalView" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">View Pesanan</h5>
                    <button type="button" onclick="clearForm('formUpdateData')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Nama</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="nama"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>NIK</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="nik"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Alamat</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="alamat"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Telpon</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="no_telp"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Rumah Tipe</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="type"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Luas Tanah</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="tanah"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Kamar Tidur</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="kamar"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Kamar Mandi</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="kamar_mandi"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Luas Bangunan</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="bangunan"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Garasi</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="garasi"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Referensi</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="referensi"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Lantai</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="lantai"></p>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0">
                        <div class="col-lg-4">
                            <b>Pesan</b>
                        </div>
                        <div class="col-lg-8">
                            <p id="pesan"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" target="new" class="btn btn-primary btn-sm" id="btn-cetak">Cetak</a>
                </div>
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

    <!-- Modal Upload Berkas -->
    <div class="modal fade" id="modalUpload" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <form id="formUpload" class="modal-content">
                <input type="hidden" name="id" id="id_upload" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Upload Desain Dan Sketsa Rumah</h5>
                    <button type="button" onclick="clearForm('formUpload')" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Masukkan file dalam bentuk pdf</label>
                        <input type="file" name="pdf" class="form-control-file" id="exampleFormControlFile1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearForm('formUpload')" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php $this->load->view('admin/script');?>
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
        $('#tables1').DataTable({
            lengthMenu: [[5, 10, 50, 200, 1000], [5, 10, 50, 200, 1000]],
            ajax:{
                url: "<?php echo base_url("user/proyek/get_datatables1");?>",
                type: "POST",
                cache: false,
            },
        });
    }

    function viewBukti(url){
        var url = '<?=base_url();?>assets/img/imageUpload/'+url;
        $('#img_bukti').attr("src", url)
    }

    function updateInformasi(id){
      $.ajax({
          type: "GET",
          url: `<?=base_url();?>user/proyek/getByID/${id}`,
          cache: false,
          success: function(data){
              const dataOk = JSON.parse(data)
              $('#id').val(dataOk.id);
              $('#proses').val(dataOk.status);
              $('#inputLahir').val(dataOk.tgl_lahir);
          }
      })
    }

    function viewInformasi(id){
        $.ajax({
            type: "GET",
            url: `<?=base_url();?>user/proyek/getID/${id}`,
            cache: false,
            success: function(data){
                const dataOk = JSON.parse(data)
                $('#nama').html(dataOk.nama)
                $('#nik').html(dataOk.nik)
                $('#type').html(dataOk.model)
                $('#tanah').html(dataOk.ukuran)
                $('#kamar').html(dataOk.kamar)
                $('#kamar_mandi').html(dataOk.kamar_mandi)
                $('#alamat').html(dataOk.alamat)
                $('#no_telp').html(dataOk.no_telp)
                $('#lantai').html(dataOk.lantai)
                $('#bangunan').html(dataOk.luas_bangunan)
                $('#garasi').html(dataOk.garasi)
                $('#referensi').html(dataOk.referensi)
                $('#pesan').html(dataOk.pesan)
                $('#btn-cetak').attr("href", '<?=base_url();?>user/proyek/cetakdesain/'+dataOk.id)
            }
        })
    }

    $('#formUpdateData').on('submit',function(e){
      e.preventDefault()
      $.ajax({
          url: "<?=base_url();?>user/proyek/proses",
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
          $('#tables1').DataTable().ajax.reload();
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
    });

    $('#formUpload').on('submit',function(e){
      e.preventDefault()
      $.ajax({
          url: "<?=base_url();?>user/proyek/uploaddesain",
          method: 'POST',
          type: 'POST',
          dataType: 'json',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false
      }).done(function (data, textStatus, jqXHR){
          clearForm('formUpload')
          $('#modalUpload').modal('hide')
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

    function setIDForm(id){
        $('#id_upload').val(id)
    }
  
    function clearForm(data){
      document.getElementById(data).reset();
    }
  
  </script>
</body>

</html>