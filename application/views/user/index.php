<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?= base_url() ?>">
        <title>INFO PARKIR MAHASISWA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/plugins/bootstrap/dist/css/bootstrap.min.css">
        <script src="assets/plugins/jquery/dist/jquery.min.js"></script>
        <script src="assets/plugins/popper.js/dist/umd/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-md bg-danger navbar-dark">
            <a class="navbar-brand" href="#">INFO PARKIR MAHASISWA</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                    <a class="nav-link" href="<?= base_url('index.php/login') ?>">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container" style="margin-top: " div style="text-align:center;">
        <p><div style="text-align:center;"><img src=""></div></p>
            <div class="row d-flex align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group text-center">
                                <li class="list-group-item">
                                    <a href="<?= base_url('index.php/user/input') ?>">Laporkan</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="<?= base_url('index.php/user/output') ?>">Data yang terlapor</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="<?= base_url('index.php/user/postadmin') ?>">Berita Terkini</a>
                                </li>
                            </ul>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </body>
</html>