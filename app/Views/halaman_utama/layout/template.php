<!DOCTYPE html>
<html lang="en">
    
    <body>
        <!-- Header Start -->
        <?= $this->include('halaman_utama/layout/header'); ?>
        <!-- Header End -->

        <!-- Content Start -->
        <?= $this->renderSection('content'); ?>
        <!-- Content End -->
        
        <!-- Footer Start -->
        <?= $this->include('halaman_utama/layout/footer'); ?>

        <!-- Back to Top -->
        <!-- <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>    -->

        
    <!-- JavaScript Libraries -->
    <?= $this->include('halaman_utama/layout/javascript'); ?>
    
    </body>

</html>