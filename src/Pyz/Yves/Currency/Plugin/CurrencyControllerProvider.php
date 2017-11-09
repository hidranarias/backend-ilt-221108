<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Currency\Plugin;

use Silex\Application;
use SprykerShop\Yves\ShopApplication\Plugin\Provider\AbstractYvesControllerProvider;

class CurrencyControllerProvider extends AbstractYvesControllerProvider
{
    const ROUTE_CART = 'currency-switch';

    /**
     * @param \Silex\Application $app
     *
     * @return void
     */
    protected function defineControllers(Application $app)
    {
        $this->createController(
            '/currency-switch',
            static::ROUTE_CART,
            'Currency',
            'CurrencySwitch',
            'index'
        );
    }
}
