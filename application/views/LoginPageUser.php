<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Panel Login</title>
        <link rel="icon" href="<?= base_url('asset/Frontend/img/logo_icon.ico'); ?>" />
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
			integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
			integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
			crossorigin="anonymous"
		/>
    	<link rel="stylesheet" href="<?= base_url('asset/sweetalert2/sweetalert2.min.css'); ?>">
		<link rel="stylesheet" href="<?= base_url('asset/Login&Register/style.css'); ?>" />
	</head>

	<body>
		<section class="section-login">
			<div class="row">
				<div class="col-xl-6">
					<img
						src="<?= base_url('asset/Login&Register/Background.png'); ?>"
						class="d-none d-sm-none d-md-none d-lg-none d-xl-block"
						alt=""
					/>
				</div>
				<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-mobile col-tab">
					<h4
						class="
							text-center
							mt-4
							d-block d-sm-block d-md-block d-xl-none
							text-white
							title-header
						"
					>
						Sambel Gendang
					</h4>
					<h4
						class="
							text-center
							mt-4
							d-none d-sm-none d-md-none d-xl-block
							title-header
						"
					>
						Sambel Gendang
					</h4>

					<div class="form-login text-center">
						<div
							class="parent d-flex justify-content-center align-items-center"
							style="height: 80vh"
						>
							<div class="child">
								<?php if ($this->session->flashdata('success_register') != '') :

                                        echo '<div class="alert alert-success" role="alert">';
                                        echo $this->session->flashdata('success_register');
                                        echo '</div>';

                                    endif; ?>
									
								<?php if ($this->session->flashdata('error') != '') : ?>
                                     <div class="alert alert-danger alert-dismissible" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
										<strong>Gagal!</strong> <?= $this->session->flashdata('error'); ?>
									</div> 
                                <?php endif; ?>

								<form action="<?= base_url('user/login/proses'); ?>" method="post" id="formLogin">
									<h4>Welcome!</h4>
									<h5 class="mt-3">
										Sign in by entering the information below
									</h5>
									<div class="form-group mt-5">
										<input
											type="text"
											class="form-control"
											name = 'username'
											placeholder="Username"
											id="username"
											autofocus
										/>
									</div>
									<div class="form-group">
										<input
											id="password"
											type="password"
											class="form-control"
											name="password"
											placeholder="Password"
										/>
										<span
											toggle="#password-field"
											class="fa fa-fw fa-eye field-icon toggle-password"
										></span>
									</div>
									<div class="row">
										<!-- Desktop -->
										<!-- <div class="col-md-12 col-sm-12 d-none d-md-block d-sm-block">
											<a href="# " class="float-right">Forgot password?</a>
										</div> -->

										<!-- Mobile -->
										<!-- <div class="col-12 d-block d-md-none d-sm-none mt-2">
											<a href="#" class="float-left">Forgot password?</a>
										</div> -->
									</div>
									<button type="submit" class="btn btn-login" id="btnLogin">LOGIN</button>
									<p class="mt-2">
										<a href="<?= base_url('user/register'); ?>"
											>Don't have account? Create one here.</a
										>
									</p>
								</form>
							</div>
						</div>
					</div>

					<!-- Desktop -->
					<footer class="text-center">
						<p class="text-black d-none d-sm-none d-md-none d-xl-block">
							&copy;2021 CV. SIMASDANG 
						</p>
						<p class="text-white d-block d-sm-block d-md-block d-xl-none">
							&copy;2021 CV. SIMASDANG 
						</p>
					</footer>
				</div>
			</div>
		</section>

		<!-- <div class="parent d-flex justify-content-center align-items-center bg-primary" style="height: 100vh;">
        <div class="child">
            <h1>Hello world!</h1>
        </div>
    </div> -->
	</body>

	<script
		src="https://code.jquery.com/jquery-3.5.1.min.js "
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
		crossorigin=" anonymous "
	></script>
	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js "
		integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx "
		crossorigin="anonymous "
	></script>
    <script src="<?= base_url('asset/sweetalert2/sweetalert2.min.js'); ?>"></script>
	<script>
		$(".toggle-password").click(function () {
			console.log(this);
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));
			if ($('#password').attr("type") == "password") {
				$('#password').attr("type", "text");
				console.log($('#password').attr("type"), true);
			} else {
				$('#password').attr("type", "password");
				console.log($('#password').attr("type"));
			}
		});

		const btnLogin = document.getElementById('btnLogin');

		const sweetAlert = function (message) {
			Swal.fire({
				icon: "error",
				title: "Ooops...",
				text: `${message}`,
			});
		};

		const username = document.getElementById('username');
		const pass = document.getElementById('password');

		btnLogin.addEventListener('click', function(e){				
			e.preventDefault();

			if (username.value == '') {
				e.preventDefault();
				sweetAlert('Username tidak boleh kosong!')
			} else if (pass.value == '') {
				e.preventDefault();
				sweetAlert('Password tidak boleh kosong!');
			} else {
				const urlValidate = `http://localhost:8080/simasdang/user/validate_login/${username.value}/${pass.value}`;

				const loginValidate = async function() {
					try {
						const data = await fetch(urlValidate);
						const dataValid = await data.json();

						if (!dataValid) {			
							sweetAlert('Username atau Password tidak sesuai');
						} else {
							document.getElementById('formLogin').submit();
						}
					} catch (error) {
						console.log(error);
					}
				}
				
				loginValidate();
			}			

		});
	</script>
</html>
