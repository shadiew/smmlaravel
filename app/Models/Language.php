<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = "languages";
    protected $guarded = ['id'];

    public function mailTemplates()
    {
        return $this->hasMany(EmailTemplate::class, 'language_id');
    }

    public function notifyTemplates()
    {
        return $this->hasMany(NotifyTemplate::class, 'language_id');
    }

    public function contentDetails()
    {
        return $this->hasMany(ContentDetails::class, 'language_id');
    }

}
