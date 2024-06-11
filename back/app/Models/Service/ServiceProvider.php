<?php

namespace App\Models\Service;

use App\Models\User\User;
use App\Observers\ServiceProviderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceProvider extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'service_providers';

    protected $fillable = [
        'user_id',
        'service_id',
        'blockchain_id',
        'score',
        'price',
        'minPrice',
        'trustedScore',
        'popularScore',
    ];

    public function Service()
    {
        return $this->belongsTo(Service::class,
            'service_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class,
            'user_id');
    }

    public function scopeSearch($query, $inputSearch)
    {
        if (
            array_key_exists('id', $inputSearch) &&
            $inputSearch['id'] != ''
        ) {
            $query->where('id', $inputSearch['id']);
        }
        if (
            array_key_exists('user_id', $inputSearch) &&
            $inputSearch['user_id'] != ''
        ) {
            $query->where('user_id', $inputSearch['user_id']);
        }
        if (
            array_key_exists('blockchain_id', $inputSearch) &&
            $inputSearch['blockchain_id'] != ''
        ) {
            $query->where('blockchain_id', $inputSearch['blockchain_id']);
        }
        if (
            array_key_exists('service_id', $inputSearch) &&
            $inputSearch['service_id'] != ''
        ) {
            $query->where('service_id', $inputSearch['service_id']);
        }
        if (
            array_key_exists('title', $inputSearch) &&
            !empty($inputSearch['title'])
        ) {
            $query->whereHas('service', function ($q) use ($inputSearch) {
                $q->where('title', 'LIKE', "%{$inputSearch['title']}%");
            });
        }

    }
}
