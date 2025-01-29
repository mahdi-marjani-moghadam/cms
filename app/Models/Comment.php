<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'comment',
        'rate',
        'parent_id',
        'content_id',
        'company_id',
        'status'
    ];


    public function content(){
        return $this->belongsTo(Content::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

}
