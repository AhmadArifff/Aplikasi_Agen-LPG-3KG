<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModels;
use App\Models\PeriodePembayaranModels;
use App\Models\PaketBarangModels;
use App\Models\TransaksiModels;
use App\Models\CicilanModels;
use App\Models\LogCicilanModels;
use App\Models\PengambilanPaketBarangModels;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class CoordinatorControllers extends BaseController
{
    public function __construct()
    {
        if (session()->get('u_role') != "coordinator") {
            echo 'Access denied';
            exit;
        }
    }

    public function PaketCicilan()
    {
        $cicilanModels = new CicilanModels();
        $paketbarang = new PaketBarangModels();
        $pengambilanpaketbarang = new PengambilanPaketBarangModels();
        $u_id = $this->request->getPost('u_id');
        $p_id = $this->request->getPost('p_id');
        $kab = $cicilanModels->paketcicilan($u_id);
        $cicilan = $cicilanModels->findAll();
        $pengambilanpaket = $pengambilanpaketbarang->get_pengambilan_paket_by_idi('pp_p_id', $p_id);
        $itembarang = $pengambilanpaketbarang->get_all_item_barang();
        echo '<option value="">--Pilih Paket Cicilan--</option>';
        foreach ($kab as $value => $k) {
            $tampil = '';
            foreach ($pengambilanpaket as $tb_pengambilan_paket) {
                if ($k['p_id'] == $tb_pengambilan_paket['pp_p_id']) {
                    foreach ($itembarang as $tb_item_barang) {
                        $sb = $tb_pengambilan_paket['pp_ib_id'];
                        if ($sb == $tb_item_barang['ib_id']) {
                            $tampil .= $tb_item_barang['p_nama'] . ", ";
                        }
                    }
                }
            }
            if (!empty($tampil)) {
                echo "<option value=" . $k['t_id'] . ">" . rtrim($tampil, ", ") . " - Jumlah Paket :" . $k['t_qty'] . "</option>";
            }
        }
    }
    public function PaketLogCicilan()
    {
        $cicilanModels = new CicilanModels();
        $pengambilanpaketbarang = new PengambilanPaketBarangModels();
        $u_id = $this->request->getPost('u_id');
        $kab = $cicilanModels->get_cicilan($u_id);
        $transaksi = $cicilanModels->paketcicilan($u_id);
        $datapaket = $cicilanModels->datapaket();
        echo '<option value="">--Pilih Paket Cicilan--</option>';
        foreach ($kab as $value => $k) {
            $tampil = '';
            foreach ($transaksi as $tb_transaksi) {
                foreach ($datapaket as $tb_paket) {
                    if ($tb_transaksi['p_id'] == $tb_paket['p_id']) {
                        $tampil .= $tb_paket['p_nama'];
                        $qty = $tb_transaksi['t_qty'];
                    }
                }
            }
        }
        if (!empty($tampil)) {
            echo "<option value=" . $k['c_id'] . ">" . rtrim($tampil, ", ") . " - Jumlah Paket :" . $qty . "</option>";
        }
    }
    public function ShowPayperiode()
    {
        $paketbarang = new PaketBarangModels();
        $transaksi = new TransaksiModels();
        $p_id = $this->request->getPost('p_id');
        $Harga = $transaksi->HargaPaket($p_id);
        $dataperiode = $paketbarang->datapayperiode();
        // $datapaket = $paketbarang->datapaketbarangbyid($p_id);
        $tampil = ''; // variabel $tampil harus dideklarasikan di luar loop agar bisa bertambah satu
        foreach ($Harga as $value => $periode) {
            foreach ($dataperiode as $key => $value) {
                if ($p_id == $periode['p_id']) {
                    $pe_id = $periode['pe_id'];
                    if ($pe_id == $value['pe_id']) {
                        $tampil .= "<option value=" . $value['pe_id'] . ">" . rtrim($value['pe_nama']) . "</option>";
                        // nilai $tampil harus ditambahkan dengan hasil penggabungan string baru agar bertambah satu
                    }
                }
            }
        }
        if (!empty($tampil)) {
            echo $tampil; // nilai $tampil sekarang digunakan di sini untuk menampilkan semua opsi pada elemen select
        }
    }
    public function TotalHarga()
    {
        $transaksi = new TransaksiModels();
        $p_id = $this->request->getPost('p_id');
        $Harga = $transaksi->HargaPaket($p_id);
        foreach ($Harga as $value => $H) {
            // echo "<option value=" . $H['id_kabupaten'] . ">" . $H['nama_kabupaten'] . "</option>";
            echo "<input type=" . "text" . " name=" . "p_hargapaket" . " class=" . "form-control " . " placeholder=" . "Masukan Cashback Paket Barang" . " hidden required  value=" . $H['p_hargaJual'] . ">";
            // echo "value=" . $H['pa_harga'] . ">";
        }
    }
    public function index()
    {
        $UsersModels = new UsersModels();
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
            // 'countdatauser' => $UsersModels->countAllResults(),
        ];
        return view('coordinator/dashboard', $menu);
    }

    //--------------------------------------------------------------------------
    //Data Transaksi Pembayaran
    public function transaksi()
    {
        $paketbarang = new PaketBarangModels();
        $transaksi = new TransaksiModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataKategoriPaket' => '',
            'DataPackingBarang' => '',
            'DataPaketBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => 'datatransaksi',
            'DataPaket' => $transaksi->datapaket(),
            'DataUser' => $transaksi->datauser(),
            'payperiode' => $paketbarang->datapayperiode(),
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => '',


        ];
        return view('coordinator/DataTransaksi/TransaksiPaket/transaksi', $data);
        // return view('register');
    }
    public function transaksiprocess()
    {
        if (!$this->validate([
            // 'u_id' => 'required',
            'p_id' => 'required',
            't_qty' => 'required',
            // 't_status' => 'required',
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $hargapaket = $this->request->getVar('p_hargapaket');
        $p_id = $this->request->getVar('p_id');
        $qty = $this->request->getVar('t_qty');
        $u_id = $this->request->getVar('u_id');
        // $u_id = session()->get('u_id');
        $total = $hargapaket * $qty;
        $transaksi = new TransaksiModels();
        $transaksi->insert([
            'u_id' => $u_id,
            'p_id' => $p_id,
            'pe_id' => $this->request->getVar('pe_id'),
            't_qty' => $qty,
            't_totalharga' => $total,
            // 't_status' => $this->request->getVar('t_status')
        ]);
        // $cicilan = new CicilanModels();
        // $datapaket = $transaksi->HargaPaket($p_id);
        // foreach ($datapaket as $value => $k) {
        //     $hargajual = $k['p_hargaJual'];
        // }
        // $number = 0;
        // for ($i = 0; $i < $qty; $i++) {
        //     $cicilan->insert([
        //         'u_id' => $u_id,
        //         'p_id' => $p_id,
        //         't_id' => $transaksi->getInsertID(),
        //         'pe_id' => $this->request->getVar('pe_id'),
        //         'c_total_cicilan' => $hargajual,
        //         'c_total_biaya' => $hargajual,
        //         'c_cicilan_masuk' => $number,
        //         'c_cicilan_outstanding' => $number,
        //         'c_biaya_masuk' => $number,
        //         'c_biaya_outstanding' => $number,
        //         // 't_status' => $this->request->getVar('t_status')
        //     ]);
        // }
        session()->setFlashdata('success', 'Data Berhasil Disimpan!');
        return redirect()->to('/coordinator/datatransaksi/transaksi');
    }
    public function listdatatransaksi()
    {
        $paketbarang = new PaketBarangModels();
        $transaksi = new TransaksiModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'DataPackingBarang' => '',
            'MenuDataBarang' => '',
            'DataPaketBarang' => '',
            'DataKategoriPaket' => '',
            'DataTransaksiCicilan' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => 'datatransaksi',
            'DataPaket' => $transaksi->datapaket(),
            'DataUser' => $transaksi->datauser(),
            'payperiode' => $paketbarang->datapayperiode(),
            'DataTransaksiLogCicilan' => '',


        ];
        $data['tb_transaksi'] = $transaksi->findAll();
        echo view('coordinator/DataTransaksi/TransaksiPaket/datatransaksi', $data);
        //berdasarkan login
        // $user = new UsersModels();
        // $data['tb_user'] = $user->where('u_referensi', session('u_id'))->findAll();
        // echo view('coordinator/datauser', $data);
    }
    public function editapprovedtransaksi($p_id)
    {
        $paketbarang = new PaketBarangModels();
        $transaksi = new TransaksiModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'DataPaketBarang' => '',
            'DataKategoriPaket' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => 'datatransaksi',
            'DataPaket' => $transaksi->datapaket(),
            'DataUser' => $transaksi->datauser(),
            'payperiode' => $paketbarang->datapayperiode(),
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => '',


        ];
        $data['tb_transaksi'] = $transaksi->findAll();
        if ($p_id != null) {
            $transaksi->update($p_id, [
                't_approval_by' => session()->get('u_id')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Di Setujui!');
            return redirect('coordinator/datatransaksi/datatransaksi');
        }
        echo view('coordinator/DataTransaksi/TransaksiPaket/datatransaksi', $data);
    }
    public function editnoapprovedtransaksi($p_id)
    {
        $paketbarang = new PaketBarangModels();
        $transaksi = new TransaksiModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'DataKategoriPaket' => '',
            'DataPaketBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => 'datatransaksi',
            'DataPaket' => $transaksi->datapaket(),
            'DataUser' => $transaksi->datauser(),
            'payperiode' => $paketbarang->datapayperiode(),
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => '',

        ];
        $data['tb_transaksi'] = $transaksi->findAll();
        if ($p_id != null) {
            $transaksi->update($p_id, [
                't_approval_by' => session()->get('u_id')
            ]);
            session()->setFlashdata('success', 'Data Berhasil Di Setujui!');
            return redirect('coordinator/datatransaksi/datatransaksi');
        }
        echo view('coordinator/DataTransaksi/TransaksiPaket/datatransaksi', $data);
    }
    public function edittransaksi($t_id)
    {
        $paketbarang = new PaketBarangModels();
        $transaksi = new TransaksiModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'DataKategoriPaket' => '',
            'DataPaketBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => 'datatransaksi',
            'DataPaket' => $transaksi->datapaket(),
            'DataUser' => $transaksi->datauser(),
            'payperiode' => $paketbarang->datapayperiode(),
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => '',

        ];
        // ambil artikel yang akan diedit

        $data['tb_transaksi'] = $transaksi->where('t_id', $t_id)->first();

        // lakukan validasi data artikel
        $validation = \Config\Services::validation();
        $validation->setRules([
            'u_id' => 'required',
            'p_id' => 'required',
            't_qty' => 'required',
            // 't_status' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();

        // jika data vlid, maka simpan ke database
        if ($isDataValid) {
            $hargapaket = $this->request->getVar('p_hargapaket');
            $hargapaketedit = $this->request->getVar('t_totalhargaedit');
            if ($hargapaket != null) {
                $lookuphargapaket = $hargapaket;
            } else {
                $lookuphargapaket = $hargapaketedit;
            }
            $u_id = session()->get('u_id');
            $qty = $this->request->getVar('t_qty');
            $total = $lookuphargapaket * $qty;
            $u_id = $this->request->getVar('u_id');
            $pe_id = $this->request->getVar('pe_id');
            $p_id = $this->request->getVar('p_id');
            $transaksi->update($t_id, [
                'u_id' => $u_id,
                'p_id' => $p_id,
                'pe_id' => $pe_id,
                't_qty' => $qty,
                't_totalharga' => $total,
                // 't_status' => $this->request->getVar('t_status')
            ]);
            $cicilan = new CicilanModels();
            // $datacicilan = $cicilan->get_cicilanby_t_id($t_id);
            // $datacicilan1 = $cicilan->paketcicilanby_t_id($t_id);
            // foreach ($datacicilan as $value => $data) {
            //     foreach ($datacicilan1 as $value => $data1) {
            //         if ($data['t_id'] == $data1['t_id']) {
            //             $u_id1 = (int)$data1['u_id'];
            //             $p_id1 = (int)$data1['p_id'];
            //             $pe_id1 = (int)$data1['pe_id'];
            //             $t_qty1 = (int)$data1['t_qty'];
            //         }
            //     }
            // }
            $datapaket = $transaksi->HargaPaket($p_id);
            foreach ($datapaket as $value => $k) {
                $hargajual = $k['p_hargaJual'];
            }
            $number = 0;
            // if ($qty != $t_qty1 || $p_id != $p_id1 || $u_id != $u_id1 || $pe_id != $pe_id1) {
            //     $cicilan->deletecicilan($t_id);

            //     for ($i = 0; $i < $qty; $i++) {
            //         $cicilan->insert([
            //             'u_id' => $this->request->getVar('u_id'),
            //             'p_id' => $p_id,
            //             't_id' => $t_id,
            //             'pe_id' => $this->request->getVar('pe_id'),
            //             'c_total_cicilan' => $hargajual,
            //             'c_total_biaya' => $hargajual,
            //             'c_cicilan_masuk' => $number,
            //             'c_cicilan_outstanding' => $number,
            //             'c_biaya_masuk' => $number,
            //             'c_biaya_outstanding' => $number,
            //             // 't_status' => $this->request->getVar('t_status')
            //         ]);
            //     }
            // }
            if ($transaksi->where('t_id') != null) {
                $cicilan->deletecicilan($t_id);
            }

            for ($i = 0; $i < $qty; $i++) {
                $cicilan->insert([
                    'u_id' => $u_id,
                    'p_id' => $p_id,
                    't_id' => $t_id,
                    'pe_id' => $pe_id,
                    'c_total_cicilan' => $hargajual,
                    'c_total_biaya' => $hargajual,
                    'c_cicilan_masuk' => $number,
                    'c_cicilan_outstanding' => $number,
                    'c_biaya_masuk' => $number,
                    'c_biaya_outstanding' => $number,
                    // 't_status' => $this->request->getVar('t_status')
                ]);
            }

            session()->setFlashdata('success', 'Data Berhasil Di Edit!');
            return redirect('coordinator/datatransaksi/datatransaksi');
        }
        echo view('coordinator/DataTransaksi/TransaksiPaket/transaksiedit', $data);
    }
    public function deletetransaksi($p_id)
    {
        $transaksi = new TransaksiModels();
        $transaksi->delete($p_id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus!');
        return redirect('coordinator/datatransaksi/datatransaksi');
    }
    public function ImportFileExceltransaksi()
    {
        $transaksi = new TransaksiModels();
        $file = $this->request->getFile('file');
        $extension = $file->getClientExtension();
        if ($extension == 'xlsx' || $extension == 'xls') {
            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $kategori = $spreadsheet->getActiveSheet()->toArray();
            foreach ($kategori as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                $users = new UsersModels();
                $datausers = $users->findAll();
                foreach ($datausers as $setusers) {
                    if ($value[1] == $setusers['u_nama']) {
                        $user = $setusers['u_id'];
                    }
                }
                $paket = new PaketBarangModels();
                $datapaket = $paket->findAll();
                foreach ($datapaket as $setpaket) {
                    if ($value[2] == $setpaket['p_nama']) {
                        $pkt = $setpaket['p_id'];
                    }
                }
                $data = [
                    't_id ' => $value[0],
                    'u_id' => $user,
                    'p_id' => $pkt,
                    't_qty' => $value[3],
                    'waktu' => $value[4],
                    't_status' => $value[5],
                    't_approval_by' => session()->get('u_id'),

                ];
                $transaksi->insert($data);
            }
            session()->setFlashdata('success', 'Data Berhasil Diimport!');
            return redirect('coordinator/datatransaksi/datatransaksi');
        } else {
            return redirect()->back()->with('message', 'Format File Tidak Sesuai! | Extension file harus .xls atau .xlsx');
        }
    }
    public function ExportDataExceltransaksi()
    {
        $transaksi = new TransaksiModels();
        $datatransaksi = $transaksi->findAll();
        $spreadsheet = new Spreadsheet();
        $colomheader = $spreadsheet->getActiveSheet();
        $colomheader->setCellValue('A1', 'No');
        $colomheader->setCellValue('B1', 'Nama Pengambil Paket');
        $colomheader->setCellValue('C1', 'Nama Paket');
        $colomheader->setCellValue('D1', 'Jumlah Paket');
        $colomheader->setCellValue('E1', 'Waktu Transaksi Paket');
        $colomheader->setCellValue('F1', 'Status Transaksi Paket');

        $users = new UsersModels();
        $datausers = $users->findAll();
        $paket = new PaketBarangModels();
        $datapaket = $paket->findAll();
        $colomdata = 2;
        foreach ($datatransaksi as $settransaksi) {
            $colomheader->setCellValue('A' . $colomdata, ($colomdata - 1));
            foreach ($datausers as $setusers) {
                if ($settransaksi['u_id'] == $setusers['u_id']) {
                    $colomheader->setCellValue('B' . $colomdata, $setusers['u_nama']);
                }
            }
            foreach ($datapaket as $setpaket) {
                if ($settransaksi['p_id'] == $setpaket['p_id']) {
                    $colomheader->setCellValue('C' . $colomdata, $setpaket['p_nama']);
                }
            }
            $colomheader->setCellValue('D' . $colomdata, $settransaksi['t_qty']);
            $colomheader->setCellValue('E' . $colomdata, $settransaksi['waktu']);
            $colomheader->setCellValue('F' . $colomdata, $settransaksi['t_status']);
            $colomdata++;
        }
        $colomheader->getStyle('A1:F1')->getFont()->setBold(true);
        $colomheader->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $colomheader->getStyle('A1:F' . ($colomdata - 1))->applyFromArray($styleArray);

        $colomheader->getColumnDimension('A')->setAutoSize(true);
        $colomheader->getColumnDimension('B')->setAutoSize(true);
        $colomheader->getColumnDimension('C')->setAutoSize(true);
        $colomheader->getColumnDimension('D')->setAutoSize(true);
        $colomheader->getColumnDimension('E')->setAutoSize(true);
        $colomheader->getColumnDimension('F')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet1.sheet');
        header('Content-Disposition: attachment;filename=Export-Data-Transaksi.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
    //Data cicilan Pembayaran

    public function cicilan()
    {
        $paketbarang = new PaketBarangModels();
        $cicilan = new CicilanModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'DataKategoriPaket' => '',
            'DataPaketBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => '',
            'DataPaket' => $cicilan->datapaket(),
            'DataUser' => $cicilan->datauser(),
            'DataPayPeriode' => $cicilan->dataperiode(),
            'DataTransaksiFungsi' => $cicilan->datatransaksi(),
            'DataTransaksiCicilan' => 'datatransaksicicilan',
            'DataTransaksiLogCicilan' => '',


        ];
        return view('coordinator/DataTransaksi/TransaksiCicilan/cicilan', $data);
        // return view('register');
    }
    public function cicilanprocess()
    {
        if (!$this->validate([
            'u_id' => 'required',
            'p_id' => 'required',
            't_id' => 'required',
            'pe_id' => 'required',
            'c_total_cicilan' => 'required',
            'c_cicilan_masuk' => 'required',
            'c_cicilan_outstanding' => 'required',
            'c_total_biaya' => 'required',
            'c_biaya_masuk' => 'required',
            'c_biaya_outstanding' => 'required',
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $c_total_cicilan = floatval(str_replace(",", "", $this->request->getVar('c_total_cicilan')));
        $c_cicilan_masuk = floatval(str_replace(",", "", $this->request->getVar('c_cicilan_masuk')));
        $c_cicilan_outstanding = floatval(str_replace(",", "", $this->request->getVar('c_cicilan_outstanding')));
        $c_total_biaya = floatval(str_replace(",", "", $this->request->getVar('c_total_biaya')));
        $c_biaya_masuk = floatval(str_replace(",", "", $this->request->getVar('c_biaya_masuk')));
        $c_biaya_outstanding = floatval(str_replace(",", "", $this->request->getVar('c_biaya_outstanding')));
        // Validasi nilai variabel
        if (!is_numeric($c_total_cicilan) || !is_numeric($c_cicilan_masuk) || !is_numeric($c_cicilan_outstanding) || !is_numeric($c_total_biaya) || !is_numeric($c_biaya_masuk) || !is_numeric($c_biaya_outstanding)) {
            echo "Input tidak valid!";
            exit;
        }
        $cicilan = new CicilanModels();
        $cicilan->insert([
            'u_id' => $this->request->getVar('u_id'),
            'p_id' => $this->request->getVar('p_id'),
            't_id' => $this->request->getVar('t_id'),
            'pe_id' => $this->request->getVar('pe_id'),
            'c_total_cicilan' => $c_total_cicilan,
            'c_cicilan_masuk' => $c_cicilan_masuk,
            'c_cicilan_outstanding' => $c_cicilan_outstanding,
            'c_total_biaya' => $c_total_biaya,
            'c_biaya_masuk' => $c_biaya_masuk,
            'c_biaya_outstanding' => $c_biaya_outstanding
        ]);
        session()->setFlashdata('success', 'Data Berhasil Disimpan!');
        return redirect()->to('/coordinator/datatransaksi/cicilan');
    }
    public function listdatacicilan()
    {
        $paketbarang = new PaketBarangModels();
        $cicilan = new CicilanModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'DataPackingBarang' => '',
            'DataKategoriPaket' => '',
            'MenuDataBarang' => '',
            'DataPaketBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => '',
            'DataPaket' => $cicilan->datapaket(),
            'DataUser' => $cicilan->datauser(),
            'DataPayPeriode' => $cicilan->dataperiode(),
            'DataTransaksiFungsi' => $cicilan->datatransaksi(),
            'DataTransaksiCicilan' => 'datatransaksicicilan',
            'DataTransaksiLogCicilan' => '',

        ];
        $data['tb_cicilan'] = $cicilan->findAll();
        echo view('coordinator/DataTransaksi/TransaksiCicilan/datacicilan', $data);
        //berdasarkan login
        // $user = new UsersModels();
        // $data['tb_user'] = $user->where('u_referensi', session('u_id'))->findAll();
        // echo view('coordinator/datauser', $data);
    }
    public function editcicilan($c_id)
    {
        $paketbarang = new PaketBarangModels();
        $cicilan = new CicilanModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'DataKategoriPaket' => '',
            'DataPaketBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => '',
            'DataPaket' => $cicilan->datapaket(),
            'DataUser' => $cicilan->datauser(),
            'DataPayPeriode' => $cicilan->dataperiode(),
            'DataTransaksiFungsi' => $cicilan->datatransaksi(),
            'DataTransaksiCicilan' => 'datatransaksicicilan',
            'DataTransaksiLogCicilan' => '',

        ];
        // ambil artikel yang akan diedit

        $data['tb_cicilan'] = $cicilan->where('c_id', $c_id)->first();

        // lakukan validasi data artikel
        $validation = \Config\Services::validation();
        $validation->setRules([
            'u_id' => 'required',
            'p_id' => 'required',
            't_id' => 'required',
            'pe_id' => 'required',
            'c_total_cicilan' => 'required',
            'c_cicilan_masuk' => 'required',
            'c_cicilan_outstanding' => 'required',
            'c_total_biaya' => 'required',
            'c_biaya_masuk' => 'required',
            'c_biaya_outstanding' => 'required',
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if ($isDataValid) {
            $c_total_cicilan = floatval(str_replace(",", "", $this->request->getVar('c_total_cicilan')));
            $c_cicilan_masuk = floatval(str_replace(",", "", $this->request->getVar('c_cicilan_masuk')));
            $c_cicilan_outstanding = floatval(str_replace(",", "", $this->request->getVar('c_cicilan_outstanding')));
            $c_total_biaya = floatval(str_replace(",", "", $this->request->getVar('c_total_biaya')));
            $c_biaya_masuk = floatval(str_replace(",", "", $this->request->getVar('c_biaya_masuk')));
            $c_biaya_outstanding = floatval(str_replace(",", "", $this->request->getVar('c_biaya_outstanding')));
            // Validasi nilai variabel
            if (!is_numeric($c_total_cicilan) || !is_numeric($c_cicilan_masuk) || !is_numeric($c_cicilan_outstanding) || !is_numeric($c_total_biaya) || !is_numeric($c_biaya_masuk) || !is_numeric($c_biaya_outstanding)) {
                echo "Input tidak valid!";
                exit;
            }
            $cicilan->update($c_id, [
                'u_id' => $this->request->getVar('u_id'),
                'p_id' => $this->request->getVar('p_id'),
                't_id' => $this->request->getVar('t_id'),
                'pe_id' => $this->request->getVar('pe_id'),
                'c_total_cicilan' => $c_total_cicilan,
                'c_cicilan_masuk' => $c_cicilan_masuk,
                'c_cicilan_outstanding' => $c_cicilan_outstanding,
                'c_total_biaya' => $c_total_biaya,
                'c_biaya_masuk' => $c_biaya_masuk,
                'c_biaya_outstanding' => $c_biaya_outstanding
            ]);
            session()->setFlashdata('success', 'Data Berhasil Di Edit!');
            return redirect('coordinator/datatransaksi/datacicilan');
        }
        echo view('coordinator/DataTransaksi/TransaksiCicilan/cicilanedit', $data);
    }
    public function deletecicilan($c_id)
    {
        $cicilan = new CicilanModels();
        $cicilan->delete($c_id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus!');
        return redirect('coordinator/datatransaksi/datacicilan');
    }
    public function ImportFileExcelcicilan()
    {
        $cicilan = new CicilanModels();
        $file = $this->request->getFile('file');
        $extension = $file->getClientExtension();
        if ($extension == 'xlsx' || $extension == 'xls') {
            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $kategori = $spreadsheet->getActiveSheet()->toArray();
            foreach ($kategori as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                $users = new UsersModels();
                $datausers = $users->findAll();
                foreach ($datausers as $setusers) {
                    if ($value[1] == $setusers['u_nama']) {
                        $user = $setusers['u_id'];
                    }
                }
                $paket = new PaketBarangModels();
                $datapaket = $paket->findAll();
                foreach ($datapaket as $setpaket) {
                    if ($value[2] == $setpaket['p_nama']) {
                        $pkt = $setpaket['p_id'];
                    }
                }
                $transaksi = new TransaksiModels();
                $datatransaksi = $transaksi->findAll();
                foreach ($datatransaksi as $settransaksi) {
                    if ($value[3] == $settransaksi['t_status']) {
                        $trk = $settransaksi['t_id'];
                    }
                }
                $payperiode = new PeriodePembayaranModels();
                $datapayperiode = $payperiode->findAll();
                foreach ($datapayperiode as $setpayperiode) {
                    if ($value[4] == $setpayperiode['pe_periode']) {
                        $periode = $setpayperiode['pe_id'];
                    }
                }
                $data = [
                    'c_id' => $value[0],
                    'u_id' => $user,
                    'p_id' => $pkt,
                    't_id' => $trk,
                    'pe_id' => $periode,
                    'c_total_cicilan' => $value[5],
                    'c_cicilan_masuk' => $value[6],
                    'c_cicilan_outstanding' => $value[7],
                    'c_total_biaya' => $value[8],
                    'c_biaya_masuk' => $value[9],
                    'c_biaya_outstanding' => $value[10],

                ];
                $cicilan->insert($data);
            }
            session()->setFlashdata('success', 'Data Berhasil Diimport!');
            return redirect('coordinator/datacicilan/datacicilan');
        } else {
            return redirect()->back()->with('message', 'Format File Tidak Sesuai! | Extension file harus .xls atau .xlsx');
        }
    }
    public function ExportDataExcelcicilan()
    {
        $cicilan = new CicilanModels();
        $datacicilan = $cicilan->findAll();
        $spreadsheet = new Spreadsheet();
        $colomheader = $spreadsheet->getActiveSheet();
        $colomheader->setCellValue('A1', 'No');
        $colomheader->setCellValue('B1', 'Nama Pengambil Paket');
        $colomheader->setCellValue('C1', 'Nama Paket');
        $colomheader->setCellValue('D1', 'Status Cicilan Paket');
        $colomheader->setCellValue('E1', 'Jumlah Periode Cicilan');
        $colomheader->setCellValue('F1', 'Jumlah Cicilan Masuk');
        $colomheader->setCellValue('G1', 'Jumlah Cicilan Outstanding');
        $colomheader->setCellValue('H1', 'Jumlah Total Biaya');
        $colomheader->setCellValue('I1', 'Jumlah Paket');
        $colomheader->setCellValue('J1', 'Jumlah Biaya Masuk');
        $colomheader->setCellValue('K1', 'Jumlah Biaya Outstanding');

        $users = new UsersModels();
        $datausers = $users->findAll();
        $paket = new PaketBarangModels();
        $datapaket = $paket->findAll();
        $transaksi = new TransaksiModels();
        $datatransaksi = $transaksi->findAll();
        $payperiode = new PeriodePembayaranModels();
        $datapayperiode = $payperiode->findAll();
        $colomdata = 2;
        foreach ($datacicilan as $setcicilan) {
            $colomheader->setCellValue('A' . $colomdata, ($colomdata - 1));
            foreach ($datausers as $setusers) {
                if ($setcicilan['u_id'] == $setusers['u_id']) {
                    $colomheader->setCellValue('B' . $colomdata, $setusers['u_nama']);
                }
            }
            foreach ($datapaket as $setpaket) {
                if ($setcicilan['p_id'] == $setpaket['p_id']) {
                    $colomheader->setCellValue('C' . $colomdata, $setpaket['p_nama']);
                }
            }
            foreach ($datatransaksi as $settransaksi) {
                if ($setcicilan['t_id'] == $settransaksi['t_id']) {
                    $colomheader->setCellValue('D' . $colomdata, $settransaksi['t_status']);
                }
            }
            foreach ($datapayperiode as $setpayperiode) {
                if ($setcicilan['pe_id'] == $setpayperiode['pe_id']) {
                    $colomheader->setCellValue('E' . $colomdata, $setpayperiode['pe_periode']);
                }
            }
            $colomheader->setCellValue('F' . $colomdata, $setcicilan['c_total_cicilan']);
            $colomheader->setCellValue('G' . $colomdata, $setcicilan['c_cicilan_masuk']);
            $colomheader->setCellValue('H' . $colomdata, $setcicilan['c_cicilan_outstanding']);
            $colomheader->setCellValue('I' . $colomdata, $setcicilan['c_total_biaya']);
            $colomheader->setCellValue('J' . $colomdata, $setcicilan['c_biaya_masuk']);
            $colomheader->setCellValue('K' . $colomdata, $setcicilan['c_biaya_outstanding']);
            $colomdata++;
        }
        $colomheader->getStyle('A1:K1')->getFont()->setBold(true);
        $colomheader->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $colomheader->getStyle('A1:K' . ($colomdata - 1))->applyFromArray($styleArray);

        $colomheader->getColumnDimension('A')->setAutoSize(true);
        $colomheader->getColumnDimension('B')->setAutoSize(true);
        $colomheader->getColumnDimension('C')->setAutoSize(true);
        $colomheader->getColumnDimension('D')->setAutoSize(true);
        $colomheader->getColumnDimension('E')->setAutoSize(true);
        $colomheader->getColumnDimension('F')->setAutoSize(true);
        $colomheader->getColumnDimension('G')->setAutoSize(true);
        $colomheader->getColumnDimension('H')->setAutoSize(true);
        $colomheader->getColumnDimension('I')->setAutoSize(true);
        $colomheader->getColumnDimension('J')->setAutoSize(true);
        $colomheader->getColumnDimension('K')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet1.sheet');
        header('Content-Disposition: attachment;filename=Export-Data-Cicilan.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
    //Data Barang Supplier
    public function logcicilan()
    {
        $logcicilan = new LogCicilanModels();
        $transaksi = new TransaksiModels();
        $cicilanModels = new CicilanModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataKategoriPaket' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataPaketBarang' => '',
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => 'datatransaksilogcicilan',
            'DataUser' => $logcicilan->datauser(),
            'DataPaket' => $transaksi->datapaket(),
            'DataTransaksi' => $cicilanModels->datatransaksi(),
            'DataCicilan' => $cicilanModels->findAll(),


        ];
        return view('coordinator/DataTransaksi/TransaksiLogCicilan/logcicilan', $data);
        // return view('register');
    }
    public function logcicilanprocess()
    {
        $transaksi = new TransaksiModels();
        if (!$this->validate([
            'u_id' => 'required',
            'l_jumlah_bayar' => 'required',
            'l_foto' => [
                'rules' => 'uploaded[l_foto]|max_size[l_foto,1024]|mime_in[l_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi!',
                    'max_size' => 'Ukuran {field} Maksimal 1024 KB ',
                    'mime_in' => 'Format {field} harus JPG/JPEG/PNG!',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $l_jumlah_bayar = floatval(str_replace(",", "", $this->request->getVar('l_jumlah_bayar')));
        // Validasi nilai variabel
        if (!is_numeric($l_jumlah_bayar)) {
            echo "Input tidak valid!";
            exit;
        }
        $foto = $this->request->getFile('l_foto');
        $nama_file = $foto->getRandomName();
        $logcicilan = new LogCicilanModels();
        $u_id = $this->request->getVar('u_id');
        $c_id = $this->request->getVar('c_id');
        $datacicilan = $transaksi->datacicilanby_id($c_id);
        $datapaket = $transaksi->datapaket();
        foreach ($datacicilan as $tb_cicilan) {
            $p_id = $tb_cicilan['p_id'];
        }
        $datatransaksi = $transaksi->datatransaksi_by_id($p_id);
        foreach ($datatransaksi as $tb_transaksi) {
            $t_qty = $tb_transaksi['t_qty'];
        }
        foreach ($datapaket as $tb_paket) {
            if ($p_id==$tb_paket['p_id']) {
                $p_setoran = $tb_paket['p_setoran'];
            }
        }
        $jumlah_pembayaran_cicilan = $l_jumlah_bayar/$p_setoran;
        $jumlah_bayar_cicilan = $l_jumlah_bayar/$t_qty;
        // print_r($u_id.'-'.$c_id.'-'.$jumlah_bayar_cicilan.'-'.$jumlah_pembayaran_cicilan);
        $logcicilan->insert([
            'u_id' => $u_id,
            'c_id' => $c_id,
            'l_jumlah_bayar' => $jumlah_bayar_cicilan,
            'l_jumlah_pembayaran_cicilan' => $jumlah_pembayaran_cicilan,
            'l_foto' => $nama_file
        ]);
        $foto->move('foto-bukti-pembayaran', $nama_file);
        session()->setFlashdata('success', 'Data Berhasil Disimpan!');
        return redirect()->to('/coordinator/datatransaksi/logcicilan');
    }
    public function listdatalogcicilan()
    {
        $logcicilan = new LogCicilanModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataKategoriPaket' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataPaketBarang' => '',
            'DataTransaksi' => '',
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => 'datatransaksilogcicilan',
            'DataUser' => $logcicilan->datauser(),

        ];
        $data['tb_log_cicilan'] = $logcicilan->findAll();
        echo view('coordinator/DataTransaksi/TransaksiLogCicilan/datalogcicilan', $data);
        //berdasarkan login
        // $user = new UsersModels();
        // $data['tb_user'] = $user->where('u_referensi', session('u_id'))->findAll();
        // echo view('coordinator/datauser', $data);
    }
    public function editlogcicilan($l_id)
    {
        $logcicilan = new LogCicilanModels();
        $data = [
            'AdminDashboard' => '',
            'RegisterUser' => '',
            'RegisterSupplier' => '',
            'DataKategoriBarang' => '',
            'DataBarang' => '',
            'DataBarangSupplier' => '',
            'MenuDataBarang' => '',
            'DataPackingBarang' => '',
            'DataPaketBarang' => '',
            'DataKategoriPaket' => '',
            'MenuDataTransaksi' => 'menudatatransaksi',
            'DataPeriodeTransaksi' => '',
            'DataTransaksi' => '',
            'DataTransaksiCicilan' => '',
            'DataTransaksiLogCicilan' => 'datatransaksilogcicilan',
            'DataUser' => $logcicilan->datauser(),

        ];
        // ambil artikel yang akan diedit

        $data['tb_log_cicilan'] = $logcicilan->where('l_id', $l_id)->first();

        if ($this->validate([
            // 'u_id' => 'required',
            'l_jumlah_bayar' => 'required',
            'l_foto' => [
                'rules' => 'max_size[l_foto,1024]|mime_in[l_foto,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                'errors' => [
                    'uploaded' => '{field} Wajib diisi!',
                    'max_size' => 'Ukuran {field} Maksimal 1024 KB ',
                    'mime_in' => 'Format {field} harus JPG/JPEG/PNG!',
                ]
            ],
        ])) {
            $l_jumlah_bayar = floatval(str_replace(",", "", $this->request->getVar('l_jumlah_bayar')));
            // Validasi nilai variabel
            if (!is_numeric($l_jumlah_bayar)) {
                echo "Input tidak valid!";
                exit;
            }
            $u_id = session()->get('u_id');
            $foto = $this->request->getFile('l_foto');
            $prefoto = $this->request->getVar('preview');
            if ($foto->getError() == 4) {
                $nama_file = $prefoto;
            } else {
                $nama_file = $foto->getRandomName();
                if ($prefoto != '') {
                    unlink('foto-bukti-pembayaran/' . $prefoto);
                }
                $foto->move('foto-bukti-pembayaran', $nama_file);
            }
            $logcicilan->update($l_id, [
                'u_id' => $u_id,
                'l_jumlah_bayar' =>  $l_jumlah_bayar,
                'l_approval_by' => session()->get('u_id'),
                'l_foto' => $nama_file
            ]);
            session()->setFlashdata('success', 'Data Berhasil Di Edit!');
            return redirect('coordinator/datatransaksi/datalogcicilan');
        } else {
            // session()->setFlashdata('error', $this->validator->listErrors());
        }
        echo view('coordinator/DataTransaksi/TransaksiLogCicilan/logcicilanedit', $data);
    }
    public function deletelogcicilan($l_id)
    {
        $logcicilan = new LogCicilanModels();
        $logcicilanfoto = $logcicilan->datalogcicilan($l_id);
        if ($logcicilanfoto['l_foto'] == '') {
        } else {
            unlink('foto-bukti-pembayaran/' . $logcicilanfoto['l_foto']);
        }
        $logcicilan->delete($l_id);
        session()->setFlashdata('success', 'Data Berhasil Di Hapus!');
        return redirect('coordinator/datatransaksi/datalogcicilan');
    }
    public function ImportFileExcellogcicilan()
    {
        $logcicilan = new LogCicilanModels();
        $file = $this->request->getFile('file');
        $extension = $file->getClientExtension();
        if ($extension == 'xlsx' || $extension == 'xls') {
            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $kategori = $spreadsheet->getActiveSheet()->toArray();
            foreach ($kategori as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                $users = new UsersModels();
                $datausers = $users->findAll();
                foreach ($datausers as $setusers) {
                    if ($value[1] == $setusers['u_nama']) {
                        $user = $setusers['u_id'];
                    }
                    if ($value[3] == $setusers['u_nama']) {
                        $approveuser = $setusers['u_id'];
                    }
                }

                $data = [
                    'l_id' => $value[0],
                    'u_id' => $user,
                    'l_jumlah_bayar' => $value[2],
                    'l_approval_by' => $approveuser,

                ];
                $logcicilan->insert($data);
            }
            session()->setFlashdata('success', 'Data Berhasil Diimport!');
            return redirect('coordinator/datatransaksi/datalogcicilan');
        } else {
            return redirect()->back()->with('message', 'Format File Tidak Sesuai! | Extension file harus .xls atau .xlsx');
        }
    }
    public function ExportDataExcellogcicilan()
    {
        $logcicilan = new logcicilanModels();
        $datalogcicilan = $logcicilan->findAll();
        $spreadsheet = new Spreadsheet();
        $colomheader = $spreadsheet->getActiveSheet();
        $colomheader->setCellValue('A1', 'No');
        $colomheader->setCellValue('B1', 'Nama Pengambil Paket');
        $colomheader->setCellValue('C1', 'Jumlah Bayar Cicilan');
        $colomheader->setCellValue('D1', 'Waktu Pembayaran Cicilan');
        $colomheader->setCellValue('E1', 'Pembayaran Cicilan Kepada');

        $users = new UsersModels();
        $datausers = $users->findAll();
        $colomdata = 2;
        foreach ($datalogcicilan as $setlogcicilan) {
            $colomheader->setCellValue('A' . $colomdata, ($colomdata - 1));
            foreach ($datausers as $setusers) {
                if ($setlogcicilan['u_id'] == $setusers['u_id']) {
                    $colomheader->setCellValue('B' . $colomdata, $setusers['u_nama']);
                }
                if ($setlogcicilan['l_approval_by'] == $setusers['u_id']) {
                    $colomheader->setCellValue('D' . $colomdata, $setusers['u_nama']);
                }
            }
            $colomheader->setCellValue('C' . $colomdata, $setlogcicilan['l_jumlah_bayar']);
            $colomheader->setCellValue('E' . $colomdata, $setlogcicilan['l_approval_date']);
            $colomdata++;
        }
        $colomheader->getStyle('A1:E1')->getFont()->setBold(true);
        $colomheader->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];
        $colomheader->getStyle('A1:E' . ($colomdata - 1))->applyFromArray($styleArray);

        $colomheader->getColumnDimension('A')->setAutoSize(true);
        $colomheader->getColumnDimension('B')->setAutoSize(true);
        $colomheader->getColumnDimension('C')->setAutoSize(true);
        $colomheader->getColumnDimension('D')->setAutoSize(true);
        $colomheader->getColumnDimension('E')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet1.sheet');
        header('Content-Disposition: attachment;filename=Export-Data-LogCicilan.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
