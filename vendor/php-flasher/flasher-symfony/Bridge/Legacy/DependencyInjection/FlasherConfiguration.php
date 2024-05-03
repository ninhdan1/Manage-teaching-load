<?php

/*
 * This file is part of the PHPFlasher package.
 * (c) Younes KHOUBZA <younes.khoubza@gmail.com>
 */

namespace Flasher\Symfony\Bridge\Legacy\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

abstract class FlasherConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        return $this->getFlasherConfigTreeBuilder();
    }

    /**
     * @return TreeBuilder
     */
    abstract public function getFlasherConfigTreeBuilder();
}
