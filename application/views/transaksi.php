<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Transaksi</h3>
                    <p class="text-subtitle text-muted">List Transaksi</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Jenis</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('msg') ?></div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('msg_error')) { ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('msg_error') ?></div>
                        <?php }
                        unset($_SESSION['msg_error'], $_SESSION['msg']); ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>No. Trx</th>
                                        <th>Pelanggan</th>
                                        <th>Nopol</th>
                                        <th>Tgl. Reservasi</th>
                                        <th>Tgl. Dibuat</th>
                                        <th>Tgl. Diupdate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade text-left show" id="inlineForm-edit" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Satuan</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="<?= base_url('pelanggan/edit') ?>" method="POST" name="edit-form">
                        <div class="modal-body">
                            <input type="hidden" name="id">
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nama">
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">No HP</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nohp">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Alamat</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="alamat">
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="margin-top: 0px; margin-bottom: 0px; height: 82px;" name="keterangan"></textarea>
                                <label for="floatingTextarea">Keterangan</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> Close </button>
                            <button type="Sumbit" class="btn btn-primary ml-1"> Simpan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#table1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?= base_url() ?>transaksi/ajaxlist',
                "type": "POST"
            }
        });
    </script>