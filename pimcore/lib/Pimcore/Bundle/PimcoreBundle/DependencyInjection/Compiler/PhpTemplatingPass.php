<?php

namespace Pimcore\Bundle\PimcoreBundle\DependencyInjection\Compiler;

use Pimcore\Bundle\PimcoreBundle\Templating\PhpEngine;
use Pimcore\Bundle\PimcoreBundle\Templating\TimedPhpEngine;
use Symfony\Bundle\FrameworkBundle\Templating\PhpEngine as BasePhpEngine;
use Symfony\Bundle\FrameworkBundle\Templating\TimedPhpEngine as BaseTimedPhpEngine;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PhpTemplatingPass implements CompilerPassInterface
{
    /**
     * Replace PHP and Timed PHP engine with our implementations
     *
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('templating.engine.php')) {
            $engine = $container->getDefinition('templating.engine.php');

            if ($engine->getClass() === BasePhpEngine::class) {
                $engine->setClass(PhpEngine::class);
            } else if ($engine->getClass() === BaseTimedPhpEngine::class) {
                $engine->setClass(TimedPhpEngine::class);
            }
        }
    }
}