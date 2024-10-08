<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'state',
        'zipcode',
        'contact_phone',
        'contact_email',
        'message',
        'logo',
        'website',
        'user_id',
    ];

    // Relation to job listings
    public function jobListings(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    // Relation to users (Many-to-Many)
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user'); // Specify the pivot table
    }
}
