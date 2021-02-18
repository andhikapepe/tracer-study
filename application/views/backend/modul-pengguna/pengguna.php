<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Pengguna
                <small>Berikut ini adalah pengaturan untuk pengguna</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <?php echo anchor('pengguna/pengguna-add', '<i class="material-icons">directions</i><span>Tambah pengguna</span>', 'class="btn btn-primary waves-effect"') ?>
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
                                        <th>Nama</th>
                                        <th>Alamat surel</th>
                                        <th>role active</th>
                                        <th>is active?</th>
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
                                            <td><?php echo htmlspecialchars($val->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars($val->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo htmlspecialchars(ucfirst($val->role), ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <?php
                                                if (($this->session->userdata('is_admin') == TRUE) && ($val->is_admin == 1)) {
                                                    echo '<span class="label label-info">AKTIF</span>';
                                                } else {
                                                    echo (($val->is_active == 1) ? anchor('pengguna/pengguna-activate/' . $val->id, '<span class="label label-info">AKTIF</span>') : anchor('pengguna/pengguna-activate/' . $val->id, '<span class="label label-success">TIDAK AKTIF</span>'));
                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo anchor('pengguna/pengguna-edit/' . $val->id, '<i class="material-icons">edit</i>', 'class="btn btn-warning btn-circle waves-effect waves-circle waves-float"'); ?>
                                                <?php echo (($val->role_active != 1) ? anchor('pengguna/pengguna-delete/' . $val->id, '<i class="material-icons">delete</i>', 'class="btn btn-danger btn-circle waves-effect waves-circle waves-float btn-hapus"') : ''); ?>
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