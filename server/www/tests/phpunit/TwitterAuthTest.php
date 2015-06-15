<?php

use App\AuthenticateUser;

class TwitterAuthTest extends TestCase {


    public function testTwitterShowLoginWindow() {


        Session::start();
        $params = [
            'provider' => 'twitter',
            '_token' => csrf_token(), // Retrieve current csrf token
        ];
        $response = $this->call('GET', '/auth/twitter', $params);
        $this->assertEquals(302, $response->getStatusCode());

    }

}
