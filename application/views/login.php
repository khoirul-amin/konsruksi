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
                    <img src="<?=base_url();?>assets/img/brand/Login.svg" class="mt-4" style="width:150px;" alt="login-image"/><br/>

                    <a href="register" class="rounded-pill btn btn-warning text-white mt-4 mb-4">Sign Up</a>
                </div>
                <div class="col-md-6 rounded-right login-form text-center p-4">
                    <p class="login-title">Login</p>
                    <form action="" id="form-insert" class="form-login">
                        <input type="text" name="username" placeholder="Username"/> <br/>
                        <input type="Password" name="password" placeholder="Password"/> <br/>
                        <div class="row ml-0 mr-0 p-3">
                            <div class="col pt-2">
                                <a class="forgot" href="#">Forgrt Password?</a>
                            </div>
                            <div class="col text-right">
                                <button type="submit" class="rounded-pill text-white btn-login">Login</button>
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
            url : "login/login",
            dataType: 'json',
            data: new FormData($('#form-insert')[0]),
            contentType: false,
            processData: false,
            cache: false,
            // async: false,
            success: function(data){
                if(data.status){
                    Swal.fire({
                        title: 'Berhasil!',
                        type: 'success',
                        text: data.message,
                        // allowOutsideClick: false,
                        confirmButtonText: 'Oke',
                        confirmButtonColor: '#3085d6',
                    }).then((result) => {
                        window.location.reload();
                    })
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
