<?php
namespace App\Services;

use App\Models\SocialUser;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\SocialAccount;

class SocialAccountService
{
    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialUser::whereSocialableType($social)
        ->whereSocialableId($providerUser->getId())
        ->first();

        if ($account) {
            return $account->user;
        } else {
            $email = $providerUser->getEmail() ?? $providerUser->getNickname();
            $account = new SocialUser([
                'socialable_id' => $providerUser->getId(),
                'socialable_type' => $social
            ]);
            $user = User::whereEmail($email)->first();

            if (!$user) {
                $user = User::create([
                    'email' => $email,
                    'name' => $providerUser->getName(),
                    'password' => $providerUser->getName(),
                    'avatar' => $providerUser->getAvatar()
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}