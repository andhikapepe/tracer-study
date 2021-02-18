<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>SARAN</h2><small>Masukan berupa saran adalah sesuatu yang bersifat membangun.</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <?php echo anchor(
                            'saran/saran-add',
                            '<i class="material-icons">input</i><span>Tambah saran</span>',
                            'class="btn btn-primary waves-effect waves-float"'
                        ); ?>
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
                                    <tr class="bg-blue">
                                        <th>Tanggal Posting</th>
                                        <th>Saran</th>
                                        <th>Tanggapan</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table as $val) { ?>
                                        <tr>
                                            <td><?php echo indonesian_date($val->tanggal_posting); ?></td>
                                            <td><?php echo ucfirst(htmlspecialchars_decode(character_limiter($val->saran, 200))); ?></td>
                                            <td>
                                                <?php echo (empty($val->respon) ? '<h4><span class="label label-danger">Belum Ditanggapi</span></h4>' : '<h4><span class="label label-success">Telah Ditanggapi</span></h4>'); ?>
                                            </td>
                                            <td>
                                                <?php echo anchor(
                                                    'saran/saran-read/' . $val->id_saran,
                                                    '<i class="material-icons">remove_red_eye</i>',
                                                    'class="btn btn-primary btn-circle waves-effect waves-circle waves-float"'
                                                ); ?>
                                                <?php echo anchor(
                                                    'saran/saran-delete/' . $val->id_saran,
                                                    '<i class="material-icons">delete</i>',
                                                    'class="btn btn-danger btn-circle waves-effect waves-circle waves-float btn-hapus"'
                                                ); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <link href="<?php echo base_url('assets/admin-page'); ?>/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
                        <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/sweetalert/sweetalert.min.js"></script>
                        <script type="text/javascript">
                            $('.btn-hapus').on("click", function(e) {
                                e.preventDefault();
                                var url = $(this).attr('href');
                                swal({
                                        title: "Yakin mau hapus data?",
                                        text: "Data tidak dapat dipulihkan setelah dihapus!",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonColor: '#DD6B55',
                                        confirmButtonText: 'Ya, Hapus!',
                                        cancelButtonText: "Tidak, batalkan!",
                                        confirmButtonClass: "btn-danger",
                                        closeOnConfirm: false,
                                        closeOnCancel: false
                                    },
                                    function(isConfirm) {
                                        if (isConfirm) {
                                            swal("Dihapus!", "Data telah dihapus!", "success");
                                            window.location.replace(url);
                                            //window.location.replace = url;
                                        } else {
                                            swal("Dibatalkan", "Data aman..!", "error");
                                        }
                                    });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
</section>