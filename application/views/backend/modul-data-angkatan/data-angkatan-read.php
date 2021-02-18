<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <?php echo anchor('data-angkatan/data-angkatan-read-print/' . $id_data_diri, '<i class="material-icons">print</i><span>Print</span>', 'class="btn btn-default waves-effect"'); ?>
                        <?php echo anchor('data-angkatan/data-angkatan-detail/' . $tahun_lulus, '<i class="material-icons">keyboard_backspace</i><span>Kembali</span>', 'class="btn btn-primary waves-effect"'); ?>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="body table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="bg-blue">
                                            <th colspan="4">PROFIL LULUSAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-orange">
                                            <th colspan="4">Data Pribadi</th>
                                        </tr>
                                        <tr>
                                            <td rowspan="5" width="20%">
                                                <?php if (!empty($foto)) { ?>
                                                    <a href="<?php echo site_url('assets/foto-profil/' . $foto); ?>" class="thumbnail">
                                                        <?php echo img('assets/foto-profil/' . $foto, 'class="img-responsive"') ?>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td width="15%">Nama</td>
                                            <td width="5%">: </td>
                                            <td><?php echo htmlentities(ucfirst($username), ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Surel</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Program Studi</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($prodi, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($jenis_kelamin, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Tanggal Lahir</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($tempat_lahir . ', ' . indonesian_date($tanggal_lahir), ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">No. NIK</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($nik, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Alamat Domisili</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($alamat, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">No Telp.</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($no_telp, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr class="bg-red">
                                            <th colspan="4">Data Orang Tua</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Nama Ayah</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($nama_ayah, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Pekerjaan Ayah</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($pekerjaan_ayah, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Nama ibu</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($nama_ibu, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Pekerjaan ibu</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($pekerjaan_ibu, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr class="bg-teal">
                                            <th colspan="4">Data Kelulusan</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Tahun Masuk</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($tahun_masuk, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Tahun Lulus</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($tahun_lulus, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">No. Ijazah</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($no_ijazah, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">No. SKHUN</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($no_skhun, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr class="bg-amber">
                                            <th colspan="4">Status</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Status</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($status, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Deskripsi Status</td>
                                            <td>: </td>
                                            <td><?php echo htmlentities($deskripsi, ENT_QUOTES, 'UTF-8'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php echo anchor('data-angkatan/data-angkatan-detail/' . $tahun_lulus, '<i class="material-icons">keyboard_backspace</i><span>Kembali</span>', 'class="btn btn-primary waves-effect"'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>