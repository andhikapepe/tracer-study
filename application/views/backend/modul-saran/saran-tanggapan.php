<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <?php echo anchor('saran/m-saran', '<i class="material-icons">keyboard_backspace</i><span>Kembali</span>', 'class="btn btn-primary waves-effect"') ?>
                    </div>
                    <div class="body">
                        <h2><span class="label label-warning">saran</span></h2>
                        <p class="lead">
                            Diposting Tanggal: <?php echo indonesian_date($tanggal_posting); ?>
                        </p>
                        <?php echo html_entity_decode($saran); ?>
                        <hr>
                        <h2><span class="label label-primary">Respon</span></h2>
                        <?php echo form_open('saran/tanggapi-saran/' . $id_saran); ?>
                        <?php echo form_textarea($tanggapan, $tanggapan['value'], 'id="ckeditor" required') ?>
                        <?php echo form_submit('simpan-tanggapan', 'Simpan', 'class="btn btn-primary m-t-15 waves-effect"'); ?>
                        <?php echo anchor('saran/m-saran', 'Kembali', 'class="btn btn-warning m-t-15 waves-effect"'); ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>