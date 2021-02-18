<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Dashboard</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">TOTAL ALUMNI</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?php echo $count_alumni; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">help</i>
                    </div>
                    <div class="content">
                        <div class="text">MENGISI DATA DIRI</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?php echo $count_data_diri; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">EVENT BULAN INI</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?php echo $count_event; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">LOWKER AKTIF</div>
                        <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?php echo $count_lowker; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>PERBANDINGAN STATUS ALUMNI</h2>
                    </div>
                    <div class="alert alert-info">
                        Data Presentase Alumni dengan status: <strong>'Bekerja', 'Belum/Tidak Bekerja' , 'Kuliah', 'Wirausaha' , 'Lainnya'.</strong>
                    </div>
                    <div class="body">
                        <link href="<?php echo base_url('assets/admin-page'); ?>/plugins/morrisjs/morris.css" rel="stylesheet" />
                        <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/raphael/raphael.min.js"></script>
                        <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/morrisjs/morris.js"></script>
                        <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/jquery/jquery.min.js"></script>

                        <div id="donut_chart"></div>
                        <script type="text/javascript">
                            var donut_chart = Morris.Donut({
                                element: 'donut_chart',
                                data: [
                                    <?php foreach ($count_status as $val) { ?> {
                                            label: <?php echo json_encode($val['status']); ?>,
                                            value: <?php echo json_encode($val['result'] . ' dari ' . $val['total'] . ' Orang (' . $val['prosentase'] . '%)'); ?>
                                        },
                                    <?php } ?>
                                ],
                                colors: ['rgb(233, 30, 99)', 'rgb(0, 188, 212)', 'rgb(255, 152, 0)', 'rgb(0, 150, 136)', 'rgb(96, 125, 139)'],
                                formatter: function(y) {
                                    return y
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>GRAFIK JUMLAH LULUSAN PER-TAHUN</h2>
                    </div>
                    <div class="alert alert-warning">
                        Grafik Alumni yang telah mengisi menu <strong>Data Diri</strong> Berdasarkan Tahun Kelulusan!
                    </div>
                    <div class="body">
                        <div id="area_chart" class="graph"></div>
                        <script>
                            $(document).ready(function() {
                                var area_chart = Morris.Area({
                                    element: 'area_chart',
                                    data: [{
                                            period: '2010',
                                            jumlah_lulus: null
                                        },
                                        <?php foreach ($count_tahun_lulus as $val) { ?> {
                                                period: <?php echo json_encode($val['tahun_lulus']); ?>,
                                                jumlah_lulus: <?php echo json_encode($val['jumlah']); ?>
                                            },
                                        <?php } ?>
                                    ],
                                    xkey: 'period',
                                    ykeys: ['jumlah_lulus'],
                                    labels: ['Jumlah Lulus'],
                                    pointSize: 5,
                                    hideHover: 'auto',
                                    lineColors: ['rgb(0, 150, 136)']
                                });
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>