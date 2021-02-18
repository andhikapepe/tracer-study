<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="button-demo js-modal-buttons pull-right">
                <button type="button" data-color="blue" class="btn btn-warning waves-effect"><i class="material-icons">warning</i> <span>wajib dibaca</span></button>
            </div>
            <h2>Event</h2>
            <small>Daftar event yang tampil hanya dalam bulan ini.</small>
            <div class="modal fade" id="mdModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">Perhatian!</h4>
                        </div>
                        <div class="modal-body">
                            1. Agenda kegiatan adalah murni kegiatan dari pemberi informasi. </br>
                            2. Kami hanya menampilkan event kerja pada bulan ini, jika anda berminat silahkan membaca event ini lebih lanjut dan daftarkan diri anda sesuai dengan informasi yang ada.
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
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table js-basic-example dataTable">
                                <thead class="bg-blue">
                                    <tr>
                                        <th>Thumbnail</th>
                                        <th>Agenda Kegiatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($table as $val) { ?>
                                        <tr>
                                            <td class="col-xs-6 col-md-2" style="vertical-align: middle">
                                                <div>
                                                    <?php if (!$val->gambar) { ?>
                                                        <a href="<?php echo site_url('assets/admin-page/images/500x300.png'); ?>" class="thumbnail">
                                                            <img src="<?php echo site_url('assets/admin-page/images/500x300.png'); ?>" class="img-responsive">
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo site_url('uploads/gambar-event/' . $val->gambar); ?>" class="thumbnail">
                                                            <img src="<?php echo site_url('uploads/gambar-event/' . $val->gambar); ?>" class="img-responsive">
                                                        </a>
                                                    <?php } ?></div>
                                            </td>
                                            <td class="align-justify">
                                                <p>
                                                    <h2><?php echo ucfirst(htmlspecialchars($val->event_title, ENT_QUOTES, 'UTF-8')); ?></h2>
                                                </p>
                                                <p><b><i>Diposting pada: <?php echo htmlspecialchars(indonesian_date($val->tanggal_posting), ENT_QUOTES, 'UTF-8'); ?>, Oleh : <?php echo htmlspecialchars($val->email, ENT_QUOTES, 'UTF-8'); ?></i></b></p>
                                                <p><?php echo character_limiter($val->deskripsi, 300); ?><?php echo anchor('event/event-detail/' . $val->event_slug, '<i>Lanjutkan membaca</i>') ?></p>
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