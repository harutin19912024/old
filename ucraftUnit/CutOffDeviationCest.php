<?php

namespace App\Tests\Api;

use ApiTester;
use Codeception\Util\HttpCode;
use Doctrine\Common\Collections\Criteria;
use Interflora\AuthApi\Security\User;

/**
 * Class CutOffDeviationCest
 */
class CutOffDeviationCest
{

    /**
     * @param ApiTester $I
     */
    public function _before(ApiTester $I)
    {
        $I->haveValidJwtToken();
    }

    /**
     * @param ApiTester $I
     */
    public function removeOldCutOffDeviations(ApiTester $I)
    {
        $I->haveValidJwtToken([User::ROLE_CUSTOMER_SERVICE]);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(sprintf('/api/florists'), $I->wantExampleFlorist(1241));
        $I->seeResponseCodeIs(HttpCode::CREATED);

        $I->wantTo('Remove old cut of deviations');
        $I->sendGET('/api/florists');

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->haveValidResponse();

        $ids = $I->grabDataFromResponseByJsonPath("$['hydra:member'][*][id]");
        $I->assertTrue(count($ids) > 0);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(sprintf('/api/cut_off_exceptions/2025-01-01/2025-01-01/15:00'), json_encode([$ids[0]]));
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST(sprintf('/api/cut_off_exceptions/2015-01-01/2015-01-01/11:00'), json_encode([$ids[0]]));
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->sendGET('/api/cut-of-deviations');
        $ids = $I->grabDataFromResponseByJsonPath("$['hydra:member'][*][id]");
        $I->assertCount(2, $ids, 'Must be two cut of deviations before they are removed');

        $I->haveHttpHeader('X-Appengine-Cron', true);
        $I->sendGet('/tasks/log/remove-cut-off-deviation');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->sendGET('/api/cut-of-deviations');
        $ids = $I->grabDataFromResponseByJsonPath("$['hydra:member'][*][id]");
        $I->assertCount(1, $ids, 'Must be one cut of deviation as old ones must be removed');
    }
}
