<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SiPA-FT</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/logo_uir.jpg">

</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-5 shadow-lg my-5">
            <div class="col-lg">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Register Akun Mahasiswa!</h1>
                    </div>
                    <?php echo $this->session->flashdata('messege'); ?>
                    <form class="user" action="<?php echo site_url('/register/proses'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Nama Lengkap | Contoh Penulisan : Mahasiswa Fakultas Teknik" required="" >
                        </div>
                        <div class="form-group">
                            <select class="form-control user text-dark" id="jk" name="jk" required="">
                                <option value="">--Jenis Kelamin--</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir | Contoh Penulisan : Kebayoran Baru, Jakarta Selatan" required="">
                        </div>
                        <div class="form-group">
                            <input placeholder="Tanggal Lahir" class="form-control datepicker" type="text" onfocus="(this.type='date')" id="tgl_lahir" name="tgl_lahir">
                        </div>
                        <script type="text/javascript">
                           $(function(){
                              $(".datepicker").datepicker({
                                  format: 'yyyy-mm-dd',
                                  autoclose: true,
                                  todayHighlight: true,
                              });
                          });
                      </script>
                      <div class="form-group">
                        <select class="form-control user text-dark" id="kode_prodi" name="kode_prodi" required="">
                            <option value="">--Pilih Prodi--</option>
                            <?php foreach ($combobox_prodi as $cmb) {
                                ?>
                                <option value="<?php echo $cmb['kode_prodi'] ?>"><?php echo $cmb['nama_prodi'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email_student" name="email_student" placeholder="Email Student" required="" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email_umum" name="email_umum" placeholder="Email Pribadi" required="">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="no_hp" name="no_hp"
                            placeholder="No. WhatsApp" required="" >
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="no_ktp" name="no_ktp" placeholder="No. KTP" required="" >
                        </div>
                        <div class="form-group">
                            <select class="form-control user text-dark" id="agama" name="agama" required="">
                                <option value="">--Agama--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Khonghucu">Khonghucu</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap | Contoh Penulisan : Jl. Pattimura No. 20 Kebayoran Baru, Jakarta Selatan" required="" >
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="number" class="form-control" id="npm" name="npm" placeholder="NPM" required="" >
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" >
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" placeholder="Konfirmasi Password" required="" >
                        </div>

                        <button type="submit" id="simpan-data" name="simpan-data" class="btn btn-primary btn-user btn-block" class="tombol_daftar" style="float:center">Register </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?php echo site_url().'/logout'?>">Sudah memiliki akun? Langsung Login!</a>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"</script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url() ?>assets/js/demo/datatables-demo.js"></script>
</body>
</html>

<?php

if (isset($_POST['simpan-data'])) {

    $npm            = $_POST['npm'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $jk             = $_POST['jk'];
    $tempat_lahir   = $_POST['tempat_lahir'   ];
    $tgl_lahir      = $_POST['tgl_lah       ir'];
    $kode_prodi     = $_POST['kode_prodi'   ];
    $password       = $_POST['password'];
    $email_student  = $_POST['email_student'];
    $email_umum     = $_POST['email_umum'];
    $no_hp          = $_POST['no_hp'];
    $no_ktp         = $_POST['no_ktp'];
    $agama          = $_POST['agama'];
    $alamat         = $_POST['alamat'];
    $foto           = $_FILES['foto'];
    if(isset($foto["tmp_name"]) && $foto["tmp_name"]!=""){
        $nama_file  = $foto['name'];
        $folder     = "upload/".$nama_file;
        move_uploaded_file($foto["tmp_name"], $folder);
    }
    $status         = $_POST['status'];


    mysqli_query($koneksi, "INSERT INTO tbl_mahasiswa 
        (npm, 
        nama_mahasiswa, 
        jk, 
        tempat_lahir, 
        tgl_lahir, 
        kode_prodi, 
        password, 
        email_student, 
        email_umum, 
        no_hp, 
        no_ktp, 
        agama, 
        alamat, 
        foto, 
        status)
        VALUES 
        (
        '$npm', 
        '$nama_mahasiswa', 
        '$jk', 
        '$tempat_lahir', 
        '$tgl_lahir', 
        '$kode_prodi', 
        '$password', 
        '$email_student', 
        '$email_umum', 
        '$no_hp',
        '$no_ktp',
        '$agama',
        '$alamat',
        '$nama_file', 
        'Tersedia')") ;

// if (mysqli_affected_rows($koneksi) > 0) {
//     echo '<script>alert("Akun berhasil dibuat !");window.location="login.php";</script>';
// }
// else{
//     echo '<script>alert("Akun gagal dibuat !");</script>';
// }
}
?>