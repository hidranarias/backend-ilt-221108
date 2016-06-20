<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\Checkout\Process\Steps;

use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Pyz\Yves\Application\Business\Model\FlashMessengerInterface;
use Spryker\Client\Checkout\CheckoutClientInterface;
use Spryker\Shared\Transfer\AbstractTransfer;
use Spryker\Yves\Checkout\Process\Steps\AbstractPlaceOrderStep;

class PlaceOrderStep extends AbstractPlaceOrderStep
{

    /**
     * @var \Pyz\Yves\Application\Business\Model\FlashMessengerInterface
     */
    protected $flashMessenger;

    /**
     * @param \Spryker\Client\Checkout\CheckoutClientInterface $checkoutClient
     * @param \Pyz\Yves\Application\Business\Model\FlashMessengerInterface $flashMessenger
     * @param string $stepRoute
     * @param string $escapeRoute
     * @param array $errorCodeToRouteMatching
     */
    public function __construct(
        CheckoutClientInterface $checkoutClient,
        FlashMessengerInterface $flashMessenger,
        $stepRoute,
        $escapeRoute,
        $errorCodeToRouteMatching = []
    ) {
        parent::__construct($checkoutClient, $stepRoute, $escapeRoute, $errorCodeToRouteMatching);

        $this->flashMessenger = $flashMessenger;
    }

    /**
     * @param \Spryker\Shared\Transfer\AbstractTransfer|\Generated\Shared\Transfer\QuoteTransfer $dataTransfer
     *
     * @return bool
     */
    public function preCondition(AbstractTransfer $dataTransfer)
    {
        return !$this->isCartEmpty($dataTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return bool
     */
    protected function isCartEmpty(QuoteTransfer $quoteTransfer)
    {
        return count($quoteTransfer->getItems()) === 0;
    }

    /**
     * @param \Generated\Shared\Transfer\CheckoutResponseTransfer $checkoutResponseTransfer
     *
     * @return void
     */
    protected function setCheckoutErrorMessages(CheckoutResponseTransfer $checkoutResponseTransfer)
    {
        foreach ($checkoutResponseTransfer->getErrors() as $checkoutErrorTransfer) {
            $this->flashMessenger->addErrorMessage($checkoutErrorTransfer->getMessage());
        }
    }

}
