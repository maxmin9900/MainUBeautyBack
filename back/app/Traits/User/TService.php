<?php

namespace App\Traits\User;

use App\Models\Service\ServiceProvider;

trait TService
{
    public function Services()
    {
        return $this->hasMany(ServiceProvider::class,
            'user_id');
    }

    public function updateScores()
    {
        $trustScores = $this->Services()->average("trustedScore");
        $popularScores = $this->Services()->average("popularScore");

        $this->update([
            'trustedScore' => $trustScores,
            'popularScore' => $popularScores,
        ]);

    }
}
