 <section class="content">
     <div class="container-fluid">
         <div class="block-header">
             <h2>Data Diri</h2>
         </div>
         <div class="row clearfix">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                 <div class="card">
                     <div class="header">
                         <h2>Lengkapi data diri anda dengan sebenar-benarnya!</h2>
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
                         <div class="alert alert-warning alert-dismissible" role="alert">
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                             <i class="material-icons">warning</i> Menu akan tampil jika anda telah mengisi dan melengkapi data diri.
                         </div>
                         <?php echo form_open('data-diri', 'class="form-horizontal"'); ?>
                         <h2 class="card-inside-title">Data Pribadi</h2>
                         <hr>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="nama">Nama</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <?php echo form_input($nama, $nama['value'], 'class="form-control" disabled'); ?>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="email">Alamat Surel</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <?php echo form_input($email, $email['value'], 'class="form-control" disabled'); ?>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="prodi">Program Studi</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($prodi, '', 'class="form-control" placeholder="Masukkan program studi anda secara lengkap *misal : Teknik Komputer dan Jaringan" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="jenis_kelamin">Jenis Kelamin</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <?php
                                        $options = array(
                                            'LAKI-LAKI' => 'LAKI-LAKI',
                                            'PEREMPUAN' => 'PEREMPUAN',
                                        );
                                        echo form_dropdown($jenis_kelamin, $options, 'LAKI-LAKI', 'required'); ?>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="ttl">Tempat Tgl Lahir</label>
                             </div>
                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($tempat_lahir, '', 'class="form-control" placeholder="Tempat" required'); ?>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($tanggal_lahir, '', 'class="form-control" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="nik">Nomor NIK</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($nik, '', 'class="form-control" placeholder="Masukkan Nomor NIK valid" maxlength="16" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="alamat">Alamat</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_textarea($alamat, '', 'rows="4" class="form-control no-resize" placeholder="Masukkan Alamat Domisili Sekarang" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="no_telp">Nomor Telp/Handphone</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($no_telp, '', 'class="form-control" placeholder="Masukkan nomor telp yang bisa dihubungi"'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <h2 class="card-inside-title">Data Orang Tua</h2>
                         <hr>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="nama_ayah">Nama Ayah</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($nama_ayah, '', 'class="form-control" placeholder="Masukkan nama ayah kandung" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="pekerjaan_ayah">Pekerjaan ayah</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                 <?php $opsikerja_ayah = array(
                                            'BELUM/TIDAK BEKERJA' => 'BELUM/TIDAK BEKERJA',
                                            'MENGURUS RUMAH TANGGA' => 'MENGURUS RUMAH TANGGA',
                                            'PELAJAR/MAHASISWA' => 'PELAJAR/MAHASISWA',
                                            'PENSIUNAN' => 'PENSIUNAN',
                                            'PEGAWAI NEGERI SIPIL' => 'PEGAWAI NEGERI SIPIL',
                                            'TENTARA NASIONAL INDONESIA' => 'TENTARA NASIONAL INDONESIA',
                                            'KEPOLISIAN RI' => 'KEPOLISIAN RI',
                                            'PERDAGANGAN' => 'PERDAGANGAN',
                                            'PETANI/PEKEBUN' => 'PETANI/PEKEBUN',
                                            'PETERNAK' => 'PETERNAK',
                                            'NELAYAN/PERIKANAN' => 'NELAYAN/PERIKANAN',
                                            'INDUSTRI' => 'INDUSTRI',
                                            'KONSTRUKSI' => 'KONSTRUKSI',
                                            'TRANSPORTASI' => 'TRANSPORTASI',
                                            'KARYAWAN SWASTA' => 'KARYAWAN SWASTA',
                                            'KARYAWAN BUMN' => 'KARYAWAN BUMN',
                                            'KARYAWAN BUMD' => 'KARYAWAN BUMD',
                                            'KARYAWAN HONORER' => 'KARYAWAN HONORER',
                                            'BURUH HARIAN LEPAS' => 'BURUH HARIAN LEPAS',
                                            'BURUH TANI/PERKEBUNAN' => 'BURUH TANI/PERKEBUNAN',
                                            'BURUH NELAYAN/PERIKANAN' => 'BURUH NELAYAN/PERIKANAN',
                                            'BURUH PETERNAKAN' => 'BURUH PETERNAKAN',
                                            'PEMBANTU RUMAH TANGGA' => 'PEMBANTU RUMAH TANGGA',
                                            'TUKANG CUKUR' => 'TUKANG CUKUR',
                                            'TUKANG LISTRIK' => 'TUKANG LISTRIK',
                                            'LAINNYA' => 'LAINNYA',
                                        );
                                        echo form_dropdown($pekerjaan_ayah, $opsikerja_ayah, 'BELUM/TIDAK BEKERJA', 'class="form-control show-tick" data-live-search="true" required'); ?>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="nama_ibu">Nama Ibu</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($nama_ibu, '', 'class="form-control" placeholder="Masukkan nama ibu kandung" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <?php $opsikerja_ibu = array(
                                            'BELUM/TIDAK BEKERJA' => 'BELUM/TIDAK BEKERJA',
                                            'MENGURUS RUMAH TANGGA' => 'MENGURUS RUMAH TANGGA',
                                            'PELAJAR/MAHASISWA' => 'PELAJAR/MAHASISWA',
                                            'PENSIUNAN' => 'PENSIUNAN',
                                            'PEGAWAI NEGERI SIPIL' => 'PEGAWAI NEGERI SIPIL',
                                            'TENTARA NASIONAL INDONESIA' => 'TENTARA NASIONAL INDONESIA',
                                            'KEPOLISIAN RI' => 'KEPOLISIAN RI',
                                            'PERDAGANGAN' => 'PERDAGANGAN',
                                            'PETANI/PEKEBUN' => 'PETANI/PEKEBUN',
                                            'PETERNAK' => 'PETERNAK',
                                            'NELAYAN/PERIKANAN' => 'NELAYAN/PERIKANAN',
                                            'INDUSTRI' => 'INDUSTRI',
                                            'KONSTRUKSI' => 'KONSTRUKSI',
                                            'TRANSPORTASI' => 'TRANSPORTASI',
                                            'KARYAWAN SWASTA' => 'KARYAWAN SWASTA',
                                            'KARYAWAN BUMN' => 'KARYAWAN BUMN',
                                            'KARYAWAN BUMD' => 'KARYAWAN BUMD',
                                            'KARYAWAN HONORER' => 'KARYAWAN HONORER',
                                            'BURUH HARIAN LEPAS' => 'BURUH HARIAN LEPAS',
                                            'BURUH TANI/PERKEBUNAN' => 'BURUH TANI/PERKEBUNAN',
                                            'BURUH NELAYAN/PERIKANAN' => 'BURUH NELAYAN/PERIKANAN',
                                            'BURUH PETERNAKAN' => 'BURUH PETERNAKAN',
                                            'PEMBANTU RUMAH TANGGA' => 'PEMBANTU RUMAH TANGGA',
                                            'TUKANG CUKUR' => 'TUKANG CUKUR',
                                            'TUKANG LISTRIK' => 'TUKANG LISTRIK',
                                            'LAINNYA' => 'LAINNYA',
                                        );
                                        echo form_dropdown($pekerjaan_ibu, $opsikerja_ibu, 'BELUM/TIDAK BEKERJA', 'class="form-control show-tick" data-live-search="true" required'); ?>
                                 </div>
                             </div>
                         </div>
                         <h2 class="card-inside-title">Data Kelulusan</h2>
                         <hr>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="tahun_masuk">Tahun Masuk</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($tahun_masuk, '', 'class="form-control" placeholder="Masukkan tahun masuk sekolah" maxlength="4" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="tahun_lulus">Tahun Lulus</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($tahun_lulus, '', 'class="form-control" maxlength="4" placeholder="Masukkan Tahun Lulus"'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="no_ijazah">Nomor Ijazah</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($no_ijazah, '', 'class="form-control" placeholder="masukkan nomor ijazah"'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="no_skhun">Nomor SKHUN</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_input($no_skhun, '', 'class="form-control" placeholder="masukkan nomor SKHUN"'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <h2 class="card-inside-title">Data Status</h2>
                         <hr>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="status">Status</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php $opsistatus = array(
                                                'Bekerja'               => 'Bekerja',
                                                'Belum/Tidak Bekerja'   => 'Belum/Tidak Bekerja',
                                                'Kuliah'                => 'Kuliah',
                                                'Wirausaha'             => 'Wirausaha',
                                                'Lainnya'               => 'Lainnya',
                                            );
                                            echo form_dropdown($status, $opsistatus, 'Lainnya', 'class="form-control" required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                 <label for="deskripsi_status">Deskripsi Status</label>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                 <div class="form-group">
                                     <div class="form-line">
                                         <?php echo form_textarea($deskripsi_status, '', 'class="form-control no-resize" rows="4" placeholder="Deskripsikan status anda sekarang, bila kuliah maka kuliah dimana, jurusan apa dan isian lain sebagainya yang menurut anda cukup mendeskripsikan kondisi anda sekarang." required'); ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row clearfix">
                             <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                 <?php echo form_submit('simpan-data-diri', 'Submit', 'class="btn btn-primary m-t-15 waves-effect"'); ?>
                             </div>
                         </div>
                         <?php echo form_close(); ?>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>