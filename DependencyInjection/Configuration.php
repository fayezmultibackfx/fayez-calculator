<?php

namespace Fayez\CalculatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return TreeBuilder $builder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder('fayez_calculator');

        $rootNode = $builder->getRootNode();
        $rootNode->children()
            ->scalarNode('user_provider')
                ->isRequired()
                ->defaultValue('\App\Entity\User')
            ->end()
            ->arrayNode('bar')
                ->isRequired()
                ->scalarPrototype()
                    ->defaultValue([
                        'fayez_calculator.ipsum',
                        'fayez_calculator.lorem',
                    ])
                ->end()
            ->end()
            ->integerNode('integer_foo')
                ->isRequired()
                ->defaultValue(2)
                ->min(1)
            ->end()
            ->integerNode('integer_bar')
                ->isRequired()
                ->defaultValue(50)
                ->min(1)
            ->end()
            ->end();

        return $builder;
    }
}
