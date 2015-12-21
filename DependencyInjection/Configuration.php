<?php

namespace Mv\ContactBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mv_contact');

        $rootNode
            ->children()
                ->scalarNode('mail_from')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('Mail from which the application sends messages')
                ->end()
                ->scalarNode('mail_to')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('Mail where send messages')
                ->end()
                ->scalarNode('mail_cc')
                    ->info('Mail where send copie messages')
                ->end()
                ->scalarNode('mail_bcc')
                    ->info('Mail where send blind copie messages')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
