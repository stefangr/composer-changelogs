<?php

/**
 * This file is part of the composer-changelogs project.
 *
 * (c) Loïck Piera <pyrech@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pyrech\ComposerChangelogs\OperationHandler;

use Composer\DependencyResolver\Operation\OperationInterface;
use Composer\DependencyResolver\Operation\UninstallOperation;
use Pyrech\ComposerChangelogs\UrlGenerator\UrlGenerator;

class UninstallHandler implements OperationHandler
{
    /**
     * {@inheritdoc}
     */
    public function supports(OperationInterface $operation)
    {
        return $operation instanceof UninstallOperation;
    }

    /**
     * {@inheritdoc}
     */
    public function extractSourceUrl(OperationInterface $operation)
    {
        if (!($operation instanceof UninstallOperation)) {
            throw new \LogicException('Operation should be an instance of UninstallOperation');
        }

        return $operation->getPackage()->getSourceUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getOutput(OperationInterface $operation, UrlGenerator $urlGenerator = null)
    {
        if (!($operation instanceof UninstallOperation)) {
            throw new \LogicException('Operation should be an instance of UninstallOperation');
        }

        $output = [];

        $package = $operation->getPackage();
        $version = $package->getPrettyVersion();

        $output[] = sprintf(
            ' - <fg=green>%s</fg=green> removed (installed version was <fg=yellow>%s</fg=yellow>)',
            $package->getName(),
            $version
        );

        return $output;
    }
}
