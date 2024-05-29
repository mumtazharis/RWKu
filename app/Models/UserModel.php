<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['level_id', 'username', 'password'];

    public function username(): BelongsTo{
        return $this->BelongsTo(WargaModel::class, 'nik');
    }

    public function level(): BelongsTo{
        return $this->belongsTo(LevelModel::class, 'level_id');
    }

    public function persetujuan(): HasMany{
        return $this->hasMany(PersetujuanModel::class, 'user_id');
    }


}
