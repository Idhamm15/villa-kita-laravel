<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'category',
        'slug',
        'thumbnail',
        'content',
        'is_published',
    ];
    
    // public function annuityProcess()
    // {
    //     return $this->belongsTo(PatentAnnuityProcess::class, 'annuities_process_id');
    // }
    // public function attachments()
    // {
    //     return $this->hasMany(PatentAnnuityReportAttachment::class, 'annuities_report_id');
    // }
}
