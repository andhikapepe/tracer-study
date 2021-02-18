<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Event</h2><small>Ubah data</small>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Update agenda kegiatan yang akan berlangsung
                        </h2>
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
                        <?php echo form_open_multipart('event/event-edit/' . $id_event['value'], 'class="form-horizontal"') ?>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="event_title">Judul</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo form_input($event_title, $event_title['value'], 'class="form-control" placeholder="Masukkan judul kegiatan" required') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo
                            form_textarea($deskripsi, '', 'id="ckeditor" required');
                        ?>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="tanggal_event">Tanggal Event</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo form_input($tanggal_event, $tanggal_event['value'], 'class="form-control" placeholder="Masukkan Tanggal pelaksanaan kegiatan" required') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="upload">Gambar</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php echo form_upload($gambar); ?>
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($gambar['value'])) { ?>
                                <div class="col-md-2">
                                    <a href="<?php echo site_url('uploads/gambar-event/' . $gambar['value']); ?>" class="thumbnail">
                                        <?php echo img('uploads/gambar-event/' . $gambar['value'], 'class="img-responsive"') ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                <?php echo form_submit('simpan-event', 'Simpan', 'class="btn btn-primary m-t-15 waves-effect"') ?>
                                <?php echo anchor('event/m-event', 'Kembali', 'class="btn btn-warning m-t-15 waves-effect"') ?>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>