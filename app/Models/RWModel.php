<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RWModel extends Model
{
    use HasFactory;
    protected $table = 'rw';
    protected $primaryKey = 'rw_id';

    protected $fillable = ['kode_rw', 'nik_ketua_rt'];

    public function ketuaRW(): BelongsTo{
        return $this->belongsTo(WargaModel::class, 'nik');
    }

    public function rw(): HasMany{
        return $this->hasMany(RTModel::class, 'rw_id');
    }
}
