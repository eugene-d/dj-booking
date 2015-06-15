<?php

namespace spec\App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\Two\ProviderInterface;
use PhpSpec\ObjectBehavior;
use App\UserRepository;
use App\Http\Controllers\Auth\AuthController;
use Prophecy\Argument;
use App;

class AuthenticateUserSpec extends ObjectBehavior
{
    function let(Factory $socialite, Guard $auth, UserRepository $users)
    {
        $this->beConstructedWith($socialite, $auth, $users);
    }

    function it_authorizes_a_user(
        Factory $socialite, AuthController $listener, ProviderInterface $provider
    )
    {
        $request = Request::create('', 'GET', ['provider' => 'twitter']);
        $provider->redirect()->shouldBeCalled();
        $socialite->driver('twitter')->willReturn($provider);
        $this->execute($request, $listener);
    }
}
