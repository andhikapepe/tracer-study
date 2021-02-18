<script src="<?php echo base_url('assets/admin-page/js/jquery.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/admin-page/css/font-awesome.min.css'); ?>" rel="stylesheet" />
<script src="<?php echo base_url('assets/admin-page/js/toastr.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin-page/css/toastr.min.css'); ?>">

<script type="text/javascript">
    <?php if ($this->session->flashdata('success')) { ?>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } else if ($this->session->flashdata('error') || validation_errors()) {  ?>
        toastr.error(<?php echo (validation_errors()) ? json_encode(validation_errors()) : json_encode($this->session->flashdata('error')); ?>);
    <?php } else if ($this->session->flashdata('warning')) {  ?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php } else if ($this->session->flashdata('info')) {  ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>