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
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">Post Admin</div>
                        <div class="card-body">
                            <?php
                            print ($this->session->flashdata('status') ? $this->session->flashdata('status') : '');
                            print validation_errors();
                            ?>
                            <form action="<?= base_url('index.php/administrator/doPostAdmin') ?>" method="post">
                                <div class="form-group">
                                    <label for="postadmin">Post Admin</label>
                                    <input type="text" class="form-control" name="postadmin" id="postadmin" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
                                </div>
                                <div class="d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn btn-success">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>                
                </div>
                <?php if(count($postadmin) !== 0): ?>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="margin-top: 10px;">
                    <?php foreach($postadmin as $data): ?>
                    <div class="card mt-5">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <span>
                                <?= $this->session->userdata('username') ?>
                            </span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" onclick="return doEdit('<?= $data->id ?>');">Edit</button>
                                <button type="button" class="btn btn-danger ml-1" onclick="return doDelete('<?= $data->id ?>');">Delete</button>
                            </div>
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

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?= base_url('index.php/administrator/doEditPostAdmin') ?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="postadmin">Post Admin</label>
                        <textarea class="form-control" name="postadmin" id="postadmin" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required></textarea>
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
        $.post('<?= base_url('index.php/administrator/doGetPostAdmin') ?>', {id: id}, function(data) {
            $('#myModal').modal('show');
            $('#myModal #id').val(data.data.id);
            $('#myModal #postadmin').val(data.data.postadmin);
        });
    }

    function doDelete(id) {
        $.post('<?= base_url('index.php/administrator/doDeletePostAdmin') ?>', {id: id}, function(data) {
            if(!data.error) {
                window.location.reload();
            }
        });
    }
</script>