<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class KeluargakuModel extends Model
{
    use HasFactory;
    
    protected $table = 'warga';
    protected $primaryKey = 'nik';

    protected $fillable = ['nik','nomor_kk', 'nama'];

    public function kepalaKeluarga(): BelongsTo{
        return $this->belongsTo(WargaModel::class, 'nik');
    }

    public function angggota(): HasMany{
        return $this->hasMany(WargaModel::class, 'nomor_kk');
    }
    public function user(): HasOne{
        return $this->hasOne(UserModel::class, 'username');
    }
}

