<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\PriceProducts\RestApi;

use Codeception\Util\HttpCode;
use PHPUnit\Framework\Assert;
use PyzTest\Glue\PriceProducts\PriceProductsApiTester;

/**
 * Auto-generated group annotations
 * @group PyzTest
 * @group Glue
 * @group PriceProducts
 * @group RestApi
 * @group PriceProductConcreteRestApiCest
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class PriceProductConcreteRestApiCest
{
    /**
     * @var \PyzTest\Glue\PriceProducts\RestApi\PriceProductsRestApiFixtures
     */
    protected $fixtures;

    /**
     * @param \PyzTest\Glue\PriceProducts\PriceProductsApiTester $I
     *
     * @return void
     */
    public function loadFixtures(PriceProductsApiTester $I): void
    {
        $this->fixtures = $I->loadFixtures(PriceProductsRestApiFixtures::class);
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\PriceProducts\PriceProductsApiTester $I
     *
     * @return void
     */
    public function requestTheNonExistingProductConcretePrices(PriceProductsApiTester $I): void
    {
        //act
        $I->sendGET('concrete-products/non-exist/concrete-product-prices');

        //assert
        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\PriceProducts\PriceProductsApiTester $I
     *
     * @return void
     */
    public function requestProductConcretePricesWithoutId(PriceProductsApiTester $I): void
    {
        //act
        $I->sendGET('concrete-product-prices');

        //assert
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST);
        $I->seeResponseIsJson();
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\PriceProducts\PriceProductsApiTester $I
     *
     * @return void
     */
    public function requestExistingProductConcretePrices(PriceProductsApiTester $I): void
    {
        //act
        $I->sendGET(
            $I->formatUrl(
                'concrete-products/{ProductConcreteSku}/concrete-product-prices',
                [
                    'ProductConcreteSku' => $this->fixtures->getProductConcreteTransfer()->getSku(),
                ]
            )
        );

        //assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('Returned resource is of type concrete-product-prices')
            ->whenI()
            ->seeResponseDataContainsResourceCollectionOfTypeWithSizeOf('concrete-product-prices', 1);

        $I->amSure('Returned resource has correct id')
            ->whenI()
            ->seeResourceCollectionHasResourceWithId($this->fixtures->getProductConcreteTransfer()->getSku());
    }

    /**
     * @depends loadFixtures
     *
     * @param \PyzTest\Glue\PriceProducts\PriceProductsApiTester $I
     *
     * @return void
     */
    public function requestExistingProductConcretePricesByCustomerWithoutAccess(PriceProductsApiTester $I): void
    {
        Assert::markTestSkipped('Permissions have to be setup correctly.');

        //act
        $I->sendGET(
            $I->formatUrl(
                'concrete-products/{ProductConcreteSku}?include=concrete-product-prices&XDEBUG_SESSION_START=PHPSTORM',
                [
                    'ProductConcreteSku' => $this->fixtures->getProductConcreteTransfer()->getSku(),
                ]
            )
        );

        //assert
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesOpenApiSchema();

        $I->amSure('Returned resource has no concrete-product-prices relationship')
            ->whenI()
            ->dontSeeSingleResourceHasRelationshipByType('concrete-product-prices');

        $I->amSure('Returned includes do not have concrete-product-prices resource')
            ->whenI()
            ->dontSeeIncludesContainsResourceByType('concrete-product-prices');
    }
}
