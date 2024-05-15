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
              <form action="Auth/forgot" method="post" style="height: 629px;">
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
                    <input type="text" name="email" class="form-control _ge_de_ol" placeholder="Enter Email">
                     <p class="text-danger"><?= isset($errors['email']) == isset($errors['email']) ? validation_show_error('email') : '' ?></p>
                  </div>

                  <button type="submit" class="form-group _btn_04">Submit</button>
                        
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>