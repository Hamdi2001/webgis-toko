<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mazer/dist/assets/css/bootstrap.css">

    <link rel="stylesheet" href="mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="mazer/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="mazer/dist/assets/css/app.css">
    <link rel="shortcut icon" href="mazer/dist/assets/images/favicon.svg" type="image/x-icon">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div id="app">
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <?= $this->include('admin_layout/sidebar'); ?>

            <?= $this->renderSection('content'); ?>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="mazer/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="mazer/dist/assets/js/bootstrap.bundle.min.js"></script>

    <script src="mazer/dist/assets/js/main.js"></script>
</body>

</html>