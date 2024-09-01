<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Notif extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'notification';
    protected $fillable = ['read_at', 'is_read', 'temps_notif', 'interview_id'];
    protected $guarded = ['created_at', 'deleted_at', 'updated_at'];


    public function interviews()
    {
        return $this->belongsTo(Interview::class, 'interview_id');
    }
}
