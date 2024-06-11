<?php

namespace App\Traits\User;

use App\Http\Resources\UserProfileResource;


trait Identity
{
    public function getLevel()
    {
        return self::LEVELS[$this->level];
    }

    public static function scopeSearch($query, $inputSearch)
    {

        if (
            array_key_exists('level', $inputSearch) &&
            $inputSearch['level'] != ''
        ) {
            $query->where('level', $inputSearch['level']);
        }
        if (
            array_key_exists('token', $inputSearch) &&
            $inputSearch['token'] != ''
        ) {
            $query->where('token', $inputSearch['token']);
        }
        if (
            array_key_exists('id', $inputSearch) &&
            $inputSearch['id'] != ''
        ) {
            $query->where('id', $inputSearch['id']);
        }
        if (
            array_key_exists('email', $inputSearch) &&
            !empty($inputSearch['email'])
        ) {
            $query->where('email', $inputSearch['email']);
        }
        if (
            array_key_exists('phone', $inputSearch) &&
            !empty($inputSearch['phone'])
        ) {
            $query->where('phone', $inputSearch['phone']);
        }
        if (
            array_key_exists('name', $inputSearch) &&
            !empty($inputSearch['name'])
        ) {
            $query->where('name', 'LIKE', "%{$inputSearch['name']}%");
        }
        if (
            array_key_exists('surname', $inputSearch) &&
            !empty($inputSearch['surname'])
        ) {
            $query->where('surname', 'LIKE', "%{$inputSearch['surname']}%");
        }
        if (
            array_key_exists('service_id', $inputSearch) &&
            !empty($inputSearch['service_id'])
        ) {
            $query->whereHas('services', function ($q) use ($inputSearch) {
                $q->where('service_id', $inputSearch['service_id']);
            });
        }
        if (
            array_key_exists('service_name', $inputSearch) &&
            !empty($inputSearch['service_name'])
        ) {
            $query->whereHas('services', function ($q) use ($inputSearch) {
                $q->whereHas('service', function ($q2) use ($inputSearch) {
                    $q2->where('title', "LIKE", "%" . $inputSearch['service_name'] . "%");
                });
            });
        }
        if (
            array_key_exists('search', $inputSearch) &&
            $inputSearch['search'] == true
        ) {
            if (array_key_exists('service_id', $inputSearch)) {
                $query->with('services', function ($q3) use ($inputSearch) {
                    $q3->orderBy($inputSearch['order'], 'desc');
                });
            } else {
                $query->orderBy($inputSearch['order'], 'desc');
            }

        }
    }


    public function getAvatar()
    {
        if ($this->avatar) {
            return url($this->avatar);
        }
        return asset('assets/images/avatar.png');
    }


    public static function findByEmail($email)
    {
        return self::where('email', $email)
            ->first();
    }

    public static function findByWalletId($walletId)
    {
        return self::where('walletId', $walletId)
            ->first();
    }

    public static function loginApi($token)
    {
        $user = self::findByWalletId($token);

        if (!$user) {
            return [
                'status' => 'invalid',
                'message' => 'Invalid Username or Password'
            ];
        }

        return [
            'status' => 'ok',
            'token' => $user->createToken('tb')->plainTextToken,
            'user' => new UserProfileResource($user),

        ];
    }

    public static function registerUser($inputs)
    {

        self::create([
            'name' => $inputs['name'],
            'email' => strtolower(trim($inputs['email'])),
            'phone' => strtolower(trim($inputs['phone'])),
            'surname' => $inputs['surname'],
            'avatar' => null,
            'level' => $inputs['level'] === 'PROVIDER' ? 2 : 1,
            'walletId' => $inputs['token'],
        ]);
        return self::loginApi($inputs['token']);
    }

}
