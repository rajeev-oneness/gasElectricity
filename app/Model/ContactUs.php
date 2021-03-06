<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','subject','email','phone','description'];
    
    protected $hidden = [
        'deleted_at', 'updated_at','created_at',
    ];

    public function contactBy()
    {
        return $this->belongsTo('App\User','contactedBy','id');
    }
}
