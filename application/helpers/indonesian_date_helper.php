<?php

defined('BASEPATH') or exit('No direct script access allowed');
if (!function_exists('indonesian_date')) {
    function indonesian_date($date)
    {
        // fungsi atau method untuk mengubah tanggal ke format indonesia
        // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
        $indonesian_month = array('Januari', 'Februari', 'Maret',
            'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember', );
        $year = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $month = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $currentdate = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
        $time = substr($date, 11);
        $result = $currentdate.' '.$indonesian_month[(int) $month - 1].' '.$year;

        return $result;
    }
}
if (!function_exists('indonesian_date_time')) {
    function indonesian_date_time($date)
    {
        // fungsi atau method untuk mengubah tanggal ke format indonesia
        // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
        $indonesian_month = array('Januari', 'Februari', 'Maret',
            'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember', );
        $year = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
        $month = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
        $currentdate = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
        $time = substr($date, 11);
        $result = $currentdate.' '.$indonesian_month[(int) $month - 1].' '.$year.', Pukul : '.$time;

        return $result;
    }
}
