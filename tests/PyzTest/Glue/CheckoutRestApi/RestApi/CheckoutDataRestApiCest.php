<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\CheckoutRestApi\RestApi;

use Codeception\Util\HttpCode;
use Generated\Shared\Transfer\CustomerTransfer;
use PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester;
use Spryker\Glue\CheckoutRestApi\CheckoutRestApiConfig;
use Spryker\Glue\ShipmentsRestApi\ShipmentsRestApiConfig;

/**
 * Auto-generated group annotations
 * @group PyzTest
 * @group Glue
 * @group CheckoutRestApi
 * @group RestApi
 * @group CheckoutDataRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CheckoutDataRestApiCest
{
    protected const NOT_EXISTED_ID_CART = 'NOT_EXISTED_ID_CART';

    protected const KEY_ACCESS_TOKEN = 'accessToken';

    /**
     * @var \PyzTest\Glue\CheckoutRestApi\RestApi\CheckoutDataRestApiFixtures
     */
    protected $fixtures;

    /**
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     *
     * @return void
     */
    public function loadFixtures(CheckoutRestApiTester $I): void
    {
        $this->fixtures = $I->loadFixtures(CheckoutDataRestApiFixtures::class);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataByWhenCustomerIsNotLoggedInShouldBeFailed(CheckoutRestApiTester $I): void
    {
        $I->sendPOST(CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA, [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => static::NOT_EXISTED_ID_CART,
                ],
            ],
        ]);

        $this->assertCheckoutDataRequest($I, HttpCode::BAD_REQUEST);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataByIdCartShouldBeSuccessful(CheckoutRestApiTester $I): void
    {
        $this->customerLogIn($I, $this->fixtures->getCustomerTransfer());

        $idCart = $this->fixtures->getQuoteTransfer()->getUuid();

        $I->sendPOST(CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA, [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => $idCart,
                ],
            ],
        ]);

        $this->assertCheckoutDataRequest($I, HttpCode::OK);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataByIncorrectIdCartShouldBeFailed(CheckoutRestApiTester $I): void
    {
        $this->customerLogIn($I, $this->fixtures->getCustomerTransfer());

        $I->sendPOST(CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA, [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => static::NOT_EXISTED_ID_CART,
                ],
            ],
        ]);

        $this->assertCheckoutDataRequest($I, HttpCode::UNPROCESSABLE_ENTITY);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataByIdCartWithSelectedShipmentMethodShouldGetShipmentMethodDetails(
        CheckoutRestApiTester $I
    ): void {
        $this->customerLogIn($I, $this->fixtures->getCustomerTransfer());

        $idCart = $this->fixtures->getQuoteTransfer()->getUuid();

        $I->sendPOST(CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA, [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => $idCart,
                    'shipment' => [
                        'idShipmentMethod' => $this->fixtures->getShipmentMethodTransfer()->getIdShipmentMethod(),
                    ],
                ],
            ],
        ]);

        $this->assertCheckoutDataRequest($I, HttpCode::OK);
        $selectedShipmentMethods = $I
            ->grabDataFromResponseByJsonPath('$.data.attributes.selectedShipmentMethods')[0];
        $selectedShipmentMethod = $selectedShipmentMethods[0];

        $I->assertNotEmpty($selectedShipmentMethods);
        $I->assertNotEmpty($selectedShipmentMethod);
        $I->assertSame($selectedShipmentMethod['name'], $this->fixtures->getShipmentMethodTransfer()->getName());
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     *
     * @return void
     */
    public function requestCheckoutDataWithIncludedShipmentMethods(CheckoutRestApiTester $I): void
    {
        $this->customerLogIn($I, $this->fixtures->getCustomerTransfer());

        $idCart = $this->fixtures->getQuoteTransfer()->getUuid();

        $url = sprintf('%s?include=%s', CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA, ShipmentsRestApiConfig::RESOURCE_SHIPMENT_METHODS);

        $I->sendPOST($url, [
            'data' => [
                'type' => CheckoutRestApiConfig::RESOURCE_CHECKOUT_DATA,
                'attributes' => [
                    'idCart' => $idCart,
                ],
            ],
        ]);

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $this->assertCheckoutDataRequestWithIncludedShipmentMethods($I);
    }

    /**
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     *
     * @return void
     */
    protected function assertCheckoutDataRequestWithIncludedShipmentMethods(
        CheckoutRestApiTester $I
    ): void {
        $idShipmentMethod = $this->fixtures->getShipmentMethodTransfer()->getIdShipmentMethod();

        $I->amSure('Returned resource has shipment method in `relationships` section.')
            ->whenI()
            ->seeSingleResourceHasRelationshipByTypeAndId('shipment-methods', $idShipmentMethod);

        $I->amSure('Returned resource has shipment method in `included` section.')
            ->whenI()
            ->seeIncludesContainsResourceByTypeAndId(ShipmentsRestApiConfig::RESOURCE_SHIPMENT_METHODS, $idShipmentMethod);
    }

    /**
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     * @param int $responseCode
     *
     * @return void
     */
    protected function assertCheckoutDataRequest(
        CheckoutRestApiTester $I,
        int $responseCode
    ): void {
        $I->seeResponseCodeIs($responseCode);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();
    }

    /**
     * @param \PyzTest\Glue\CheckoutRestApi\CheckoutRestApiTester $I
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    protected function customerLogIn(CheckoutRestApiTester $I, CustomerTransfer $customerTransfer): void
    {
        $accessToken = $I->haveAuthorizationToGlue($customerTransfer)[static::KEY_ACCESS_TOKEN];

        $I->amAuthorizedGlueUser($accessToken);
    }
}
