<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DataWargaModel extends Model
{
    use HasFactory;

    protected $table = 'data_warga';
    protected $primaryKey = 'data_warga_id';

    protected $fillable = ['nik', 'nomor_kk', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'alamat', 'rt', 'rw', 'kelurahan_desa', 'kecamatan', 'kabupaten_kota', 'provinsi', 'agama', 'pekerjaan'];

    public function warga(): HasOne{
        return $this->hasOne(WargaModel::class, 'nik');
    }
}
