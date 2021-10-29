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
                    <h3>Tambah barang</h3>
                    <p class="text-subtitle text-muted">Tambahkan barang pada paketan</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4>List Keranjang</h4>
                        <form action="<?= base_url('paket/simpanbarang') ?>" method="POST">
                            <input type="hidden" name="id_paket" value="<?= $data->id ?>">
                            <div class="table-responsive row-12">
                                <table class="table table-hover mb-0" id="table2">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Kode Barang</th>
                                            <th>Nama</th>
                                            <th>Harga Jual</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cart">
                                        <?php
                                        foreach ($barang as $key => $value) {
                                            $date = date_create();
                                            $time = date_timestamp_get($date);
                                        ?>
                                            <tr id="rowcart<?= $time ?>">
                                                <td><button class='btn btn-danger rounded-pill' onclick='removecart("rowcart<?= $time ?>")'>hapus</button></td>
                                                <td><?= $value->kode_item ?></td>
                                                <td><?= $value->nama ?> </td>
                                                <td><input type='hidden' name='id[]' value='<?=$value->id_barang?>'><input class='form-control' type='number' name='harga[]' value='<?= $value->harga ?>'></td>
                                                <td><input class='form-control' type='number' name='jumlah[]' value='<?= $value->jumlah ?>'></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary float-end ">Simpan Barang</button>
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4>List Barang</h4>
                        <div class="table-responsive row-12">
                            <table class="table table-hover mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Action</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Rak</th>
                                        <th>Jenis</th>
                                        <th>Satuan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function addtocart(params) {
            var date = new Date()
            $("#cart").append("<tr id='rowcart" + date.getTime() + "'>" +
                "<td><button class='btn btn-danger rounded-pill' onclick='removecart(\"rowcart" + date.getTime() + "\")'>hapus</button></td>" +
                "<td>" + params.kode_item + "</td>" +
                "<td>" + params.nama + "</td>" +
                "<td><input type='hidden' name='id[]' value='" + params.id + "'><input class='form-control' type='number' name='harga[]' value='" + params.harga + "'></td>" +
                "<td><input class='form-control' type='number' name='jumlah[]' value='1'></td>" +
                "</tr>")
        }

        function removecart(id) {
            $("#" + id).remove()
        }

        $("#table1").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?= base_url() ?>barang/ajaxlist_keranjang',
                "type": "POST"
            }
        });
    </script>