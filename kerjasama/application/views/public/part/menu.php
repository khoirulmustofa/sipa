<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="<?php echo base_url('welcome') ?>" class="logo">
					<img width="40px" src="<?php echo base_url('templates') ?>/img/logo/logo.png" alt="navbar brand" class="navbar-brand">
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
					<h2 class="text-light text-center"><b><i>SiPA-KERJASAMA UIR</i></b></h2>

					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<?php if ($_SESSION['foto'] == "") { ?>
										<img src="<?php echo base_url('templates') ?>/img/dosen/inisial/<?php echo $_SESSION['jenis_kelamin']; ?>.jpg" alt="..." class="avatar-img rounded-circle border-light">
									<?php } else { ?>
										<img src="<?php echo base_url('templates') ?>/img/dosen/<?php echo $_SESSION['foto']; ?>" alt="..." class="avatar-img rounded-circle border-light">
									<?php } ?>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<?php if ($_SESSION['foto'] == "") { ?>
												<div class="avatar-lg"><img src="<?php echo base_url('templates') ?>/img/dosen/inisial/<?php echo $_SESSION['jenis_kelamin']; ?>.jpg" alt="image profile" class="avatar-img rounded"></div>
											<?php } else { ?>
												<div class="avatar-lg"><img src="<?php echo base_url('templates') ?>/img/dosen/<?php echo $_SESSION['foto']; ?>" alt="image profile" class="avatar-img rounded"></div>
											<?php } ?>
											<div class="u-text">
												<h4><?php echo $_SESSION['nama'] ?></h4>
												<p class="text-muted"><?php echo $_SESSION['status_login'] ?></p><a href="<?php echo base_url('profil') ?>" class="btn btn-xs btn-secondary btn-sm">Lihat Profil</a>
											</div>
										</div>
									</li>
								</div>
							</ul>
						</li>
					</ul>
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
							<?php if ($_SESSION['foto'] == "") { ?>
								<img src="<?php echo base_url('templates') ?>/img/dosen/inisial/<?php echo $_SESSION['jenis_kelamin']; ?>.jpg" alt="..." class="avatar-img rounded-circle">
							<?php } else { ?>
								<img src="<?php echo base_url('templates') ?>/img/dosen/<?php echo $_SESSION['foto']; ?>" alt="..." class="avatar-img rounded-circle">
							<?php } ?>
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $_SESSION['nama']; ?>
									<span class="user-level">
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
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="<?php echo base_url('profil') ?>">
											<span class="link-collapse">Profil Saya</span>
										</a>
									</li>
									<li>
										<a class="btn btn-danger btn mt-3 text-light" data-toggle="modal" data-target="#modal_keluar<?php echo $_SESSION['status_login']; ?>"><i class="text-light fas fa-power-off"></i> Logout</a>

									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="<?php echo base_url('kerjasama_tu') ?>" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo base_url('tu/kerjasama_tu') ?>" class="collapsed" aria-expanded="false">
								<i class="fas fa-handshake"></i>
								<p>Kerjasama</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?php echo str_replace("kerjasama/", "", base_url()) ?>" class="collapsed" aria-expanded="false">
								<i class="fas fa-backward"></i>
								<p>Kembali ke SiPA</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->


		<?php if (isset($_SESSION['login_smpu'])) { ?>

			<div class="container">
				<!-- Content Header (Page header) -->
				<!-- <div class="content-header"> -->
				<!-- ============ MODAL Keluar =============== -->
				<div class="modal fade" id="modal_keluar<?php echo $_SESSION['status_login']; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title" id="myModalLabel">Konfirmasi Logout</h3>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
							</div>
							<form class="form-horizontal" method="post" action="<?php echo base_url() . 'logout' ?>">
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
				<!-- end modal -->
			</div>

		<?php } ?>