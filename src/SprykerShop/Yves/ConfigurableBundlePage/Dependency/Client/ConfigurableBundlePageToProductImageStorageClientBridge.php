<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerShop\Yves\ConfigurableBundlePage\Dependency\Client;

use Generated\Shared\Transfer\ProductConcreteImageStorageTransfer;

class ConfigurableBundlePageToProductImageStorageClientBridge implements ConfigurableBundlePageToProductImageStorageClientInterface
{
    /**
     * @var \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface
     */
    protected $productImageStorageClient;

    /**
     * @param \Spryker\Client\ProductImageStorage\ProductImageStorageClientInterface $productImageStorageClient
     */
    public function __construct($productImageStorageClient)
    {
        $this->productImageStorageClient = $productImageStorageClient;
    }

    public function findProductImageConcreteStorageTransfer(int $idProductConcrete, string $locale): ?ProductConcreteImageStorageTransfer
    {
        return $this->productImageStorageClient->findProductImageConcreteStorageTransfer($idProductConcrete, $locale);
    }
}
