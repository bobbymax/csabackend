<?php

namespace App\Helpers;

use App\Models\User;

class FilterObjects
{
    public static function allowedApplications(User $user, $applications)
    {
        return $applications->filter(function ($app) use ($user) {
            $groups = $app?->groups?->pluck('id')->toArray();
            $departments = $app?->departments?->pluck('id')->toArray();
            $userGroups = $user?->groups->pluck('id')->toArray();

            return in_array($user?->department_id, $departments) && array_intersect($userGroups, $groups);
        });
    }
}
