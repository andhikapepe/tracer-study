<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Testimoni</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Bagaimana menurut Anda tentang kami?</h2><small>Tuliskan beberapa kata apa-apa saja hal yang menurut anda menjadi kelebihan kami.</small>
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
                        <?php echo form_open('testimoni', 'id="form_validation"'); ?>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <?php echo
                                    form_textarea($testimoni, $testimoni['value'], 'cols="30" rows="5" class="form-control no-resize" required');
                                ?>
                                <label class="form-label">Deskripsikan disini!</label>
                            </div>
                        </div>
                        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>