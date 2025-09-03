<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModels extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'tb_user';
    protected $primaryKey           = 'u_id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDelete        = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        "u_username",
        "u_password",
        "u_fullname",
        "u_role",
        "u_referensi",
        "u_email",
        "u_create_at",
        "u_nik",
        "u_nama",
        "u_tempat_lahir",
        "u_tanggal_lahir",
        "u_jenis_kelamin",
        "u_provinsi",
        "u_kota",
        "u_kelurahan",
        "u_kecamatan",
        "u_kodepos"
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'u_created_at';
    protected $updatedField         = 'u_updated_at';
    protected $deletedField         = 'u_deleted_at';

    // Validation
    protected $validationRules      = [
        'u_username' => 'required|min_length[3]|max_length[20]|is_unique[tb_user.u_username]',
        'u_password' => 'required|min_length[6]',
        'u_email'    => 'required|valid_email|is_unique[tb_user.u_email]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = ['hashPassword'];
    protected $afterInsert          = [];
    protected $beforeUpdate         = ['hashPassword'];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['u_password'])) {
            $data['data']['u_password'] = password_hash($data['data']['u_password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function datauser()
    {
        return $this->findAll();
    }

    public function getuserreferensiowner()
    {
        return $this->where('u_role', 'owner')->findAll();
    }

    public function getuserreferensicoordinator()
    {
        return $this->where('u_role', 'coordinator')->findAll();
    }

    public function getuserreferensiadmin()
    {
        return $this->whereIn('u_role', ['coordinator', 'owner'])->findAll();
    }

    public function dataprovinsi()
    {
        return $this->db->table('tbl_provinsi')->get()->getResultArray();
    }

    public function datakabupaten1($id_provinsi)
    {
        return $this->db->table('tbl_kabupaten')->where('id_provinsi', $id_provinsi)->get()->getResultArray();
    }

    public function datakabupaten()
    {
        return $this->db->table('tbl_kabupaten')->get()->getResultArray();
    }

    public function datakecamatan1($id_kabupaten)
    {
        return $this->db->table('tbl_kecamatan')->where('id_kabupaten', $id_kabupaten)->get()->getResultArray();
    }

    public function datakecamatan()
    {
        return $this->db->table('tbl_kecamatan')->get()->getResultArray();
    }

    public function countdatauser($table)
    {
        return $this->db->table($table)->countAllResults();
    }
}