<?php

namespace AmaxLab\Bundle\BackendDesignBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BackendDesignExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if ($config['gravatar']) {
            $loader->load('gravatar.xml');
        }

        $kernelBundles = $container->getParameter('kernel.bundles');
        $bundleName = array_search('AmaxLab\Bundle\BackendDesignBundle\BackendDesignBundle', $kernelBundles) ?: 'BackendDesignBundle';
        $asseticBundles = $container->getParameter('assetic.bundles');
        if (is_array($asseticBundles) && !in_array($bundleName, $asseticBundles)) {
            $asseticBundles[] = $bundleName;
            $container->setParameter('assetic.bundles', $asseticBundles);
        }
    }

    /**
     * Allow an extension to prepend the extension configurations. See {@link http://symfony.com/doc/current/cookbook/bundles/prepend_extension.html}.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $kernelBundles = $container->getParameter('kernel.bundles');
        if (array_key_exists('MopaBootstrapBundle', $kernelBundles)) {
            $mopaOptions = array(
                'menu' => array(
                    'template' => 'BackendDesignBundle:Menu:menu.html.twig',
                ),
                'icons' => array(
                    'icon_set' => 'fontawesome4',
                ),
            );

            $container->prependExtensionConfig('mopa_bootstrap', $mopaOptions);
        }
    }
}
