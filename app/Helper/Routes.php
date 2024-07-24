<?php

namespace App\Helper;

class Routes
{
    public static function getIndexRoute(): string
    {
        $user = auth()->user();
        if (!$user) {
            return route('index');
        }

        if ($user->hasRoleIn(['ADMIN_PJKO', 'ADMIN_IKOR', 'ADMIN_PKO'])) {
            return route('admin.index');
        } else if($user->hasRoleIn(['WD1', 'WD2', 'WD3', 'DEKAN'])){
            return route('validator.index');
        } else {
            return route('user.index');
        }
    }

    public static function getLogInRoute(): string
    {
        $isSignInViaKeycloak = session('auth_provider') == 'keycloak' ||
            config('auth.provider') == ['keycloak'];

        if ($isSignInViaKeycloak) {
            return route('auth.keycloak.login');
        }

        return route('auth.login');
    }
}
