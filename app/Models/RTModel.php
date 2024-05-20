<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RTModel extends Model
{
    use HasFactory;

    protected $table = 'rt';
    protected $primaryKey = 'rt_id';

    protected $fillable = ['kode_rt', 'nik_ketua_rt', 'rw_id'];

    public function tempatTinggal(): HasMany{
        return $this->hasMany(WargaModel::class, 'tempat_tinggal');
    }

    public function ketuaRT(): BelongsTo{
        return $this->belongsTo(WargaModel::class, 'nik');
    }

    public function rw(): BelongsTo{
        return $this->belongsTo(RWModel::class, 'rw_id');
    }
}
