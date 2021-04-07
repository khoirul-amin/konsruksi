<?php $this->load->view('landing/header', ['style' => 'style="background:#001970;"'] );?>
<!-- <div class="w-100 fixed-top" style="background:#001970 0% 0% no-repeat padding-box">
    head
</div> -->
<div class="container mt-4 mb-4">
    <div class="row justify-content-md-center pt-4 pb-4">
        <div class="col col-lg-8 p-0">
            <div class="row ml-0 mr-0 justify-content-center">
                <div class="col-md-4 d-none d-md-block text-center rounded-left" style="background:#001970;color:#9FA8DA;">
                    <p class="welcome mt-4">Welcome</p>
                    <span style="font-weight:bold;">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</span"><br>
                    <img src="<?=base_url()?>assets/img/brand/Register.svg" class="mt-4" style="width:150px;" alt="login-image"/><br/>

                    <a href="login" class="rounded-pill btn btn-warning text-white mt-4 mb-4">Sign In</a>
                </div>
                <div class="col-md-6 rounded-right login-form text-center p-4">
                    <p class="login-title">Register</p>
                    <form action="/register/register" id="form-insert" class="form-login1">
                        <input type="text" name="full-name" placeholder="Nama Lengkap" required/> <br/>
                        <input type="text" name="no-ktp" placeholder="No. KTP" required/> <br/>
                        <input type="text" name="alamat" placeholder="Alamat" required/> <br/>
                        <input type="text" name="no-hp" placeholder="No. HP" required/> <br/>
                        <input type="email" name="email" placeholder="Email" required/> <br/>
                        <input type="text" name="username" placeholder="Username" required/> <br/>
                        <input type="password" name="password" placeholder="Password" required/> <br/>
                        <input type="password" name="re-password" placeholder="Re-Password" required/> <br/>
                        <div class="row ml-0 mr-0 pr-4">
                            <div class="col-sm-12 text-right">
                                <button type="submit" class="rounded-pill text-white btn-login">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('landing/footer');?>
<script>
    $('#form-insert').on('submit',function(e){
        e.preventDefault()
        $.ajax({
            method : "POST",
            url : "register/register",
            dataType: 'json',
            data: new FormData($('#form-insert')[0]),
            contentType: false,
            processData: false,
            cache: false,
            // async: false,
            success: function(data){
                if(data.status){
                    Swal.fire(
                        'Berhasil!',
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
            }
        })
    }); 
</script>

