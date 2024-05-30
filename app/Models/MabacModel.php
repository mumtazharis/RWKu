<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MabacModel extends Model
{
    use HasFactory;

    protected $table = 'mabac';
    protected $primaryKey = 'mabac_id';

    protected $fillable = ['spk_id', 'skor'];

    public function mabac(): BelongsTo{
        return $this->belongsTo(SPKModel::class, 'spk_id');
    }
}
