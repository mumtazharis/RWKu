<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersetujuanModel extends Model
{
    use HasFactory;

    protected $table = 'persetujuan';
    protected $primaryKey = 'persetujuan_id';

    protected $fillable = ['user_id', 'jenis', 'query', 'keterangan', 'status'];

    public function user(): BelongsTo{
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
