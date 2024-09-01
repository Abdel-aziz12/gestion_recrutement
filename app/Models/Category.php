<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable = ['nom', 'code', 'user_id', 'is_active'];
    protected $guarded = ['created_at', 'deleted_at', 'updated_at'];

    public function candidatures (){
        return $this->hasMany(Candidature::class, 'category_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
