<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <?php echo anchor('event', '<i class="material-icons">keyboard_backspace</i><span>Kembali</span>', 'class="btn btn-primary waves-effect"') ?>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <?php if (!empty($gambar)) { ?>
                                <div class="col-md-3">
                                    <p class="align-left">
                                        <b>Gambar</b>
                                    </p>
                                    <a href="<?php echo site_url('uploads/gambar-event/' . $gambar); ?>" class="thumbnail">
                                        <?php echo img('uploads/gambar-event/' . $gambar, 'class="img-responsive"') ?>
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="col-md-9">
                                <p class="lead">
                                    <?php echo html_escape(ucfirst($event_title)); ?>
                                </p>
                                <hr>
                                <p><b><i>Diposting pada: <?php echo htmlspecialchars(indonesian_date($tanggal_posting), ENT_QUOTES, 'UTF-8'); ?> Oleh : <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?></i></b></p>
                                <?php echo htmlspecialchars_decode($deskripsi); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>