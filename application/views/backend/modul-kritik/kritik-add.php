<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Kritik</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <i class="material-icons">warning</i> Perhatian!
                        </h2><small>Kritik yang anda masukkan tidak dapat di ubah!</small>
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
                        <?php echo form_open('kritik/kritik-add', 'class="form-horizontal"') ?>
                        <?php echo form_textarea($kritik, '', 'id="ckeditor" required') ?>
                        <?php echo form_submit('simpan-kritik', 'Simpan', 'class="btn btn-primary m-t-15 waves-effect"'); ?>
                        <?php echo anchor('kritik', 'Kembali', 'class="btn btn-warning m-t-15 waves-effect"'); ?>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>