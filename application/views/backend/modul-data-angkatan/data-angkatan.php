<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2> Data Angkatan Tracer Study </h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Silahkan tekan <button class="btn btn-info waves-effect waves-float"><i class="material-icons">edit</i><span>Pilih Angkatan</span></button> Per-Tahun lulusan untuk melihat data tracer study.
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="align-center">Tahun Lulus Angkatan</th>
                                        <th class="align-center">Jumlah Data Tracer Study</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($table as $val) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td class="align-center">Tahun Lulus <?php echo htmlspecialchars($val->tahun_lulus, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="align-center"><?php echo htmlspecialchars($val->jumlah_lulusan, ENT_QUOTES, 'UTF-8'); ?> Lulusan</td>
                                            <td>
                                                <?php echo anchor('data-angkatan/data-angkatan-detail/' . $val->tahun_lulus, '<i class="material-icons">edit</i><span>Pilih Angkatan</span>', 'class="btn btn-info waves-effect waves-float"'); ?>
                                            </td>
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