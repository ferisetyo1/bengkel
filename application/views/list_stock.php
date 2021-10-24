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
                    <h3>Stock</h3>
                    <p class="text-subtitle text-muted">Riwayat stock masuk dan keluar</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Stock</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section>
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-outline-primary block float-end" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        Tambah Jenis
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('msg') ?></div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('msg_error')) { ?>
                            <div class="alert alert-danger"><?= $this->session->flashdata('msg_error') ?></div>
                        <?php }
                        unset($_SESSION['msg_error'], $_SESSION['msg']); ?>
                        <div class="table-responsive row-12">
                            <table class="table table-hover mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Invoice</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tipe</th>
                                        <th>Keterangan</th>
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
        <!-- Hoverable rows end -->

        <div class="modal fade text-left show" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Tambah Stock</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="<?= base_url('stock/insert') ?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group" >
                                <!-- <label class="" for="inputGroupSelect01">Barang</label> -->
                                <select id="inputGroupSelect01" name="barang_id" class="choices form-select" >
                                    <?php foreach ($this->dbhelper->read(TableBarang) as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Jumlah</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="jumlah">
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
                "url": '<?= base_url() ?>stock/ajaxlist',
                "type": "POST"
            }
        });
    </script>