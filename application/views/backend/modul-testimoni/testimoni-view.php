<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                Testimoni
                <small>Berikut ini adalah Testimoni dari anda</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Silahkan tekan icon <i class="material-icons">delete</i> untuk menghapus testimoni anda.</h2>
                        <small>anda hanya diijinkan untuk menghapus testimoni dan menginputkannya ulang agar melalui proses validasi dari kami guna dapat ditampilkan dalam halaman testimoni kami</small>
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
                                        <th>Testimoni</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($testimoni['value'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php echo anchor(
                                                'testimoni/testimoni-delete/' . $this->session->userdata('id_user'),
                                                '<i class="material-icons">delete</i>',
                                                'class="btn btn-danger btn-circle waves-effect waves-circle waves-float btn-hapus"'
                                            ); ?>
                                        </td>
                                    </tr>
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