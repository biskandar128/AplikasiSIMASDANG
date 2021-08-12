<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login Sistem</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="<?= base_url('asset/Frontend/img/logo_icon.ico'); ?>" />

    <link
      href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    
    <link rel="stylesheet" href="<?= base_url('asset/sweetalert2/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('asset/Login&Register/styleLoginSystem.css'); ?>" />
  </head>
  <body>
    <section class="ftco-section">
      <div class="container">
        <div
          class="row justify-content-center align-content-center"
          style="height: 100vh"
        >
          <div class="col-md-8 col-lg-6">
            <div class="wrap">
              <div
                class="img"
              ></div>
              <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                  <div class="w-100">
                    <h3 class="mb-4">Login Sistem</h3>
                  </div>
                </div>
                <form action="<?= base_url('sistem/login'); ?>" method="post" class="signin-form" id="formLogin">
                  <div class="form-group mt-3">
                    <input type="text" class="form-control" id="username" name="username" autofocus required />
                    <label class="form-control-placeholder"  for="username"
                      >Username</label
                    >
                  </div>
                  <div class="form-group">
                    <input
                      id="password"
                      type="password"
                       name="password"
                      class="form-control"
                      required
                    />
                    <label class="form-control-placeholder" for="password"
                      >Password</label
                    >
                    <span
                      toggle="#password-field"
                      class="fa fa-fw fa-eye field-icon toggle-password"
                    ></span>
                  </div>
                  <div class="form-group">
                    <button
                      type="submit"
                      class="form-control btn btn-primary rounded submit px-3"
                      id="btnLogin"
                    >
                      Login
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));
			if ($('#password').attr("type") == "password") {
				$('#password').attr("type", "text");
			} else {
				$('#password').attr("type", "password");
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
				const urlValidate = `http://localhost:8080/simasdang/sistem/validate_login/${username.value}/${pass.value}`;

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
  </body>
</html>
