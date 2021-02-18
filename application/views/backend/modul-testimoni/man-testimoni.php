<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Testimoni
                <small>Berikut ini adalah Testimoni dari para pengguna.</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Surel Pengguna</th>
                                        <th>Testimoni</th>
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
                                            <td><?php echo htmlspecialchars($val->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($val->testimoni, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <?php echo (($val->is_tampil == 'TIDAK') ? anchor('testimoni/testimoni-activate/' . $val->id_testimoni, '<span class="label label-info">TIDAK</span>') : anchor('testimoni/testimoni-activate/' . $val->id_testimoni, '<span class="label label-success">YA</span>')); ?>
                                            </td>
                                            <td>
                                                <?php echo anchor('testimoni/testimoni-delete/' . $val->id_testimoni, '<i class="material-icons">delete</i>', 'class="btn btn-danger btn-circle waves-effect waves-circle waves-float btn-hapus"'); ?>
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