<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'catergory_id',
        'job_type_id',
        'user_id',
        'vacancy',
        'salary',
        'location',
        'description',
        'benefits',
        'responsibility',
        'qualifications',
        'keywords',
        'experience',
        'company_name',
        'company_location',
        'company_website',
        'status',
        'isFeatured'
    ];


    public function jobType () {
        return $this->belongsTo(JobType::class);
    }
    public function catergory () {
        return $this->belongsTo(Catergory::class);
    }
    public function applications () {
        return $this->hasMany(JobApplication::class);
    }
    public function user () {
        return $this->belongsTo(User::class);
    }
}
