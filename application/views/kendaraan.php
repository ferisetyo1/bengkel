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
                    <h3>Kendaraan</h3>
                    <p class="text-subtitle text-muted">List kendaraan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kendaraan</li>
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
                        <div class="table-responsive row-12">
                            <table class="table table-hover mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Polisi</th>
                                        <th>Nama Pemilik</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>KM</th>
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

        <div class="modal fade text-left show" id="showTransaksi" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Transaksi</h4>
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
                                        <th>No. Trx</th>
                                        <th>Keterangan</th>
                                        <th>Tgl. Reservasi</th>
                                        <th>Tgl. Dibuat</th>
                                        <th>Tgl. Diupdate</th>
                                    </tr>
                                </thead>
                                <tbody id="list-transaksi">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"> Close </button>
                        <div id="tambahTransaksi"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left show" id="modalAddTransaksi" tabindex="-1" aria-labelledby="myModalLabel33" style="display: none; padding-right: 0px;" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel33">Tambah Transaksi</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="<?= base_url('transaksi/insert') ?>" method="POST" name="addTransaksi">
                        <div class="modal-body">
                            <input type="hidden" name="redirect" value="kendaraan">
                            <input type="hidden" name="id_kendaraan">
                            <input type="hidden" name="id_pelanggan">
                            <div class="input-group form-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">Reservasi</span>
                                <input type="datetime-local" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="tgl_reservasi" required>
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
        var exampleModal = document.getElementById('showTransaksi')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            console.log('helo')
            var button = event.relatedTarget
            var obj = JSON.parse(button.getAttribute('data-json'))
            console.log(obj)
            var i=1
            var bodyTable=""
            obj.forEach(element => {
                bodyTable+="<tr>"
                bodyTable+="<td>"+i+"</td>"
                bodyTable+="<td>"+element.no_trx+"</td>"
                bodyTable+="<td>"+element.keterangan+"</td>"
                bodyTable+="<td>"+element.tgl_reservasi+"</td>"
                bodyTable+="<td>"+element.created_at+"</td>"
                bodyTable+="<td>"+element.update_at+"</td>"
                bodyTable+="</tr>"
            });
            document.getElementById("list-transaksi").innerHTML=bodyTable
            var addTransaksi = document.getElementById("tambahTransaksi")
            addTransaksi.innerHTML='<button type="button" class="btn btn-primary ml-1" data-bs-toggle="modal" data-bs-target="#modalAddTransaksi" data-json='+"'"+button.getAttribute('data-json-kendaraan')+"'"+'> Tambah Transaksi </button>'
        })
        var modalAddTransaksi = document.getElementById('modalAddTransaksi')
        modalAddTransaksi.addEventListener('show.bs.modal', function(event) {
            console.log('modalAddTransaksi')
            var button = event.relatedTarget
            var obj = JSON.parse(button.getAttribute('data-json'))
            console.log(obj)
            var form = document.forms["addTransaksi"]
            form["id_kendaraan"].value=obj.id
            form["id_pelanggan"].value=obj.id_pelanggan
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
                "url": '<?= base_url() ?>kendaraan/ajaxlist',
                "type": "POST"
            }
        });
    </script>