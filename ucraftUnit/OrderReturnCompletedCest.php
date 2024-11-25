<?php

namespace App\Tests\Api;

use ApiTester;
use Codeception\Util\HttpCode;
use Interflora\IposApi\Constant\OrderDeliveryStatus;
use Interflora\IposApi\Constant\OrderStatus;

class OrderReturnCompletedCest
{

    public const ORDER_GET_PATH = '/api/orders/%s';

    public const ORDER_POST_PATH = '/api/orders';

    protected const EVENT_PATH = '/shipping/events';

    /**
     * @param ApiTester $I
     */
    public function _before(ApiTester $I)
    {
        $I->haveValidJwtToken();
        $I->haveHttpHeader('Content-Type', 'application/json');
    }

    public function orderReturnCompletedFirstTest(ApiTester $I)
    {
        $I->wantTo('Move order to completed');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $order                   = $I->wantExampleOrder();
        $order['status']         = OrderStatus::PRINTED;
        $order['deliveryStatus'] = OrderDeliveryStatus::NOT_DELIVERED;
        $order['orderId']        = "5-123456-200";
        $I->sendPOST(self::ORDER_POST_PATH, $order);
        $I->seeResponseMatchesJsonType($I->wantOrderJsonType());
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $ids = $I->grabDataFromResponseByJsonPath('[id]');

        $I->sendPOST(
            self::EVENT_PATH,
            [
                "id"   => "1234",
                "type" => "OrderReturnCompleted",
                "version" => "2.0",
                "liveMode" => false,
                "dateTime" => "2022-01-20T07:03:02.412813Z",
                "data" => [
                    "order" => [
                        "id"             => "531721db-6b15-4e81-a8d5-9e0843c75dd1",
                        "creatorOrderId" => $order['orderId'],
                        "creatorId"      => "71865f82-712a-4452-8b09-d6069092e74",
                        "relationalId"   => $ids[0],
                        "tags" => [
                            "ID" . $ids[0]
                        ],
                    ],
                    "deliveryEta" => "2020-07-20T13:52:55.4507668+02:00",
                ],
            ]
        );

        $I->seeResponseCodeIs(HttpCode::ACCEPTED);

        $orderJsonType = [
            'status' => OrderStatus::RETURN,
            'deliveryStatus' => OrderDeliveryStatus::RETURN
        ];
        sleep(5);

        $I->sendGET(sprintf(self::ORDER_GET_PATH, $ids[0]));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContainsJson($orderJsonType);


        $I->sendPOST(
            self::EVENT_PATH,
            [
                "id"   => "1234",
                "type" => "OrderDeliveryCompleted",
                "version" => "2.0",
                "liveMode" => false,
                "dateTime" => "2022-01-20T07:03:02.412813Z",
                "data" => [
                    "order" => [
                        "id"             => "531721db-6b15-4e81-a8d5-9e0843c75dd1",
                        "creatorOrderId" => $order['orderId'],
                        "creatorId"      => "71865f82-712a-4452-8b09-d6069092e74",
                        "relationalId"   => $ids[0],
                        "tags" => [
                            "ID" . $ids[0]
                        ],
                    ],
                    "deliveryEta" => "2020-07-20T13:52:55.4507668+02:00",
                ],
            ]
        );

        $orderJsonType = [
            'deliveryStatus' => OrderDeliveryStatus::DELIVERED_PERSONAL,
            'status'         => OrderStatus::DELIVERED
        ];
        sleep(5);

        $I->sendGET(sprintf(self::ORDER_GET_PATH, $ids[0]));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContainsJson($orderJsonType);
    }

    public function orderReturnCompletedSecondTest(ApiTester $I)
    {
        $I->wantTo('Move order to completed');

        $I->haveHttpHeader('Content-Type', 'application/json');
        $order                   = $I->wantExampleOrder();
        $order['status']         = OrderStatus::PRINTED;
        $order['deliveryStatus'] = OrderDeliveryStatus::NOT_DELIVERED;
        $order['orderId']        = "5-123456-200";
        $I->sendPOST(self::ORDER_POST_PATH, $order);
        $I->seeResponseMatchesJsonType($I->wantOrderJsonType());
        $I->seeResponseCodeIs(HttpCode::CREATED);
        $ids = $I->grabDataFromResponseByJsonPath('[id]');

        $I->sendPOST(
            self::EVENT_PATH,
            [
                "id"   => "1234",
                "type" => "OrderReturnCompleted",
                "version" => "2.0",
                "liveMode" => false,
                "dateTime" => "2022-01-20T07:03:02.412813Z",
                "data" => [
                    "order" => [
                        "id"             => "531721db-6b15-4e81-a8d5-9e0843c75dd1",
                        "creatorOrderId" => $order['orderId'],
                        "creatorId"      => "71865f82-712a-4452-8b09-d6069092e74",
                        "relationalId"   => $ids[0],
                        "tags" => [
                            "ID" . $ids[0]
                        ],
                    ],
                    "deliveryEta" => "2020-07-20T13:52:55.4507668+02:00",
                ],
            ]
        );

        $I->seeResponseCodeIs(HttpCode::ACCEPTED);

        $orderJsonType = [
            'status' => OrderStatus::RETURN,
            'deliveryStatus' => OrderDeliveryStatus::RETURN
        ];
        sleep(5);

        $I->sendGET(sprintf(self::ORDER_GET_PATH, $ids[0]));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContainsJson($orderJsonType);


        $I->sendPOST(
            self::EVENT_PATH,
            [
                "id"   => "1234",
                "type" => "OrderAddedToRoute",
                "version" => "2.0",
                "liveMode" => false,
                "dateTime" => "2022-01-20T07:03:02.412813Z",
                "data" => [
                    "order" => [
                        "id"             => "531721db-6b15-4e81-a8d5-9e0843c75dd1",
                        "creatorOrderId" => $order['orderId'],
                        "creatorId"      => "71865f82-712a-4452-8b09-d6069092e74",
                        "relationalId"   => $ids[0],
                        "tags" => [
                            "ID" . $ids[0]
                        ],
                    ],
                    "deliveryEta" => "2020-07-20T13:52:55.4507668+02:00",
                ],
            ]
        );

        $orderJsonType = [
            'deliveryStatus' => OrderDeliveryStatus::ADDED_ROUTE,
            'status'         => OrderStatus::RETURN
        ];
        sleep(5);

        $I->sendGET(sprintf(self::ORDER_GET_PATH, $ids[0]));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContainsJson($orderJsonType);

        $I->sendPOST(
            self::EVENT_PATH,
            [
                "id"   => "1234",
                "type" => "OrderPickupCompleted",
                "version" => "2.0",
                "liveMode" => false,
                "dateTime" => "2022-01-20T07:03:02.412813Z",
                "data" => [
                    "order" => [
                        "id"             => "531721db-6b15-4e81-a8d5-9e0843c75dd1",
                        "creatorOrderId" => $order['orderId'],
                        "creatorId"      => "71865f82-712a-4452-8b09-d6069092e74",
                        "relationalId"   => $ids[0],
                        "tags" => [
                            "ID" . $ids[0]
                        ],
                    ],
                    "deliveryEta" => "2020-07-20T13:52:55.4507668+02:00",
                ],
            ]
        );

        $orderJsonType = [
            'deliveryStatus' => OrderDeliveryStatus::ON_ROUTE,
            'status'         => OrderStatus::RETURN
        ];
        sleep(5);

        $I->sendGET(sprintf(self::ORDER_GET_PATH, $ids[0]));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContainsJson($orderJsonType);

        $I->sendPOST(
            self::EVENT_PATH,
            [
                "id"   => "1234",
                "type" => "OrderDeliveryCompleted",
                "version" => "2.0",
                "liveMode" => false,
                "dateTime" => "2022-01-20T07:03:02.412813Z",
                "data" => [
                    "order" => [
                        "id"             => "531721db-6b15-4e81-a8d5-9e0843c75dd1",
                        "creatorOrderId" => $order['orderId'],
                        "creatorId"      => "71865f82-712a-4452-8b09-d6069092e74",
                        "relationalId"   => $ids[0],
                        "tags" => [
                            "ID" . $ids[0]
                        ],
                    ],
                    "deliveryEta" => "2020-07-20T13:52:55.4507668+02:00",
                ],
            ]
        );

        $orderJsonType = [
            'deliveryStatus' => OrderDeliveryStatus::DELIVERED_PERSONAL,
            'status'         => OrderStatus::DELIVERED
        ];
        sleep(5);

        $I->sendGET(sprintf(self::ORDER_GET_PATH, $ids[0]));
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseContainsJson($orderJsonType);
    }
}
