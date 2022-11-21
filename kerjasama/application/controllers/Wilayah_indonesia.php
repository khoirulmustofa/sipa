<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wilayah_indonesia extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_provinsi()
    {
        // load model
        $this->load->model('Wilayah_indonesia_model');
        // leparan data provinsi_id
        $provinsi_id =  $this->input->get('provinsi_id', TRUE);
        // ambil query dari model Wilayah_indonesia_model
        $provinsi_result =  $this->Wilayah_indonesia_model->getMasterProvinsi()->result();

        $html = '<option value="">Pilih Provinsi</option>';
        foreach ($provinsi_result as $key => $value) {
            $html .= '<option value="' . $value->master_provinsi_id . '">' . $value->province_name . '</option>';
        }
        $data_response =  array(
            'status' => true,
            'provinsi_html' => $html,
        );
        echo json_encode($data_response);
    }

    public function get_kota_kabupaten()
    {
        // load model
        $this->load->model('Wilayah_indonesia_model');
        // leparan data provinsi_id
        $provinsi_id =  $this->input->get('provinsi_id', TRUE);
        // ambil query dari model Wilayah_indonesia_model
        $kota_kabupaten_result =  $this->Wilayah_indonesia_model->get_master_kota_kabupaten_by_provinsi_id($provinsi_id)->result();

        $html = '<option value="">Pilih Kota Kabupaten</option>';
        foreach ($kota_kabupaten_result as $key => $value) {
            $html .= '<option value="' . $value->master_kota_kabupaten_id . '">' . $value->kota_kabupaten_nama . '</option>';
        }
        $data_response =  array(
            'status' => true,
            'kota_kabupaten_html' => $html,
        );
        echo json_encode($data_response);
    }

    public function getKecamatan()
    {
        // load model
        $this->load->model('Wilayah_indonesia_model');
        // leparan data kota_kabupaten_id
        $kota_kabupaten_id =  $this->input->get('kabupaten_kota_id', TRUE);
        // ambil query dari model Wilayah_indonesia_model
        $kecamatan_result =  $this->Wilayah_indonesia_model->get_master_kecamatan_by_kota_kabupaten_id($kota_kabupaten_id)->result();

        $html = '<option value="">Pilih Kecamatan</option>';
        foreach ($kecamatan_result as $key => $value) {
            $html .= '<option value="' . $value->master_kecamatan_id . '">' . $value->kecamatan_nama . '</option>';
        }
        $data_response =  array(
            'status' => true,
            'kecamatan_html' => $html,
        );
        echo json_encode($data_response);
    }

    public function getKelurahan()
    {
        // load model
        $this->load->model('Wilayah_indonesia_model');
        // leparan data kota_kabupaten_id
        $kecamatan_id =  $this->input->get('kecamatan_id', TRUE);
        // ambil query dari model Wilayah_indonesia_model      
        $kelurahan_result =  $this->Wilayah_indonesia_model->get_master_kelurahan_by_kecamatan_id($kecamatan_id)->result();

        $html = '<option value="">Pilih Kelurhan / Desa</option>';
        foreach ($kelurahan_result as $key => $value) {
            $html .= '<option value="' . $value->master_kelurahan_id . '">' . $value->kelurahan_nama . '</option>';
        }
        $data_response =  array(
            'status' => true,
            'kelurahan_html' => $html,
        );
        echo json_encode($data_response);
    }
}
