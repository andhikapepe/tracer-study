<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Bursa kerja
                <small>Berikut ini adalah data lowongan (bursa kerja) yang ada.</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <?php echo anchor('bursakerja/bursakerja-add', '<i class="material-icons">directions</i><span>Tambah Lowongan</span>', 'class="btn btn-primary waves-effect"') ?>
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
                                        <th>Nama Badan Usaha</th>
                                        <th>Judul Job</th>
                                        <th>Deskripsi</th>
                                        <th>Akhir Lowongan</th>
                                        <th>Tanggal Posting</th>
                                        <th>Ditampilkan?</th>
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
                                            <td><?php echo htmlspecialchars($val->nama_perusahaan, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($val->job_title, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars_decode(character_limiter($val->deskripsi, 100)); ?></td>
                                            <td><?php echo htmlspecialchars(indonesian_date($val->akhir_waktu), ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars(indonesian_date($val->tanggal_posting), ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo (($val->is_tampil == 'YA') ? '<span class="label label-success">Ya</span>' : '<span class="label label-info">TIDAK</span>'); ?>
                                            <td>
                                                <?php echo anchor('bursakerja/bursakerja-edit/' . $val->id_lowongan, '<i class="material-icons">edit</i>', 'class="btn btn-warning btn-circle waves-effect waves-circle waves-float"'); ?>
                                                <?php echo anchor('bursakerja/bursakerja-delete/' . $val->id_lowongan, '<i class="material-icons">delete</i>', 'class="btn btn-danger btn-circle waves-effect waves-circle waves-float btn-hapus"'); ?>
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
    </div>
</section>