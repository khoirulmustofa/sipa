<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <h3>WELCOME</h3>
                    <h4>Fakultas Teknik Universitas Islam Riau</h4>
                    <blockquote>
                        <h5>Hai <?php echo $_SESSION['nama'] ?>...</h5>
                        <p>Selamat Datang di SiPA-Kerjasama Universitas Islam Riau.</p>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="x_content">
                        <div class="title_left">
                            <h3>Total Kerja Sama</h3>
                        </div>
                        <div class="row">
                            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6  ">
                                <div class="tile-stats" style="background: #00C9FF;background: -webkit-linear-gradient(to right, #92FE9D, #00C9FF);background: linear-gradient(to right, #92FE9D, #00C9FF);">
                                    <div class="icon"><i class="fa fa-folder-open-o"></i>
                                    </div>
                                    <div class="count" style="color: #fff;"><?php echo $jumlah_kerja_sama_row->MOU ?></div>
                                    <h3 style="color: #fff;">MOU</h3>
                                </div>
                            </div>
                            <div class="animated flipInY col-lg-6 col-md-6 col-sm-6  ">
                                <div class="tile-stats" style="background: #f46b45;background: -webkit-linear-gradient(to right, #eea849, #f46b45);background: linear-gradient(to right, #eea849, #f46b45);">
                                    <div class="icon"><i class="fa fa-folder-open-o"></i>
                                    </div>
                                    <div class="count" style="color: #fff;"><?php echo $jumlah_kerja_sama_row->MOA ?></div>
                                    <h3 style="color: #fff;">MOA</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>