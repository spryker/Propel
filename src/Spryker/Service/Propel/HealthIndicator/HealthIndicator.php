<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Service\Propel\HealthIndicator;

use Generated\Shared\Transfer\HealthCheckServiceResponseTransfer;
use Orm\Zed\Heartbeat\Persistence\SpyPropelHealthCheck;
use Propel\Runtime\Exception\PropelException;

class HealthIndicator implements HealthIndicatorInterface
{
    /**
     * @return \Generated\Shared\Transfer\HealthCheckServiceResponseTransfer
     */
    public function executeHealthCheck(): HealthCheckServiceResponseTransfer
    {
        try {
            $entity = (new SpyPropelHealthCheck())
                ->setHealthCheck('ok');
            $entity->save();
            $entity->delete();
        } catch (PropelException $e) {
            return (new HealthCheckServiceResponseTransfer())
                ->setStatus(false)
                ->setMessage($e->getMessage());
        }

        return (new HealthCheckServiceResponseTransfer())
            ->setStatus(true);
    }
}
