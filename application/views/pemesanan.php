<?php $this->load->view('landing/header', ['style' => 'style="background:#001970;"'] );?>
<div class="row ml-0 mr-0">
    <div class="container mt-4 mb-4">
        <form class="" action="" id="formUpdateData">
        <div class="row ml-0 mr-0 pt-md-4 justify-content-md-center" style="color:#707070;">
            <div class="col-md-12 pb-3 text-center">
                <h4 style="font-weight:bold;">Form pemesanan</h4>
            </div>
            <div class="col-md-8 pb-3 pt-2 rounded shadow">
                <p class="text-center"><b>Identitas Pribadi</b></p>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Nama</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$user->nama;?>" placeholder="Nama">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Nomor Telepon</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$user->no_telp;?>" placeholder="Nama">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Email</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$user->email;?>" placeholder="Nama">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Alamat Lengkap</div>
                    <div class="col-lg-6 text-right p-0">
                        <input class="input" type="text" readonly value="<?=$user->alamat;?>" placeholder="Nama">
                    </div>
                </div>

                <p class="text-center"><b>Ukuran Dan Luas Tanah</b></p>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Ukuran Tanah P X L</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="ukuran" placeholder="Ukuran">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Jumlah Lantai</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="lantai" placeholder="Lantai">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Luas Bangunan M2</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="luas_bangunan" placeholder="Luas">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Model Bangunan</div>
                    <div class="col-lg-6 text-right p-0">
                        <div class="form-group">
                            <select class="form-control" name="model" id="exampleFormControlSelect1">
                                <?php foreach($model as $model){ ?>
                                <option value=<?=$model->id?>><?=$model->judul;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <p class="text-center"><b>Desain dan Sketsa</b></p>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Jumlah Kamar</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="kamar" placeholder="Jumlah Kamar">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Jumlah Kamar Mandi</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="kamar_mandi" placeholder="Kamar mandi">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Garasi</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="garasi" placeholder="Garasi">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Referensi Desain</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="referensi" placeholder="Masukkan link halaman referensi">
                    </div>
                </div>
                <div class="row ml-0 mr-0 mb-3">
                    <div class="p-0 col-lg-6">Pesan Tambahan</div>
                    <div class="col-lg-6 text-right p-0">
                        <input type="text" class="input" name="Tambahan" placeholder="Pesan Tambahan">
                    </div>
                </div>
            </div>
            <div class="col-md-8 text-right mt-2">
                <button class="btn btn-pesan">Kirim</button>
            </div>
        </div>
        </form>
    </div>
</div>

<?php $this->load->view('landing/footer');?>

<script>

$('#formUpdateData').on('submit',function(e){
    e.preventDefault()
    $.ajax({
        url: "pemesanan/pesan",
        method: 'POST',
        type: 'POST',
        dataType: 'json',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false
    }).done(function (data, textStatus, jqXHR){
    if(data.status){
        Swal.fire({
            title: 'Berhasil!',
            type: 'success',
            text: data.message,
            // allowOutsideClick: false,
            confirmButtonText: 'Oke',
            confirmButtonColor: '#3085d6',
        }).then((result) => {
            window.location = "pesanan";
        })
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
});
</script>
