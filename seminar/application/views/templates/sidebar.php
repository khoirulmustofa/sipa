
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">     
        <div class="sidebar-brand-text mx-3">KP-SKRIPSI</div>
    </a>
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo site_url(); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!----------------------------------------- UPM -------------------------------------------->
    <?php 
    if ($_SESSION['status_login']=="UPM"){
        ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-graduation-cap"></i>

                <span>Pelaporan </span>
            </a>
            <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?php echo site_url(); ?>/upm/monitoring_sk">Kerja Praktek</a>
                    <a class="collapse-item" href="<?php echo site_url(); ?>/upm/monitoring_skripsi">Skripsi</a>
                </div>
            </div>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="<?php echo str_replace("seminar/", "", base_url()) ?>">
                <i class="fas fa-backward"></i>
                <span class="font-weight-bold text-warning">Kembali ke SiPA</span></a>
            </li>


            <!--------------------------------------- FAKULTAS ---------------------------------------->
            <?php 
        } elseif ($_SESSION['status_login']=="Fakultas"){
            ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Pengajuan</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                       <a class="collapse-item" href="<?php echo site_url(); ?>/fakultas/surat_pengantar">Surat Pengantar Instansi</a>
                       <a class="collapse-item" href="<?php echo site_url(); ?>/fakultas/monitoring_sk">SK Pembimbing KP</a>
                       <a class="collapse-item" href="<?php echo site_url(); ?>/fakultas/surat_pengantar_penelitian">Surat Pengantar Penelitian</a>
                       <a class="collapse-item" href="<?php echo site_url(); ?>/fakultas/monitoring_skripsi">SK Pembimbing Skripsi</a>
                       <a class="collapse-item" href="<?php echo site_url(); ?>/fakultas/penguji_skripsi">SK Penguji Skripsi</a>
                   </div>
               </div>
           </li>
           <li class="nav-item">
            <a class="nav-link" href="<?php echo str_replace("seminar/", "", base_url()) ?>">
                <i class="fas fa-backward"></i>        
                <span class="font-weight-bold text-warning">Kembali ke SiPA</span></a>
            </li>

            <!---------------------------------- TATAUSAHA -------------------------------------------->
            <?php
        } elseif ($_SESSION['status_login']=="Tata Usaha"){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('/tu/data_mahasiswa')?>">
                    <i class="fa fa-users fa-2x text-gray-300"></i>
                    <span>Data Mahasiswa</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Pengajuan Surat</span>
                    </a>
                    <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?php echo site_url(); ?>/tu/surat_pengantar">Surat Pengantar Instansi</a>
                            <a class="collapse-item" href="<?php echo site_url(); ?>/tu/monitoring_sk">SK Pembimbing KP</a>
                            <a class="collapse-item" href="<?php echo site_url(); ?>/tu/surat_pengantar_penelitian">Surat Pengantar Penelitian</a>
                            <a class="collapse-item" href="<?php echo site_url(); ?>/tu/monitoring_skripsi">SK Pembimbing Skripsi</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Pengajuan Ujian</span>
                    </a>
                    <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="<?php echo site_url(); ?>/tu/monitoring_sempro">Seminar Proposal</a>
                            <a class="collapse-item" href="<?php echo site_url(); ?>/tu/monitoring_kompre">Sidang Skripsi</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_BLANK" href="<?php echo base_url('templates/file/panduan/TATAUSAHA.pdf');?>"><i class="fas fa-fw fa-table"></i><span>Panduan</span></a>
                </li> 
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo str_replace("seminar/", "", base_url()) ?>">
                        <i class="fas fa-backward"></i>
                        <span class="font-weight-bold text-warning">Kembali ke SiPA</span></a>
                    </li>

                    <!------------------------------------- PRODI ------------------------------------------>
                    <?php 
                } elseif ($_SESSION['status_login']=="Prodi"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('/prodi/sanksi')?>">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>Sanksi Mahasiswa</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Kerja Praktek</span>
                            </a>
                            <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/surat_pengantar">Surat Pengantar Instansi</a>
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/monitoring_sk">SK Pembimbing KP</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Skripsi</span>
                            </a>
                            <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/surat_pengantar_penelitian">Surat Pengantar Penelitian</a>
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/monitoring_skripsi">SK Pembimbing</a>
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/penguji_skripsi">SK Penguji</a>
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/persetujuan_kompre">Persetujuan Sidang Akhir</a>
                                </div>
                            </div>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Penilaian Skripsi</span>
                            </a>
                            <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/nilai_sempro">Seminar Proposal</a>
                                    <a class="collapse-item" href="<?php echo site_url(); ?>/prodi/nilai_kompre">Sidang Akhir</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_BLANK" href="<?php echo base_url('templates/file/panduan/PRODI.pdf');?>"><i class="fas fa-fw fa-table"></i><span>Panduan</span></a>
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo str_replace("seminar/", "", base_url()) ?>">
                                <i class="fas fa-backward"></i>
                                <span class="font-weight-bold text-warning">Kembali ke SiPA</span></a>
                            </li>       

                            <!------------------ DOSEN -------------------------------------------------->
                            <?php 
                        } elseif ($_SESSION['status_login']=="Dosen"){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                                    <i class="fas fa-graduation-cap"></i>

                                    <span>Penunjukan </span>
                                </a>
                                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/dosen/dospem">Pembimbing KP</a>
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/dosen/dospem_skripsi">Pembimbing Skripsi</a>
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/dosen/penguji_skripsi">Penguji Skripsi</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                                    <i class="fas fa-clock"></i>
                                    <span>Bimbingan </span>
                                </a>
                                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/dosen/bimbingan">Kerja Praktek</a>
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/dosen/bimbingan_skripsi">Skripsi</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                                    <i class="fas fa-clock"></i>
                                    <span>Penilaian Skripsi </span>
                                </a>
                                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/dosen/penilaian_pembimbing">Pembimbing</a>
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/dosen/penilaian_penguji">Penguji</a>

                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" target="_BLANK" href="<?php echo base_url('templates/file/panduan/DOSEN.pdf');?>"><i class="fas fa-fw fa-table"></i><span>Panduan</span></a>
                            </li> 
           <!--  <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url(); ?>/dosen/bimbingan">
                    <i class="fas fa-clock"></i>
                    <span>Jadwal Menguji</span></a>
                </li>  -->
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo str_replace("seminar/", "", base_url()) ?>">
                        <i class="fas fa-backward"></i>
                        <span class="font-weight-bold text-warning">Kembali ke SiPA</span></a>
                    </li>

                    <!----------------- PEMBIMBING LAPANGAN KP ------------------------>
                    <?php 
                } elseif ($_SESSION['status_login']=="Pembimbing Lapangan KP"){
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url(); ?>/pembimbing_lapangan_kp/penilaian_kp">
                            <i class="fas fa-upload"></i>
                            <span>Penilaian Mahasiswa KP</span></a>
                        </li> 

                        <!----------------------- GKM -------------------------------->
                        <?php 
                    } elseif ($_SESSION['status_login']=="GKM Prodi"){
                        ?>
                      <!--   <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url(); ?>/gkm/monitoring_skripsi">
                                <i class="fas fa-upload"></i>
                                <span>Judul Skripsi</span></a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Pelaporan </span>
                                </a>
                                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <!-- <h6 class="collapse-header">Bimbingan</h6> -->
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/gkm/monitoring_sk">Kerja Praktek</a>
                                        <a class="collapse-item" href="<?php echo site_url(); ?>/gkm/monitoring_skripsi">Skripsi</a>
                                    </div>
                                </div>
                            </li> 

                            <!----------------------- Koordinator -------------------------------->
                            <?php 
                        } elseif ($_SESSION['status_login']=="Koordinator Prodi"){
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo site_url(); ?>/koordinator/monitoring_skripsi">
                                    <i class="fas fa-graduation-cap"></i>
                                    <span>Skripsi</span></a>
                                </li>
                                

                                <!----------------- MAHASISWA ---------------------------->
                                <?php 
                            } elseif ($_SESSION['status_login']=="Mahasiswa") {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1" aria-expanded="true" aria-controls="collapseUtilities">
                                        <i class="fas fa-file-upload"></i>
                                        <span>Pengajuan</span>
                                    </a>
                                    <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/surat_pengantar">Surat Pengantar Instansi</a>
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/sk">SK Pembimbing KP</a>
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/surat_pengantar_penelitian">Surat Pengantar Penelitian</a>
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/skripsi">SK Pembimbing Skripsi</a>
                                        </div>
                                    </div>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities">
                                        <i class="fas fa-clock"></i>
                                        <span>Bimbingan</span>
                                    </a>
                                    <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/bimbingan">Kerja Praktek</a>
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/bimbingan_skripsi">Skripsi</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities">
                                        <i class="fas fa-clock"></i>
                                        <span>Ujian</span>
                                    </a>
                                    <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/sempro">Seminar Proposal</a>
                                            <a class="collapse-item" href="<?php echo site_url(); ?>/mahasiswa/kompre">Sidang Akhir</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" target="_BLANK" href="<?php echo base_url('templates/file/panduan/panduan_mahasiswa.pdf');?>"><i class="fas fa-fw fa-table"></i><span>Panduan</span></a>
                                </li>   
                                <?php 
                            }
                            ?>

    <!-- Divider
    <hr class="sidebar-divider">

    Heading
    <div class="sidebar-heading">
        Tentang
    </div>
    <li class="nav-item">
        <a class="nav-link" href="tables.html"><i class="fas fa-fw fa-table"></i><span>Dokumentasi</span></a>
    </li>   -->s
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small"
                        placeholder="Search for..." aria-label="Search"
                        aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php if(isset($_SESSION['nama'])){ echo $_SESSION['nama']; }  ?></span>
            <?php if($_SESSION['status_login']== "Mahasiswa"){?>
            <img class="img-profile rounded-circle" src="<?php echo base_url() ?>templates/img/mahasiswa/<?= $_SESSION['foto'] ?>">  
            <?php }else{
                echo '';
            } ?>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="<?php echo site_url('/profil')?>">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>
    </div>
</li>
</ul>
</nav>
<!-- End of Topbar -->

<!-- MODAL LOGOUT-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Apakah Anda yakin Logout ?</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
            <a class="btn btn-primary" href="<?php echo site_url().'/logout'?>">Ya</a>
            <!-- <a class="btn btn-primary" href="<?php echo base_url().'logout'?>">Ya</a> -->
        </div>
    </div>
</div>
</div>


