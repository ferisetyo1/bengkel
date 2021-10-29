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
                    <p class="text-subtitle text-muted">Tambahkan barang pada transaksi code : <?= $data->no_trx ?></p>
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
    </div>
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4>List Keranjang</h4>
                    <h3 id="total_bayar">Total Bayar : Rp0</h3>
                    <form action="<?= base_url('transaksi/simpanbarang') ?>" method="POST" name="form-cart">
                        <input type="hidden" name="id_transaksi" value="<?= $data->id ?>">
                        <div class="table-responsive row-12">
                            <table class="table table-hover mb-0" id="table2">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="cart">
                                    <?php
                                    foreach ($barang as $key => $value) {
                                        $date = date_create();
                                        $time = date_timestamp_get($date);
                                    ?>
                                        <tr id="rowcart<?= $time ?>">
                                            <td><button type="button" class='btn btn-danger rounded-pill' onclick='removecart("rowcart<?= $time ?>")'>hapus</button></td>
                                            <td><?= $value->kode_item ?></td>
                                            <td><?= $value->nama ?> </td>
                                            <td><input type='hidden' name='id[]' value='<?= $value->id_barang ?>'><input min="0" oninput='hitungTotalHarga()' class='form-control' type='number' name='harga[]' value='<?= $value->harga_jual ?>'></td>
                                            <td><input min="0" class='form-control' oninput='hitungTotalHarga()' type='number' name='jumlah[]' value='<?= $value->jumlah ?>'></td>
                                            <td><textarea class='form-control' name='keterangan[]' cols='30' rows='1'><?= $value->keterangan ?></textarea></td>
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
                    <h4>List Paket</h4>
                    <?php if ($this->session->flashdata('msg')) { ?>
                        <div class="alert alert-success"><?= $this->session->flashdata('msg') ?></div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('msg_error')) { ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('msg_error') ?></div>
                    <?php }
                    unset($_SESSION['msg_error'], $_SESSION['msg']); ?>
                    <div class="table-responsive row-12">
                        <table class="table table-hover mb-0" id="table3">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Action</th>
                                    <th style="width:80%">Nama</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h4>List Barang</h4>
                    <div class="table-responsive">
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


    <script>
        function addtocart(params) {
            var date = new Date()
            $("#cart").append("<tr id='rowcart" + date.getTime() + "'>" +
                "<td><button type='button' class='btn  btn-danger rounded-pill' onclick='removecart(\"rowcart" + date.getTime() + "\")'>hapus</button></td>" +
                "<td>" + params.kode_item + "</td>" +
                "<td>" + params.nama + "</td>" +
                "<td><input type='hidden' name='id[]' value='" + params.id + "'><input oninput='hitungTotalHarga()' min='0' class='form-control' type='number' name='harga[]' value='" + params.harga + "'></td>" +
                "<td><input min='0' oninput='hitungTotalHarga()' class='form-control' type='number' name='jumlah[]' value='1'></td>" +
                "<td><textarea class='form-control' name='keterangan[]'  cols='30' rows='1'></textarea></td>" +
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
        $("#table3").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                //panggil method ajax list dengan ajax
                "url": '<?= base_url() ?>paket/ajaxlist_keranjang',
                "type": "POST"
            }
        });

        function requesttambahkeranjang(s) {
            const url = "<?= base_url('paket/keranjang/') ?>" + s + "/<?= $data->id ?>"
            console.log(url)
            $.ajax({
                url: url,
                dataType: "json",
                success: function(json) {
                    console.log(json)
                    json.forEach(element => {
                        var date = new Date()
                        $("#cart").append("<tr id='rowcart" + date.getTime() + "'>" +
                            "<td><button type='button' class='btn  btn-danger rounded-pill' onclick='removecart(\"rowcart" + date.getTime() + "\")'>hapus</button></td>" +
                            "<td>" + element.kode_item + "</td>" +
                            "<td>" + element.nama + "</td>" +
                            "<td><input type='hidden' name='id[]' value='" + element.id_barang + "'><input oninput='hitungTotalHarga()' min='0' class='form-control' type='number' name='harga[]' value='" + element.harga + "'></td>" +
                            "<td><input oninput='hitungTotalHarga()' min='0' class='form-control' type='number' name='jumlah[]' value='1'></td>" +
                            "<td><textarea class='form-control' name='keterangan[]'  cols='30' rows='1'></textarea></td>" +
                            "</tr>")
                    });
                }
            })
        }
        hitungTotalHarga()

        function hitungTotalHarga() {
            var form = document.forms['form-cart']
            var hargabayararr = []
            var pos = 0;
            form['harga[]'].forEach(element => {
                hargabayararr[pos] = element.value * form['jumlah[]'][pos].value
                pos++
            });
            const formatter=new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
            })
            const total_bayar = hargabayararr.reduce((a, b) => a + b);
            console.log(total_bayar)
            $("#total_bayar").html("Total Bayar : " + formatter.format(total_bayar))
        }
    </script>