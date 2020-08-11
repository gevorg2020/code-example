<?php

declare(strict_types=1);

namespace App\Tests;

use Codeception\Util\HttpCode;

class UserCest
{
    public function createAndLoginUser(ApiTester $I)
    {
        $email = 'test@test.ru';
        $password = 'password';

        $I->wantTo('Registration new user');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendPOST('/registration', [
            'email' => 'test@test.ru',
            'password' => 'password',
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);

        $I->wantTo('Authorization user');
        $I->sendPOST('/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
        $response = json_decode($I->grabResponse());

        $I->wantTo('Get currency user');
        $I->haveHttpHeader('Authorization', "Bearer $response->token");
        $I->sendGET('/currency-user');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->canSeeResponseContainsJson([
            'email' => $email,
        ]);
    }
}
