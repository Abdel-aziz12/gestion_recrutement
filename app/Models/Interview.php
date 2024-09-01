<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'interviews';
    protected $fillable = ['date', 'time', 'cand_id', 'user_id'];
    protected $guarded = ['created_at', 'deleted_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidatures()
    {
        return $this->belongsTo(Candidature::class, 'cand_id');
    }

    public function notification()
    {
        return $this->belongsTo(Notif::class, 'interview_id');
    }


}
