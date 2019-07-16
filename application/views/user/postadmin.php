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
                        <a class="nav-link" href="<?= base_url('index.php/user') ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('index.php/user/input') ?>">Laporkan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= base_url('index.php/user/output') ?>">Data yang terlapor</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= base_url('index.php/user/postadmin') ?>">Berita terkini</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">


                    </li>
                </ul>
            </div>
        </nav>
        <div class="container" style="margin-top: 100px;">
            <div class="row d-flex align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
               
                </div>
                <?php if(count($postadmin) !== 0): ?>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top: 10px;">
                    <?php foreach($postadmin as $data): ?>
                    <div class="card mt-5">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <span>
                               
                            </span>

                        </div>
                        <div class="card-body">
                            <?= $data->status ?>
                        </div>
                        <div class="card-footer">
                            <?= date('d-m-Y H:i:s', strtotime($data->created_at)) ?>
                        </div>
                    </div>           
                    <?php endforeach; ?>     
                </div>
                <?php endif; ?>
            </div>
            <br />
            <br />
        </div>
    </body>
</html>

<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

        </div>
    </div>
</div>
