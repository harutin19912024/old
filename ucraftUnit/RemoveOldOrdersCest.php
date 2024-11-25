<?php

namespace App\Tests\Api;

use ApiTester;
use App\Entity\Order;
use Codeception\Util\HttpCode;
use Interflora\AuthApi\Security\User;

/**
 * Class CutOffDeviationCest
 */
class RemoveOldOrdersCest
{

    public const ORDER_POST_PATH = '/api/orders';
    public const ORDER_GET_PATH = '/api/orders';

    /**
     * @param ApiTester $I
     */
    public function _before(\ApiTester $I)
    {
        $I->haveValidJwtToken();
        $I->haveHttpHeader('Content-Type', 'application/json');
    }

    /**
     * @param ApiTester $I
     */
    public function removeOrdersWithOldDeliveryDate(ApiTester $I)
    {
        $I->wantTo('Remove order with old delivery date');

        $orderForToday                    = $I->wantExampleOrder();
        $orderForToday['deliveryDate']    = (new \DateTime())->format('Y-m-d');
        $I->sendPOST(self::ORDER_POST_PATH, $orderForToday);
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $todayOrderId = $I->grabDataFromResponseByJsonPath("[id]");

        $orderForTwoYearsOld                    = $I->wantExampleOrder();
        $orderForTwoYearsOld['deliveryDate']    = (new \DateTime('-25 months'))->format('Y-m-d');
        $I->sendPOST(self::ORDER_POST_PATH, $orderForTwoYearsOld);
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $oldOrderId = $I->grabDataFromResponseByJsonPath("[id]");


        $I->haveHttpHeader('X-Appengine-Cron', true);
        $I->sendGet('/tasks/orders/clear/24/500');
        $I->seeResponseCodeIs(HttpCode::OK);


        $I->sendGET(self::ORDER_GET_PATH . '/' . $todayOrderId[0]);
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->sendGET(self::ORDER_GET_PATH . '/' . $oldOrderId[0]);
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);

    }
}
