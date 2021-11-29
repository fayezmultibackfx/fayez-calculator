<?php

namespace Fayez\CalculatorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class FayezCalculatorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

//        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
//        $loader->load('services.xml');
//        $config = $this->processConfiguration(new Configuration(), $configs);
//        // TODO: Set custom parameters
//         $container->setParameter('fayez_calculator.bar', $config['bar']);
//         $container->setParameter('fayez_calculator.integer_foo', $config['integer_foo']);
//         $container->setParameter('fayez_calculator.integer_bar', $config['integer_bar']);
    }

    public function getAlias()
    {
        return 'fayez_calculator';
    }
}
