<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RajaOngkir extends CI_Controller
{

    public function index()
    {
        $this->load->view('v_rajaongkir');
    }

    public function kota($provinsi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=" . $provinsi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 21f84155b3b634dd01992c59564facfc"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $kota = json_decode($response, true);
            if ($kota['rajaongkir']['status']['code'] == '200') {
                foreach ($kota['rajaongkir']['results'] as $kt) {
                    echo "<option value = '$kt[city_id]'> $kt[city_name] </option>";
                }
            }
        }
    }
}
