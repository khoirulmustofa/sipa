<?php

function is_login()
{
    $ci = &get_instance();
    if ((!isset($_SESSION['login_smpu']))) {
        redirect(str_replace("kerjasama/", "", base_url()));
    }
    if (strcmp($_SESSION["status_login"], 'Tata Usaha') !== 0) {
        redirect('');
    }
}

function format_tgl_dMY($date)
{
    return date_format(date_create($date), "d M Y");
}

function format_tgl_Ymd($date)
{
    return date_format($date, "Y-m-d");
}
