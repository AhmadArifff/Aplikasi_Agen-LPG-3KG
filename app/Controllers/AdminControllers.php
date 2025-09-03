<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModels;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request ,$post, $load
 */




class AdminControllers extends BaseController
{
    public function __construct()
    {
        if (session()->get('u_role') != "admin") {
            echo 'Access denied';
            exit;
        }
        // $this->load->library('select2');
    }
    public function Kabupaten()
    {
        $UsersModels = new UsersModels();
        $id_provinsi = $this->request->getPost('u_provinsi');
        $kab = $UsersModels->datakabupaten1($id_provinsi);
        echo '<option value="">----Pilih Kabupaten---- </option>';
        foreach ($kab as $value => $k) {
            echo "<option value=" . $k['id_kabupaten'] . ">" . $k['nama_kabupaten'] . "</option>";
        }
    }
    public function Kecamatan()
    {
        $UsersModels = new UsersModels();
        $id_kabupaten = $this->request->getPost('u_kota');
        $kab = $UsersModels->datakecamatan1($id_kabupaten);
        echo '<option value="">----Pilih Kecamatan---- </option>';
        foreach ($kab as $value => $k) {
            echo "<option value=" . $k['id_kecamatan'] . ">" . $k['nama_kecamatan'] . "</option>";
        }
    }
    public function index()
    {
        $menu = [
            'AdminDashboard' => 'dashboard',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataKategoriPaket' => '',
            'DataBarang' => '',
            'MenuDataBarang' => '',
            'DataBarangSupplier' => '',
            'DataPackingBarang' => '',
            'DataPeriodeTransaksi' => '',
            'MenuDataTransaksi' => '',
            'DataPaketBarang' => '',
            'DataTransaksi' => '',
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => '',
            // 'NotipDataTransaksi' => $transaksi->get_datatransaksi(),
            // 'NotipDataLogCicilan' => $transaksi->get_datatransaksi(),
            // 'NotipDataUser' => $UsersModels->findAll(),
            // 'NotipDataPaket' => $transaksi->datapaket(),
            // 'countdatauser' => $UsersModels->countAllResults(),
        ];
        return view('admin/dashboard', $menu);
    }
}
