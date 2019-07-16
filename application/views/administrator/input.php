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
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('index.php/administrator') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('index.php/administrator/input') ?>">laporkan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('index.php/administrator/output') ?>">data yang terlapor</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url('index.php/administrator/postadmin') ?>">berita terkini</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                            <?= $this->session->userdata('username') ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= base_url('index.php/administrator/doLogout') ?>">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container" style="margin-top: 100px;">
            <div class="row d-flex align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="card-header">INPUT DATA</div>
                        <div class="card-body">
                            <?php
                            print ($this->session->flashdata('status') ? $this->session->flashdata('status') : '');
                            print validation_errors();
                            ?>
                            <form action="<?= base_url('index.php/administrator/doInput') ?>" method="post">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                                </div>
                                <div class="form-group">
                                    <label for="Keterangan">Keterangan</label>
                                    <input type="text" class="form-control" name="Keterangan" id="Keterangan" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-success">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </body>
</html>