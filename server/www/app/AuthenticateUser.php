<?php namespace App;

use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\UserRepository;
use Request;

class AuthenticateUser {

    private $socialite;
    private $auth;
    private $users;

    public function __construct(Socialite $socialite, Guard $auth, UserRepository $users) {
        $this->socialite = $socialite;
        $this->auth = $auth;
        $this->users = $users;
    }

    public function execute($request, $listener) {

        if ($request->has('provider')) {
            return $this->getAuthorizationFirst($request->provider);
        }

        $user = $this->users->findByUserNameOrCreate($this->getSocialUser($request->provider));

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst($provider) {

        return $this->socialite->driver($provider)->redirect();
    }

    private function getSocialUser($provider) {
        return $this->socialite->driver($provider)->user();
    }
}
