<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                DETAIL DATA ANGKATAN
            </h2>
        </div>
        <div class="alert alert-info alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <i class="material-icons">info</i><span> Data ini diambil berdasarkan pengguna / <b>"Alumni"</b> yang telah melengkapi data diri.</span>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Data Tracer Study Untuk Lulusan Tahun <span class="label label-warning"><?php echo $this->uri->segment(3); ?></span></h2>
                        <?php echo anchor('data-angkatan/data-angkatan-detail-print/' . $this->uri->segment(3), '<i class="material-icons">print</i><span>Print</span>', 'class="btn btn-default waves-effect"'); ?>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jurusan</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($table as $val) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($val->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($val->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($val->prodi, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($val->status, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo anchor('data-angkatan/data-angkatan-read/' . $val->id_data_diri, '<i class="material-icons">remove_red_eye</i><span> Lihat Detail</span>', 'class="btn btn-info waves-effect waves-float"') ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>