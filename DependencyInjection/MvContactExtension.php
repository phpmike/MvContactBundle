<?php

namespace Mv\ContactBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MvContactExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        
        $container->setParameter('mv_contact.mail_from', $config['mail_from']);  
        $container->setParameter('mv_contact.mail_to', $config['mail_to']);
        
        $container->setParameter('mv_contact.mail_cc', isset($config['mail_cc']) ? $config['mail_cc'] : false );
        $container->setParameter('mv_contact.mail_bcc', isset($config['mail_bcc']) ? $config['mail_bcc'] : false );
    }
}
