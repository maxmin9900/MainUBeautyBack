<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'title',
        'image',
        'description',
        'score',
        'minPrice',
        'providersCount'
    ];

    public function scopeSearch($query, $inputSearch)
    {
        if (
            array_key_exists('id', $inputSearch) &&
            $inputSearch['id'] != ''
        ) {
            $query->where('id', $inputSearch['id']);
        }
        if (
            array_key_exists('title', $inputSearch) &&
            !empty($inputSearch['title'])
        ) {
            $query->where('title', 'LIKE', "%{$inputSearch['title']}%");
        }

        $sort = self::getSortParameters($inputSearch['order'] ?? '');
        if (count($sort) == 2) {
            $query->orderBy($sort[1], $sort[0]);
        }

    }

    public static function getSortParameters($order)
    {

        $arrayS = explode('-', $order);
        if (count($arrayS) != 2 ||
            array_search($arrayS[1], ['asc', 'desc']) === false ||
            array_search($arrayS[0], ['score', 'price']) === false) {
            return [
                'desc',
                'score'
            ];
        }
        return [
            $arrayS[1],
            self::getFieldName($arrayS[0]),
        ];

    }

    public static function getFieldName($fieldName)
    {
        return $fieldName == 'price' ? 'minPrice' : 'score';
    }

    public function Providers()
    {
        return $this->hasMany(ServiceProvider::class,
            'service_id');
    }
}
