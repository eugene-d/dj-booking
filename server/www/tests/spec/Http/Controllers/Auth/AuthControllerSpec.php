<?php

namespace spec\App\Http\Controllers\Auth;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;

class AuthControllerSpec extends ObjectBehavior
{
    function let(Guard $auth, Registrar $registrar)
    {
        $this->beConstructedWith($auth, $registrar);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Controllers\Auth\AuthController');
    }
}
