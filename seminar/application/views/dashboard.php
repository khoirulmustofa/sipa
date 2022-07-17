<!-- ==================================================UPM================================== -->
<div class="container-fluid">
    <?php 
    if ($_SESSION['status_login']=="UPM"){
        ?>
        <div class="col-lg-15 mb-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                </div>
                <div class="card-body">
                    <div class="row">
                       <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Selesai KP <i class="fas fa-check-circle"></i></div>
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $hitung_sudah_kp ?></div>  -->
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Selesai Skripsi <i class="fas fa-check-circle"></i></div>
                                        <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $selesai_skripsi ?></div>  -->
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <!-- ========================================FAKULTAS================================== -->
        <?php 
    } elseif ($_SESSION['status_login']=="Fakultas"){
        ?>
        <div class="col-lg-15 mb-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                </div>
                <div class="card-body">
                 <div class="row">
                 </div>
             </div>
         </div>

         <!-- ========================================GKM================================== -->
         <?php 
     } elseif ($_SESSION['status_login']=="GKM Prodi"){
        ?>
        <div class="col-lg-15 mb-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                </div>
                <div class="card-body">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>


        <!-- ========================================Koordinator================================== -->
        <?php 
    } elseif ($_SESSION['status_login']=="Koordinator Prodi"){
        ?>
        <div class="col-lg-15 mb-2">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                </div>
                <div class="card-body">
                    <div class="row">

                    </div>
                </div>
            </div>

            <!-- ===========================================PEMBIMBING LAPANGAN KP=========================== -->
            <?php 
        } elseif ($_SESSION['status_login']=="Pembimbing Lapangan KP"){
            ?>
            <div class="col-lg-15 mb-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                    </div>
                    <div class="card-body">
                        <p>
                            Silahkan inputkan nilai mahasiswa disini
                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalPenilaianPembimbingLapangan">Tambah Data</a> 
                        </p>
                    </div>
                </div>
            </div>

            <!-- ===========================================TATAUSAHA======================================== -->
            <?php
        } elseif ($_SESSION['status_login']=="Tata Usaha"){
            ?>
            <div class="col-lg-15 mb-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                    </div>
                    <div class="card-body">
                        <div class="row">                     
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===========================================PRODI======================================== -->
            <?php 
        } elseif ($_SESSION['status_login']=="Prodi"){
            ?>
            <div class="col-lg-15 mb-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===========================================DOSEN======================================== -->
            <?php 
        } elseif ($_SESSION['status_login']=="Dosen"){
            ?>
            <div class="col-lg-15 mb-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <marquee><h3 class="m-0 font-weight-bold text-primary">..Selamat Datang disistem KP-SKRIPSI..</h3></marquee>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===========================================MAHASISWA======================================== -->
            <?php 
        } elseif ($_SESSION['status_login']=="Mahasiswa") {
            ?>
            <div class="col-lg-15 mb-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <marquee><h5 class="m-0 font-weight-bold text-success">Pastikan nomor WhatsApp diprofil dapat dihubungi ketika mengurus surat..</h5></marquee>
                    </div>
                    <div class="card-body" align="justify">
                        <p class="text-primary">
                            <b>Silahkan Ikuti Panduan dibawah..</b>
                        </p>
                        <ol>
                            <b><li>Pengurusan Surat Pengantar Instansi</li></b>
                            <img src="templates/img/beranda/sp.png" width="90%" height="40%"><br><br>
                            <b><li>Pengurusan SK Pembimbing Kerja Praktek</li></b>
                            <img src="templates/img/beranda/sk.png" width="90%" height="40%">
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-lg-15 mb-2">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Kunjungi Website lainnya :
                        <p class="text-primary">
                            <ol>
                                <li><a href="http://eng.uir.ac.id/" target="_BLANK" class="p-2"<b>Website Fakultas Teknik <i class="fas fa-check-circle"></i></b></a><br></li>
                                <li><a href="https://www.youtube.com/c/informaticsUIR" target="_BLANK" class="p-2"<b>Youtube Fakultas Teknik <i class="fas fa-check-circle"></i></b></a><br></li>
                                <li><a href="https://uir.ac.id/" target="_BLANK" class="p-2"<b>Portal Universitas Islam Riau <i class="fas fa-check-circle"></i></b></a><br></li>
                                <li><a href="https://www.youtube.com/c/UIROfficial" target="_BLANK" class="p-2"<b>Youtube Universitas Islam Riau <i class="fas fa-check-circle"></i></b></a><br></li>
                            </ol>
                        </p>
                    </div>
                </div>
            </div>
            <?php 
        }
        ?>
    </div>