<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?= base_url() ?>">
        <title>DAFTAR PARKIR MAHASISWA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/plugins/bootstrap/dist/css/bootstrap.min.css">
        <script src="assets/plugins/jquery/dist/jquery.min.js"></script>
        <script src="assets/plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-md bg-danger navbar-dark">
            <a class="navbar-brand" href="#">DAFTAR PARKIR MAHASISWA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url('index.php/login') ?>">Login Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container" style="margin-top: 100px;">
            <div class="row d-flex align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="card-header">Login Admin</div>
                        <div class="card-body">
                            <?php
                            print ($this->session->flashdata('status') ? $this->session->flashdata('status') : '');
                            print validation_errors();
                            ?>
                            <form action="<?= base_url('index.php/login/doLogin') ?>" method="post">
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="text" class="form-control" name="username" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-success">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </body>
</html>