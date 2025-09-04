<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'tb_user';
    protected $primaryKey = 'u_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // mapping timestamps custom
    const CREATED_AT = 'u_created_at';
    const UPDATED_AT = 'u_updated_at';
    const DELETED_AT = 'u_deleted_at';

    protected $fillable = [
        'u_username', 'u_password', 'u_fullname', 'u_role', 'u_referensi',
        'u_email', 'u_nik', 'u_nama', 'u_tempat_lahir', 'u_tanggal_lahir',
        'u_jenis_kelamin', 'u_provinsi', 'u_kota', 'u_kelurahan',
        'u_kecamatan', 'u_kodepos',
    ];

    protected $hidden = ['u_password'];

    // Auth::attempt() akan memanggil ini untuk mendapatkan hash password
    public function getAuthPassword()
    {
        return $this->u_password;
    }
}
