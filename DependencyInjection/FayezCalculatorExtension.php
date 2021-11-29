<?php

namespace Fayez\CalculatorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class FayezCalculatorExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $config = $this->processConfiguration(new Configuration(), $configs);
        // TODO: Set custom parameters
         $container->setParameter('fayez_calculator.bar', $config['bar']);
         $container->setParameter('fayez_calculator.integer_foo', $config['integer_foo']);
         $container->setParameter('fayez_calculator.integer_bar', $config['integer_bar']);
    }

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);
        // TODO: Set custom doctrine config
        $doctrineConfig = [];
        $doctrineConfig['orm']['resolve_target_entities']['Fayez\CalculatorBundle\Entity\UserInterface'] = $config['user_provider'];
        $doctrineConfig['orm']['mappings'][] = array(
            'name' => 'FayezCalculatorBundle',
            'is_bundle' => true,
            'type' => 'xml',
            'prefix' => 'Fayez\CalculatorBundle\Entity'
        );
        $container->prependExtensionConfig('doctrine', $doctrineConfig);
        // TODO: Set custom twig config
        $twigConfig = [];
        $twigConfig['globals']['fayez_calculator_bar_service'] = "@fayez_calculator.service";
        $twigConfig['paths'][__DIR__.'/../Resources/views'] = "fayez_calculator";
        $twigConfig['paths'][__DIR__.'/../Resources/public'] = "fayez_calculator.public";
        $container->prependExtensionConfig('twig', $twigConfig);
    }

    public function getAlias()
    {
        return 'fayez_calculator';
    }
}