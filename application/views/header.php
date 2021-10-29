<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Bengkel Sakti</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/choices.js/choices.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendors/dataTables/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendors/dataTables/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/app.css">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.svg" type="image/x-icon">
    <script type="text/javascript" src="<?= base_url() ?>assets/vendors/dataTables/js/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/vendors/dataTables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/vendors/dataTables/js/dataTables.bootstrap5.min.js"></script>
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: grey;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #435ebe;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="<?= base_url() ?>" style="text-align: center;"><i class="bi bi-wrench"></i> Bengkel OP</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?php if ($active == 'home') echo 'active';
                                                else '' ?> ">
                            <a href="<?= base_url() ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub <?php if ($active == 'list_barang' || $active == 'list_stock' || $active == 'list_uoms' || $active == 'list_rak' || $active == 'list_jenis' || $active ==  'list_paket') echo 'active';
                                                        else '' ?>">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Barang</span>
                            </a>
                            <ul class="submenu " style="display: <?php if ($active == 'list_barang' || $active == 'list_stock' || $active == 'list_uoms' || $active == 'list_rak' || $active == 'list_jenis' || $active ==  'list_paket') echo 'block';
                                                                    else '' ?>">
                                <li class="submenu-item <?php if ($active == 'list_barang') echo 'active';
                                                        else '' ?>">
                                    <a href="<?= base_url('barang') ?>">List Barang</a>
                                </li>
                                <li class="submenu-item <?php if ($active == 'list_stock') echo 'active';
                                                        else '' ?>">
                                    <a href="<?= base_url('stock') ?>">Stock</a>
                                </li>
                                <li class="submenu-item <?php if ($active == 'list_uoms') echo 'active';
                                                        else '' ?>">
                                    <a href="<?= base_url('uoms') ?>">Satuan</a>
                                </li>
                                <li class="submenu-item <?php if ($active == 'list_rak') echo 'active';
                                                        else '' ?>">
                                    <a href="<?= base_url('rak') ?>">Rak</a>
                                </li>
                                <li class="submenu-item <?php if ($active == 'list_jenis') echo 'active';
                                                        else '' ?>">
                                    <a href="<?= base_url('jenis') ?>">Jenis</a>
                                </li>
                                <li class="submenu-item <?php if ($active ==  'list_paket') echo 'active';
                                                        else '' ?>">
                                    <a href="<?= base_url('paket') ?>">Paket</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item <?php if ($active == 'pelanggan') echo 'active';
                                                else '' ?> ">
                            <a href="<?= base_url('pelanggan') ?>" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Pelanggan</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php if ($active == 'kendaraan') echo 'active';
                                                else '' ?> ">
                            <a href="<?= base_url('kendaraan') ?>" class='sidebar-link'>
                                <i class="bi bi-bicycle"></i>
                                <span>Kendaraan</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php if ($active == 'transaksi') echo 'active';
                                                else '' ?> ">
                            <a href="<?= base_url('transaksi') ?>" class='sidebar-link'>
                                <i class="bi bi-cart4"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>