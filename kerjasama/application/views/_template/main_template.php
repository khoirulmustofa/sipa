<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title ?> - FT Universitas Islam Riau</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= str_replace('kerjasama', '', base_url()) ?>templates/img/logo/logo.png" type="image/x-icon" />
    <!-- Fonts and icons -->
    <script src="<?= base_url('templates') ?>/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['<?= base_url('templates') ?>/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <script src="<?= base_url('assets/js/cuctom.js') ?>"></script>
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('templates') ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('templates') ?>/assets/css/atlantis.min.css">
    <?php if (isset($load_css)) {
        $this->load->view($load_css);
    }
    ?>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="<?= base_url() ?>" class="logo">
                    <img src="<?= str_replace('kerjasama', '', base_url()) . 'templates/img/logo/logo.png' ?>" style="width: 40px;" alt="Logoo" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

                <div class="container-fluid">
                    <h2 class="text-light text-center"><b><i>SISTEM INFORMASI KERJASAMA FAKULTAS TEKNIK (SIsKA-FT)</i></b></h2>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">

            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="<?= base_url('templates') ?>/assets/img/avatar.png" alt="avatar" class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <?php echo $_SESSION['nama']; ?>
                                    <br>
                                    <?php
                                    if (isset($_SESSION['status_jabatan'])) {
                                        if ($_SESSION['status_jabatan'] == 'Pegawai') {
                                            echo $_SESSION['status_jabatan'];
                                        } else {
                                            echo $_SESSION['status_login'];
                                        }
                                    } else {
                                        echo $_SESSION['status_login'];
                                    }
                                    ?>

                                </span>


                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#edit">
                                            <span class="link-collapse">Edit Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#settings">
                                            <span class="link-collapse">Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">

                        <?php if ($_SESSION['status_login'] == "Fakultas") { ?>
                            <!-- untuk Fakultas -->
                            <li class="nav-item<?php echo $menu == "menu_dashboard" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('dashboard') ?>">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo $menu == "menu_mou" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('tu/kerja_sama') ?>">
                                    <i class="fas fa-link"></i>
                                    <p>Memorandum of Understanding (MOU)</p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo $menu == "menu_kegiatan" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('prodi/kegiatan') ?>">
                                    <i class="fas fa-book-open"></i>
                                    <p>Kegiatan</p>
                                </a>
                            </li>
                        <?php  } ?>

                        <?php if ($_SESSION['status_login'] == "Tata Usaha") { ?>
                            <!-- untuk Tata Usaha -->
                            <li class="nav-item<?php echo $menu == "menu_dashboard" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('dashboard') ?>">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo $menu == "menu_mou" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('mou') ?>">
                                    <i class="fas fa-link"></i>
                                    <p>Memorandum of Understanding (MOU)</p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo $menu == "menu_moa" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('moa') ?>">
                                    <i class="fas fa-link"></i>
                                    <p>Memorandum of Agreement (MOA)</p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo $menu == "menu_ia" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('ia') ?>">
                                    <i class="fas fa-link"></i>
                                    <p>Implementation Arrangement (IA)</p>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['status_login'] == "Prodi") { ?>
                            <!-- untuk Prodi -->
                            <li class="nav-item<?php echo $menu == "menu_dashboard" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('dashboard') ?>">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item<?php echo $menu == "menu_kegiatan" ? ' active' : "" ?>">
                                <a href="<?php echo base_url('prodi/kegiatan') ?>">
                                    <i class="fas fa-book-open"></i>
                                    <p>Kegiatan</p>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item<?php echo $menu == "menu_kegiatan" ? ' ' : "" ?>">
                            <a href="<?php echo str_replace('kerjasama/', '', base_url()) ?>">
                                <i class="far fa-arrow-alt-circle-left"></i>
                                <p>Kembali ke SIPA</p>
                            </a>
                        </li>
                        <li class="nav-item<?php echo $menu == "menu_kegiatan" ? ' ' : "" ?>">
                            <a data-toggle="modal" data-target="#modalKeluarSIPA">
                                <i class="far fa-arrow-alt-circle-left"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="main-panel">
            <?php echo $contents ?>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright ml-auto">
                        ©<?= date('Y') ?>, made with <i class="fa fa-heart heart text-danger"></i> by <a href="#">Fakultas Teknik Universitas Islam Riau</a>
                    </div>
                </div>
            </footer>
        </div>

        <div class="modal fade" id="modalKeluarSIPA" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel">Konfirmasi Logout</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo str_replace('kerjasama/', '', base_url()) . 'logout' ?>">
                        <div class="modal-body">
                            <p>Anda yakin logout?</b></p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-danger">Ya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="<?= base_url('templates') ?>/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="<?= base_url('templates') ?>/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url('templates') ?>/assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="<?= base_url('templates') ?>/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="<?= base_url('templates') ?>/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <!-- jQuery Scrollbar -->
    <script src="<?= base_url('templates') ?>/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url('templates') ?>/assets/js/sweetalert2.all.min.js"></script>
    <!-- Datatables -->
    <script src="<?= base_url('templates') ?>/assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Atlantis JS -->
    <script src="<?= base_url('templates') ?>/assets/js/atlantis.min.js"></script>
    <?php if (isset($load_js)) {
        $this->load->view($load_js);
    }
    ?>
</body>

</html>