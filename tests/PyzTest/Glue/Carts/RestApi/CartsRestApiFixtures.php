<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace PyzTest\Glue\Carts\RestApi;

use Generated\Shared\Transfer\ProductConcreteTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use PyzTest\Glue\Carts\CartsApiTester;
use SprykerTest\Shared\Testify\Fixtures\FixturesBuilderInterface;
use SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface;

/**
 * Auto-generated group annotations
 * @group PyzTest
 * @group Glue
 * @group Carts
 * @group RestApi
 * @group ProductAbstractRestFixtures
 * Add your own group annotations below this line
 * @group EndToEnd
 */
class CartsRestApiFixtures implements FixturesBuilderInterface, FixturesContainerInterface
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransfer;

    /**
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function getQuoteTransfer(): QuoteTransfer
    {
        return $this->quoteTransfer;
    }

    /**
     * @param \PyzTest\Glue\Carts\CartsApiTester $I
     *
     * @return \SprykerTest\Shared\Testify\Fixtures\FixturesContainerInterface
     */
    public function buildFixtures(CartsApiTester $I): FixturesContainerInterface
    {
        return $this;
    }
}
