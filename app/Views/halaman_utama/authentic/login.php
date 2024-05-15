<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo base_url('authentication/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('authentication/assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('authentication/assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('css/style.css') ?>" rel="stylesheet">
    
    <title>TEKO (Temu Toko)</title>
  </head>
  <body>
    <section class="form-02-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="_lk_de">
              <form action="Auth/login" method="post" style="height: 629px;">
                <div class="form-03-main">
                  <a href="<?php echo base_url('/')?>" class="btn-back"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-300 -230 1000 800"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M376.6 84.5c11.3-13.6 9.5-33.8-4.1-45.1s-33.8-9.5-45.1 4.1L192 206 56.6 43.5C45.3 29.9 25.1 28.1 11.5 39.4S-3.9 70.9 7.4 84.5L150.3 256 7.4 427.5c-11.3 13.6-9.5 33.8 4.1 45.1s33.8 9.5 45.1-4.1L192 306 327.4 468.5c11.3 13.6 31.5 15.4 45.1 4.1s15.4-31.5 4.1-45.1L233.7 256 376.6 84.5z"/></svg></a>
                  <div class="logo">
                    <img src="<?php echo base_url('authentication/assets/images/user.png') ?>">
                  </div>
                  <div class="form-group">
                      <?php if(session()-> getFlashdata('pesan')){ ?>
                          <div class="alert alert-success">
                              <?php echo session()->getFlashdata('pesan') ?>
                          </div>
                      <?php } ?>
                      <?php if(session()-> getFlashdata('pesan_password')){ ?>
                          <div class="alert alert-danger">
                              <?php echo session()->getFlashdata('pesan_password') ?>
                          </div>
                      <?php } ?>
                      <?php if(session()-> getFlashdata('pesan_kosong')){ ?>
                          <div class="alert alert-danger">
                              <?php echo session()->getFlashdata('pesan_kosong') ?>
                          </div>
                      <?php } ?>
                      <?php if(session()-> getFlashdata('pesan_username')){ ?>
                          <div class="alert alert-danger">
                              <?php echo session()->getFlashdata('pesan_username') ?>
                          </div>
                      <?php } ?>
                      <?php if(session()-> getFlashdata('pesan_logout')){ ?>
                          <div class="alert alert-warning">
                              <?php echo session()->getFlashdata('pesan_logout') ?>
                          </div>
                      <?php } ?>
                      <?php if(session()-> getFlashdata('pesan_aktifasi')){ ?>
                          <div class="alert alert-danger">
                              <?php echo session()->getFlashdata('pesan_aktifasi') ?>
                          </div>
                      <?php } ?>
                      <?php if(session()-> getFlashdata('pesan_lokasi')){ ?>
                          <div class="alert alert-success">
                              <?php echo session()->getFlashdata('pesan_lokasi') ?>
                          </div>
                      <?php } ?>
                    <input type="text" name="username" class="form-control _ge_de_ol" placeholder="Enter Username">
                  </div>

                  <div class="form-group">
                    <input type="password" name="password" class="form-control _ge_de_ol" placeholder="Enter Password">
                    <span class="show-hide">
                      <i class="fa fa-eye"></i>
                    </span>
                  </div>

                  <button type="submit" class="form-group _btn_04">Submit</button>

                  <div class="text-center form-group">
                    <a>Belum Punya Akun?</a>
                    <a href="<?php echo base_url('/register')?>">Daftar</a><br/><br/>

                    <a>Lupa Password?</a>
                    <a href="<?php echo base_url('/forgot')?>">Lupa Password</a>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>

<script>
  const password = document.querySelector("input[type='password']");
  const btn_show = document.querySelector("i");
  btn_show.addEventListener("click", function(){
    if (password.type === "password") {
      password.type = "text";
      btn_show.classList.add("hide");
    } else {
      password.type = "password";
      btn_show.classList.remove("hide");
    }
  })
</script>