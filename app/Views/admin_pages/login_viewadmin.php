<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webgis</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="asset/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="asset/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="asset/dist/assets/css/app.css">
    <link rel="stylesheet" href="asset/dist/assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Log in</h1>
                    <p class="auth-subtitle mb-5">TEKO (TEMU TOKO)</p>

                    <form method="POST" action="<?= base_url(); ?>/Login/login">
                    <?php if(session()-> getFlashdata('error')){ ?>
                        <div class="alert alert-danger">
                            <?php echo session()->getFlashdata('error') ?>
                        </div>
                    <?php } ?>

                    <?php if(session()-> getFlashdata('pesan')){ ?>
                        <div class="alert alert-danger">
                            <?php echo session()->getFlashdata('pesan') ?>
                        </div>
                    <?php } ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="inputUsername">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-5">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="inputPassword">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>