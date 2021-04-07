<?php $this->load->view('landing/header', ['style' => 'style="background:#001970;"'] );?>
<div class="row ml-0 mr-0" style="background:#DDE3F5">
    <div class="container mt-4 mb-4">
        <div class="row ml-0 mr-0 pt-md-4">
            <div class="col-md-6 pt-md-4 pl-0">
                <h4 style="color:#4A4A4A;font-weight:bold;">Kontak Kami</h4>
                <p style="color:#636465;line-height:2;">Lorem ipsum, atau ringkasnya lipsum, adalah teks standar yang ditempatkan untuk mendemostrasikan elemen grafis atau presentasi visual seperti font, tipografi, dan tata letak.</p>
            </div>
            <div class="col-md-6 pt-md-4 mb-4 pl-0">
                <form action="#">
                    <div class="form-group">
                        <label for="inputNama">Nama</label>
                        <input type="text" class="form-control" id="inputNama" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email Address</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="inputPesan">Pesan</label>
                        <textarea class="form-control" id="inputPesan" rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-primary">POST</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('landing/footer');?>

