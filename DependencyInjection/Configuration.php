<?php

namespace AmaxLab\Bundle\BackendDesignBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('backend_design');

        $root
            ->children()
                ->booleanNode('gravatar')->info('Enage or disable gravatar suppor')->defaultFalse()->end()
            ->end();

        return $treeBuilder;
    }
}
