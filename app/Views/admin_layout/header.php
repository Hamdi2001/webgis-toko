<header class="p-3 mb-3 border-bottom">
   
      <div class="d-flex flex-wrap align-items-center justify-content-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo base_url('img/admin.png')  ?>" alt="mdo" width="32" height="32" class="rounded-circle d-inline">
            <p class="p-2 d-inline"><?= session()->get('nama_admin') ?></p>
          </a>
          <ul class="dropdown-menu text-small">
            <?php  if (session()->get('level') == '2'){?>
            <li><a class="dropdown-item" href="<?php echo base_url('/Toko/editProfilAdmin/'.session()->get('user_id'))?>"><i class="fas fa-cog"></i> Setting</a></li>
            <?php  }else?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo base_url('Login/logout')  ?>"><i class="fas fa-sign-out-alt"></i> Sign out</a></li>
          </ul>
      </div>
    
    </header>