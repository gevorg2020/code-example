<?php

declare(strict_types=1);

namespace App\Tests\api;

use App\Tests\ApiTester;
use Codeception\Util\HttpCode;

class TrainingCest
{
    public function getTrainings(ApiTester $I)
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

        $I->wantTo('Get trainings');
        $I->haveHttpHeader('Authorization', "Bearer $response->token");
        $I->sendGET('/trainings');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->canSeeResponseIsJson();
    }
}
