<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\UpSellingProducts;

use Spryker\Glue\CartsRestApi\CartsRestApiConfig;
use Spryker\Glue\GlueApplication\Rest\RequestConstantsInterface;
use Spryker\Glue\ProductLabelsRestApi\ProductLabelsRestApiConfig;
use Spryker\Glue\ProductsRestApi\ProductsRestApiConfig;
use Spryker\Glue\UpSellingProductsRestApi\UpSellingProductsRestApiConfig;
use SprykerTest\Glue\Testify\Tester\ApiEndToEndTester;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
 */
class UpSellingProductsApiTester extends ApiEndToEndTester
{
    use _generated\UpSellingProductsApiTesterActions;

    /**
     * @param string[] $includes
     *
     * @return string
     */
    public function formatQueryInclude(array $includes = []): string
    {
        if (!$includes) {
            return '';
        }

        return sprintf('?%s=%s', RequestConstantsInterface::QUERY_INCLUDE, implode(',', $includes));
    }

    /**
     * @param string $cartUuid
     * @param string[] $includes
     *
     * @return string
     */
    public function buildCartUpSellingProductsUrl(string $cartUuid, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceCarts}/{cartUuid}/{resourceUpSellingProducts}' . $this->formatQueryInclude($includes),
            [
                'resourceCarts' => CartsRestApiConfig::RESOURCE_CARTS,
                'resourceUpSellingProducts' => UpSellingProductsRestApiConfig::RELATIONSHIP_NAME_UP_SELLING_PRODUCTS,
                'cartUuid' => $cartUuid,
            ]
        );
    }

    /**
     * @param string $cartUuid
     * @param string[] $includes
     *
     * @return string
     */
    public function buildGuestCartUpSellingProductsUrl(string $cartUuid, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceGuestCarts}/{cartUuid}/{resourceUpSellingProducts}' . $this->formatQueryInclude($includes),
            [
                'resourceGuestCarts' => CartsRestApiConfig::RESOURCE_GUEST_CARTS,
                'resourceUpSellingProducts' => UpSellingProductsRestApiConfig::RELATIONSHIP_NAME_UP_SELLING_PRODUCTS,
                'cartUuid' => $cartUuid,
            ]
        );
    }

    /**
     * @param string $productAbstractSku
     * @param string[] $includes
     *
     * @return string
     */
    public function buildProductAbstractUrl(string $productAbstractSku, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceAbstractProducts}/{productAbstractSku}' . $this->formatQueryInclude($includes),
            [
                'resourceAbstractProducts' => ProductsRestApiConfig::RESOURCE_ABSTRACT_PRODUCTS,
                'productAbstractSku' => $productAbstractSku,
            ]
        );
    }

    /**
     * @param string $productConcreteSku
     * @param string[] $includes
     *
     * @return string
     */
    public function buildProductConcreteUrl(string $productConcreteSku, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceConcreteProducts}/{productConcreteSku}' . $this->formatQueryInclude($includes),
            [
                'resourceConcreteProducts' => ProductsRestApiConfig::RESOURCE_CONCRETE_PRODUCTS,
                'productConcreteSku' => $productConcreteSku,
            ]
        );
    }

    /**
     * @param int $idProductLabel
     * @param string[] $includes
     *
     * @return string
     */
    public function buildProductLabelUrl(int $idProductLabel, array $includes = []): string
    {
        return $this->formatFullUrl(
            '{resourceProductLabels}/{idProductLabel}' . $this->formatQueryInclude($includes),
            [
                'resourceProductLabels' => ProductLabelsRestApiConfig::RESOURCE_PRODUCT_LABELS,
                'idProductLabel' => $idProductLabel,
            ]
        );
    }
}
