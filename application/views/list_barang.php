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
                    <h3>Barang</h3>
                    <p class="text-subtitle text-muted">List barang</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section>
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-outline-primary block float-end" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        Tambah Barang
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
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah</th>
                                        <th>Rak</th>
                                        <th>Jenis</th>
                                        <th>Satuan</th>
                                        <th>Status</th>
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
                        <h4 class="modal-title" id="myModalLabel33">Tambah Barang</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="<?= base_url('barang/insert') ?>" method="POST">
                        <div class="modal-body">
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Kode</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="kode_item" placeholder="Kode barang" required>
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nama" placeholder="Nama barang" required>
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Harga Jual</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="harga" placeholder="Harga Jual" required>
                            </div>

                            <div class="input-group form-group">
                                <label class="input-group-text" for="inputGroupSelect01">Rak</label>
                                <select class="form-select" id="inputGroupSelect01" name="rak_id">
                                    <?php foreach ($rak as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group form-group">
                                <label class="input-group-text" for="inputGroupSelect01">Jenis</label>
                                <select class="form-select" id="inputGroupSelect01" name="jenis_id">
                                    <?php foreach ($jenis as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group form-group">
                                <label class="input-group-text" for="inputGroupSelect01">Satuan</label>
                                <select class="form-select" id="inputGroupSelect01" name="uoms_id">
                                    <?php foreach ($uoms as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-check form-group">
                                <div class="checkbox">
                                    <input type="checkbox" id="checkbox1" class="form-check-input" checked="" name="status">
                                    <label for="checkbox1">Barang masih dijual?</label>
                                </div>
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
        <div class="modal fade text-left show" id="inlineForm-edit" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Barang</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="<?= base_url('barang/edit') ?>" method="POST" name="edit_form">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="input_id">
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Kode</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="kode_item" placeholder="Kode barang" required>
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nama" placeholder="Nama barang" required>
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Harga Jual</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="harga" placeholder="Harga Jual" required>
                            </div>

                            <div class="input-group form-group">
                                <label class="input-group-text" for="inputGroupSelect01">Rak</label>
                                <select class="form-select" id="inputGroupSelect01" name="rak_id">
                                    <?php foreach ($rak as $key => $value) { ?>
                                        <option value="<?= $value->id ?>" id="rak<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group form-group">
                                <label class="input-group-text" for="inputGroupSelect01">Jenis</label>
                                <select class="form-select" id="inputGroupSelect01" name="jenis_id">
                                    <?php foreach ($jenis as $key => $value) { ?>
                                        <option value="<?= $value->id ?>" id="jenis<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="input-group form-group">
                                <label class="input-group-text" for="inputGroupSelect01">Satuan</label>
                                <select class="form-select" id="inputGroupSelect01" name="uoms_id">
                                    <?php foreach ($uoms as $key => $value) { ?>
                                        <option value="<?= $value->id ?>" id="uoms<?= $value->id ?>"><?= $value->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-check form-group">
                                <div class="checkbox">
                                    <input type="checkbox" id="checkbox1" class="form-check-input" checked="" name="status">
                                    <label for="checkbox1">Barang masih dijual?</label>
                                </div>
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="margin-top: 0px; margin-bottom: 0px; height: 82px;" name="keterangan"></textarea>
                                <label for="floatingTextarea">Keterangan</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> Close </button>
                            <button type="submit" class="btn btn-primary"> Simpan </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade text-left show" id="modal-stock" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Edit Barang</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Action</th>
                                        <th>Invoice</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Tipe</th>
                                        <th>Keterangan</th>
                                        <th>Tgl. Dibuat</th>
                                        <th>Tgl. Diupdate</th>
                                    </tr>
                                </thead>
                                <tbody id="body-modal-stock">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> Close </button>
                        <button type="Sumbit" class="btn btn-primary ml-1"> Simpan </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var exampleModal = document.getElementById('inlineForm-edit')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var obj = JSON.parse(button.getAttribute('data-json'))
            var input_id = document.getElementById('edit_form')
            var form = document.forms['edit_form']
            form["id"].value = obj.id
            form["nama"].value = obj.nama
            form["kode_item"].value = obj.kode_item
            form["harga"].value = obj.harga
            form["rak_id"].value = obj.rak_id
            form["jenis_id"].value = obj.jenis_id
            form["uoms_id"].value = obj.uoms_id
            form["status"].checked = obj.status == "" ? false : true
            form["keterangan"].value = obj.keterangan
        })
        var modal_stock = document.getElementById('modal-stock')

        modal_stock.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var obj = JSON.parse(button.getAttribute('data-json'))
            var tbody = document.getElementById('body-modal-stock')
            tbody.innerHTML = ''
            var i = 1
            obj.forEach(element => {
                var row = tbody.insertRow()
                var cell = row.insertCell()
                var newText = document.createTextNode(i);
                cell.appendChild(newText)
                var cell = row.insertCell()
                cell.innerHTML = '<a type="button" href="<?= base_url("stock/delete/$value->id") ?>" class="btn btn-danger rounded-pill">Hapus</a>'
                var cell = row.insertCell()
                var newText = document.createTextNode(element.invoice);
                cell.appendChild(newText)
                var cell = row.insertCell()
                var newText = document.createTextNode(element.nama);
                cell.appendChild(newText)
                var cell = row.insertCell()
                var newText = document.createTextNode(element.jumlah);
                cell.appendChild(newText)
                var cell = row.insertCell()
                var newText = document.createTextNode(element.type == "in" ? "Barang Masuk" : "Barang Keluar");
                cell.appendChild(newText)
                var cell = row.insertCell()
                var newText = document.createTextNode(element.keterangan);
                cell.appendChild(newText)
                var cell = row.insertCell()
                var newText = document.createTextNode(element.create_at);
                cell.appendChild(newText)
                var cell = row.insertCell()
                var newText = document.createTextNode(element.update_at);
                cell.appendChild(newText)
                
                i++
            });
        })

        $("#table1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?= base_url() ?>barang/ajaxlist',
                "type": "POST"
            }
        });
    </script>