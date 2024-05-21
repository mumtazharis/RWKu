<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WargaModel extends Model
{
    use HasFactory;
    protected $table = 'warga';
    protected $primaryKey = 'nik';

   
    protected $fillable = ['nik', 'nomor_kk', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'alamat', 'rt', 'rw', 'kelurahan_desa', 'kecamatan', 'kabupaten_kota', 'provinsi', 'agama', 'pekerjaan', 'status_kependudukan'];

    public function keluarga(): HasOne{
        return $this->HasOne(KeluargaModel::class, 'nik_kepala_keluarga');
    }

    public function anggotaKeluarga(): BelongsTo{
        return $this->belongsTo(KeluargaModel::class, 'nomor_kk');
    }

    public function ketuaRT(): HasOne{
        return $this->hasOne(RTModel::class, 'nik_ketua_rt');
    }

    public function ketuaRW(): HasOne{
        return $this->hasOne(RWModel::class, 'nik_ketua_rw');
    }

    public function user(): HasOne{
        return $this->hasOne(UserModel::class, 'username');
    }

    public function keuangan(): HasMany{
        return $this->hasMany(KeuanganModel::class, 'penginput');
    }

    public function peserta(): HasMany{
        return $this->hasMany(PesertaModel::class, 'nik');
    }

   
}
