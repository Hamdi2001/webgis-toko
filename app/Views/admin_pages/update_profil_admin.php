<?= $this->extend('admin_layout/template'); ?>

<?= $this->section('content'); ?>
 <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Horizontal Form with Icons</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="/Toko/updateProfilAdmin/<?= $admin['id']; ?>" method="POST" class="form form-horizontal" >
                                            <?php $errors = validation_errors() ?>
                                            <input type="hidden" name="id" value="<?= $admin['id']; ?>">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Name</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" name="nama_admin"
                                                                    placeholder="Name" id="first-name-icon" value="<?= (old('nama_admin')) ? old('nama_admin') : $admin['nama_admin'] ?>">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-person"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="text-danger"><?= isset($errors['nama_admin']) == isset($errors['nama_admin']) ? validation_show_error('nama_admin') : '' ?></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Username</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" name="username_admin"
                                                                    placeholder="Username" value="<?= (old('username_admin')) ? old('username_admin') : $admin['username_admin'] ?>">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-phone"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <p class="text-danger"><?= isset($errors['username_admin']) == isset($errors['username_admin']) ? validation_show_error('username_admin') : '' ?></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Password</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group has-icon-left">
                                                            <div class="position-relative">
                                                                <input type="text" class="form-control" name="password_admin"
                                                                    placeholder="Password" value="<?= (old('password_admin')) ? old('password_admin') : $admin['password_admin'] ?>">
                                                                <div class="form-control-icon">
                                                                    <i class="bi bi-lock"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="text-danger"><?= isset($errors['password_admin']) == isset($errors['password_admin']) ? validation_show_error('password_admin') : '' ?></p>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                <!-- // Basic Horizontal form layout section end --
<?= $this->endSection(); ?>