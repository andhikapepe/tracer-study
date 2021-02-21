<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Bursa Kerja</h2><small>Daftar Lowongan akan tampil sampai batas tanggal yang telah ditetapkan oleh pemberi informasi.</small>
        </div>
        <!-- Custom Content -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="button-demo js-modal-buttons">
                            <button type="button" data-color="light-blue" class="btn btn-warning waves-effect"><i class="material-icons">warning</i> <span>wajib dibaca</span></button>
                        </div>
                        <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="defaultModalLabel">Perhatian!</h4>
                                    </div>
                                    <div class="modal-body">
                                        1. jika anda berminat silahkan membaca lowongan ini lebih lanjut dan daftarkan diri anda sesuai dengan informasi yang ada. </br>
                                        2. Jika Anda memiliki informasi lowongan pekerjaan, silahkan tambahkan lowongan melalui icon <i class="material-icons">more_vert</i> yang ada di sebelah kanan.</br>
                                        3. Informasi dari anda akan divalidasi oleh admin terlebih dahulu untuk mengurangi kemungkinan terjadinya penipuan atau sejenisnya.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(function() {
                                $('.js-modal-buttons .btn').on('click', function() {
                                    var color = $(this).data('color');
                                    $('#mdModal .modal-content').removeAttr('class').addClass('modal-content modal-col-' + color);
                                    $('#mdModal').modal('show');
                                });
                            });
                        </script>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="<?php echo site_url('bursakerja/bursakerja-add') ?>">Tambah data</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table js-basic-example dataTable">
                                <thead class="bg-blue">
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th>Deskripsi Singkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($table as $val) { ?>
                                        <tr>
                                            <td class="col-xs-6 col-md-2" style="vertical-align: middle">
                                                <div>
                                                    <?php if (!$val->gambar) { ?>
                                                        <a href="<?php echo site_url('assets/admin-page/images/500x300.png'); ?>" class="thumbnail">
                                                            <img src="<?php echo site_url('assets/admin-page/images/500x300.png'); ?>" class="img-responsive">
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo site_url('uploads/gambar-lowongan/' . $val->gambar); ?>" class="thumbnail">
                                                            <img src="<?php echo site_url('uploads/gambar-lowongan/' . $val->gambar); ?>" class="img-responsive">
                                                        </a>
                                                    <?php } ?></div>
                                            </td>
                                            <td class="align-justify">
                                                <p>
                                                    <h2><?php echo ucfirst(htmlspecialchars($val->job_title, ENT_QUOTES, 'UTF-8')); ?></h2>
                                                </p>
                                                <p><?php echo ucfirst(htmlspecialchars($val->nama_perusahaan, ENT_QUOTES, 'UTF-8')); ?></p>
                                                <p>Bidang Usaha : <?php echo ucfirst(htmlspecialchars($val->bidang_usaha, ENT_QUOTES, 'UTF-8')); ?>, Batas waktu : <?php echo indonesian_date(htmlspecialchars($val->akhir_waktu, ENT_QUOTES, 'UTF-8')); ?></p>
                                                <p><b><i>Diposting pada: <?php echo htmlspecialchars(indonesian_date($val->tanggal_posting), ENT_QUOTES, 'UTF-8'); ?>, Oleh : <?php echo htmlspecialchars($val->email, ENT_QUOTES, 'UTF-8'); ?></i></b></p>
                                                <p><?php echo character_limiter($val->deskripsi, 300); ?><?php echo anchor('bursakerja/bursakerja-detail/' . $val->job_slug, '<i>Lanjutkan membaca</i>') ?></p>
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