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
                    <h3>Jenis</h3>
                    <p class="text-subtitle text-muted">List jenis yang akan tampil saat menambahkan barang</p>
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
                <div class="card-header">
                    <button type="button" class="btn btn-outline-primary block float-end" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        Tambah Pelanggan
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
                                        <th>Nama</th>
                                        <th>No. HP</th>
                                        <th>Alamat</th>
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
                        <h4 class="modal-title" id="myModalLabel33">Tambah Jenis</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="<?= base_url('pelanggan/insert') ?>" method="POST">
                        <div class="modal-body">
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nama</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nama" required>
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">No HP</span>
                                <input type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nohp" required>
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Alamat</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="alamat" required>
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
        <div class="modal fade text-left show" id="showkendaraan" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Kendaraan</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive row-12">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Polisi</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>KM</th>
                                        <th>Keterangan</th>
                                        <th>Tgl. Dibuat</th>
                                        <th>Tgl. Diupdate</th>
                                    </tr>
                                </thead>
                                <tbody id="list-kendaraan">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> Close </button>
                        <div id="tambah_kendaraan_parent"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade text-left show" id="tambah-kendaraan" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Tambah Kendaraan</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="<?= base_url('kendaraan/insert') ?>" method="POST" name="tambah-kendaraan">
                        <div class="modal-body">
                            <input type="hidden" name="id_pelanggan">
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Nomor Polisi</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="nopol">
                            </div>
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Merk</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="merk">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Tipe</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="tipe">
                            </div>

                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">KM</span>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="km">
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
        var exampleModal = document.getElementById('inlineForm-edit')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            console.log('helo')
            var button = event.relatedTarget
            var obj = JSON.parse(button.getAttribute('data-json'))
            console.log(obj)
            var form = document.forms["edit-form"]
            form["id"].value = obj.id
            form["nama"].value = obj.nama
            form["alamat"].value = obj.alamat
            form["nohp"].value = obj.nohp
            form["keterangan"].value = obj.keterangan
        })
        var showkendaraam = document.getElementById('showkendaraan')
        showkendaraam.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var arr = JSON.parse(button.getAttribute('data-json-kendaraan'))
            var pelanggan = JSON.parse(button.getAttribute('data-pelanggan'))
            console.log(pelanggan)
            var addbtn = document.getElementById('tambah_kendaraan_parent')
            addbtn.innerHTML = '<button type="button" class="btn btn-primary" data-id-pelanggan="' + pelanggan.id + '" data-bs-toggle="modal" data-bs-target="#tambah-kendaraan">Tambah</button>'
            var listkendaran = document.getElementById('list-kendaraan')
            var i = 1
            arr.forEach(element => {
                listkendaran.innerHTML = "<tr>" +
                    "<td>" + i + "</td>" +
                    "<td>" + element.nopol + "</td>" +
                    "<td>" + element.merk + "</td>" +
                    "<td>" + element.tipe + "</td>" +
                    "<td>" + element.km + "</td>" +
                    "<td>" + element.keterangan + "</td>" +
                    "<td>" + element.create_at + "</td>" +
                    "<td>" + element.update_at + "</td>" +
                    "</tr>"
                i++
            });
        })
        var tambahKendaraan = document.getElementById('tambah-kendaraan')
        tambahKendaraan.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id-Pelanggan')
            console.log("id=" + id)
            var form = document.forms["tambah-kendaraan"]
            form["id_pelanggan"].value = id
            console.log(form["id_pelanggan"].value)
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
                "url": '<?= base_url() ?>pelanggan/ajaxlist',
                "type": "POST"
            }
        });
    </script>