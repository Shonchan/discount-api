<?php

namespace App\Tests\Controller;

use App\Tests\AbstractControllerTestCase;
use Symfony\Component\HttpFoundation\Request;

class DiscountControllerTest extends AbstractControllerTestCase
{
    public function testDiscountController(): void
    {
        $this->client->request(
            Request::METHOD_POST,
            'https://127.0.0.1:8000/api/v1/discount/calculate',
            [
                'base_price' => 10000,
                'birth_date' => '03.02.2000',
                'payment_date' => '04.11.2026',
                'trip_start_date' => '01.05.2027'
            ]
        );
        $responseContent = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJsonDocumentMatchesSchema($responseContent, [
            'type' => 'object',
            'required' => ['totalPrice', 'totalDiscount', 'discounts'],
            'properties' => [
                'totalPrice' => [
                    'type' => 'integer',
                ],
                'totalDiscount' => [
                    'type' => 'integer',
                ],
                'discounts' => [
                    'type' => 'object',
                    'properties' => [
                        'App\Entity\ChildrenDiscount' => [
                            'type' => 'integer',
                        ],
                        'App\Entity\EarlyBookingDiscount' => [
                            'type' => 'integer',
                        ],
                    ]
                ]
            ],
        ]);
    }
}
