<?php

function is_login()
{
    $ci = &get_instance();
    if ((!isset($_SESSION['login_smpu']))) {
        redirect(str_replace("kerjasama/", "", base_url()));
    }
    // if (strcmp($_SESSION["status_login"], 'Tata Usaha') !== 0) {
    //     redirect('');
    // }
    // if (strcmp($_SESSION["status_login"], 'Prodi') !== 0) {
    //     redirect('');
    // }
}

function format_tgl_dMY($date)
{
    return date_format(date_create($date), "d M Y");
}

function format_tgl_Ymd($date)
{
    return date_format($date, "Y-m-d");
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulann(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function set_bulan_tahun($date)
{
    return date("F Y",strtotime($date));
}

function getBulann($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
