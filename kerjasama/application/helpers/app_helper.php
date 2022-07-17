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
