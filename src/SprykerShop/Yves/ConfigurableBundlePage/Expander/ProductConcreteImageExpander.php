<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\ConfigurableBundlePage\Expander;

use Generated\Shared\Transfer\ProductImageSetStorageTransfer;
use Generated\Shared\Transfer\ProductViewTransfer;
use SprykerShop\Yves\ConfigurableBundlePage\Dependency\Client\ConfigurableBundlePageToProductImageStorageClientInterface;

class ProductConcreteImageExpander implements ProductConcreteImageExpanderInterface
{
    /**
     * @var \SprykerShop\Yves\ConfigurableBundlePage\Dependency\Client\ConfigurableBundlePageToProductImageStorageClientInterface
     */
    protected $productImageStorageClient;

    public function __construct(ConfigurableBundlePageToProductImageStorageClientInterface $productImageStorageClient)
    {
        $this->productImageStorageClient = $productImageStorageClient;
    }

    public function expandProductViewTransferWithImages(ProductViewTransfer $productViewTransfer, string $localeName): ProductViewTransfer
    {
        $productImageSetStorageTransfers = $this->productImageStorageClient->resolveProductImageSetStorageTransfers(
            $productViewTransfer->getIdProductConcreteOrFail(),
            $productViewTransfer->getIdProductAbstractOrFail(),
            $localeName,
        );

        if (!$productImageSetStorageTransfers) {
            return $productViewTransfer;
        }

        foreach ($productImageSetStorageTransfers as $productImageSetStorageTransfer) {
            $productViewTransfer = $this->addImagesFromProductImageSetStorageTransferToProductViewTransfer(
                $productViewTransfer,
                $productImageSetStorageTransfer,
            );
        }

        return $productViewTransfer;
    }

    protected function addImagesFromProductImageSetStorageTransferToProductViewTransfer(
        ProductViewTransfer $productViewTransfer,
        ProductImageSetStorageTransfer $productImageSetStorageTransfer
    ): ProductViewTransfer {
        foreach ($productImageSetStorageTransfer->getImages() as $productImageStorageTransfer) {
            $productViewTransfer->addImage($productImageStorageTransfer);
        }

        return $productViewTransfer;
    }
}
