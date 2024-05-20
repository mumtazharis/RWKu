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

    protected $fillable = ['nik', 'tempat_tinggal', 'kelas_ekonomi', 'status_kependudukan'];

    public function dataWarga(): BelongsTo{
        return $this->BelongsTo(DataWargaModel::class, 'nik');
    }

    public function tempatTinggal(): BelongsTo{
        return $this->BelongsTo(RTModel::class, 'rt_id');
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

    public function kepemilikan(): HasOne{
        return $this->hasOne(KepemilikanModel::class, 'nik');
    }

    public function peserta(): HasMany{
        return $this->hasMany(PesertaModel::class, 'nik');
    }

    public function iuran(): HasMany{
        return $this->hasMany(IuranModel::class, 'nik');
    }
}
