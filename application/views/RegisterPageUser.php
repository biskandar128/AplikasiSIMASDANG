<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Login</title>
    <link rel="icon" href="<?= base_url('asset/Frontend/img/logo_icon.ico'); ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('asset/sweetalert2/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('asset/Login&Register/style.css'); ?>">
</head>

<body>


    <section class="section-register">
        <div class="row">
            <div class="col-xl-6">
                <img src="<?= base_url('asset/Login&Register/Background.png'); ?>" class="d-none d-sm-none d-md-none d-lg-none d-xl-block" alt="">
            </div>
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-mobile col-tab">
                <h4 class="text-center mt-4 d-block d-sm-block d-md-block d-xl-none text-white title-header">Sambel Gendang</h4>
                <h4 class="text-center mt-4 d-none d-sm-none d-md-none d-xl-block title-header">Sambel Gendang</h4>

                <div class="form-login text-center">
                    <div class="parent d-flex justify-content-center align-items-center" style="height: 83vh;">
                        <div class="child">
                            <form action="<?= base_url('user/register/process'); ?>" enctype="multipart/form-data" method="post">
                                <h5>Welcome!</h5>
                                <h6 class="mt-1">Sign up by entering the information below</h6>
                                
                                <?php
                                if ($this->session->flashdata('error') != '') :
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $this->session->flashdata('error');
                                    echo '</div>';
                                endif;
                                ?>
                                <div class="form-group mt-3">
                                    <input type="text " class="form-control" id="nama" placeholder="Nama" name="account_name" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="nomor_telp" name="nomor_telp" placeholder="Nomor">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">                                    
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">                                    
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="account_img" class="custom-file-input" id="choosePhoto" required>
                                    <label class="custom-file-label text-left" for="choosePhoto">Choose photo...</label>
                                </div>
                                <button type="submit" class="btn btn-register" id="btnRegister">REGISTER</button>
                                <p class="mt-2"><a href="<?= base_url('user/login'); ?>">Do you have an account? Sign in.</a></p>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Desktop -->
                <footer class="text-center">
                    <p class="text-black d-none d-sm-none d-md-none d-xl-block">&copy;2020 CV. Sambel Gendang</p>
                    <p class="text-white d-block d-sm-block d-md-block d-xl-none">&copy;2020 CV. Sambel Gendang</p>
                </footer>
            </div>
        </div>
    </section>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js " integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin=" anonymous "></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js " integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx " crossorigin="anonymous "></script>
<script src="<?= base_url('asset/sweetalert2/sweetalert2.min.js'); ?>"></script>
<script>
    const btnRegister = document.getElementById('btnRegister');

    const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message} tidak boleh kosong!`,
			});
		};

    btnRegister.addEventListener('click', function(e){
      if (document.getElementById('nama').value == '') {
        e.preventDefault();
        sweetAlert('Nama anda');
      } else if (document.getElementById('nomor_telp').value == '') {
        e.preventDefault();
        sweetAlert('Nomor Telepon anda');
      }else if (document.getElementById('username').value == '') {
        e.preventDefault();
        sweetAlert('Username')
      } else if (document.getElementById('email').value == '') {
        e.preventDefault();
        sweetAlert('Email anda');
      } else if (document.getElementById('password').value == '') {
        e.preventDefault();
        sweetAlert('Password');
      }  else if (document.getElementById('choosePhoto').value == '') {
        e.preventDefault();
        sweetAlert('Photo anda');
      }
    });
</script>
</html>