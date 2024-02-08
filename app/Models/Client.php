<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'adress',
        'city',
        'state',
        'zipcode',
        'telephone',
        'DOB',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'DOB' => 'date',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
