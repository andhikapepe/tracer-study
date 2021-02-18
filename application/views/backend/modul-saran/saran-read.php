<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <?php echo anchor('saran', '<i class="material-icons">keyboard_backspace</i><span>Kembali</span>', 'class="btn btn-primary waves-effect"') ?>
                    </div>
                    <div class="body">
                        <h2><span class="label label-warning">Saran</span></h2>
                        <p class="lead">
                            Diposting Tanggal: <?php echo indonesian_date($tanggal_posting); ?>
                        </p>
                        <?php echo html_entity_decode($saran); ?>
                        <hr>
                        <?php echo (!empty($respon) ? '<h2><span class="label label-primary">Respon</span></h2>' : ''); ?>
                        <?php echo (!empty($respon) ? '<p class="lead">Ditanggapi Tanggal: ' . indonesian_date($tanggal_posting) . '</p>' : ''); ?>
                        <?php echo (!empty($respon) ? html_entity_decode($respon) : ''); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>