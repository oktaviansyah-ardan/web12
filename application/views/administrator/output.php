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
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                    <div class="card-header">OUTPUT DATA</div>


                           
                        <div class="card-body">
                            <?php
                            print ($this->session->flashdata('status') ? $this->session->flashdata('status') : '');
                            print validation_errors();
                            ?>
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Keterangan</th>
                                        <th class="text-center" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($input as $data): ?>
                                    <tr>
                                        <td><?= $data->id ?></td>
                                        <td><?= $data->nama ?></td>
                                        <td><?= $data->alamat ?></td>
                                        <td><?= $data->keterangan ?></td>
                                        <td class="text-center" width="10%">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary" onclick="return doEdit('<?= $data->id ?>');">Edit</button>
                                                <button type="button" class="btn btn-danger ml-1" onclick="return doDelete('<?= $data->id ?>');">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div>
            </div>
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

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?= base_url('index.php/administrator/doEditInput') ?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success ml-1">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function doEdit(id) {
        $.post('<?= base_url('index.php/administrator/doGetInput') ?>', {id: id}, function(data) {
            $('#myModal').modal('show');
            $('#myModal #id').val(data.data.id);
            $('#myModal #nama').val(data.data.nama);
            $('#myModal #alamat').val(data.data.alamat);
            $('#myModal #keterangan').val(data.data.keterangan);
        });
    }

    function doDelete(id) {
        $.post('<?= base_url('index.php/administrator/doDeleteInput') ?>', {id: id}, function(data) {
            if(!data.error) {
                window.location.reload();
            }
        });
    }
</script>