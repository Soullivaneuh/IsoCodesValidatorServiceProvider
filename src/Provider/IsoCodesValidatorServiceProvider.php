<?php

namespace SLLH\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

trigger_error('The '.__NAMESPACE__.'\IsoCodesValidatorServiceProvider class is deprecated since version 1.1. Use SLLH\IsoCodesValidator\Provider\IsoCodesValidatorServiceProvider instead.', E_USER_DEPRECATED);

/**
 * Class IsoCodesValidatorServiceProvider
 *
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
class IsoCodesValidatorServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Application $app)
    {
        if (isset($app['translator'])) {
            $r = new \ReflectionClass('SLLH\IsoCodesValidator\AbstractIsoCodesConstraintValidator');
            $file = dirname($r->getFilename()) . '/Resources/translations/validators.' . $app['locale'] . '.xlf';
            if (file_exists($file)) {
                $app['translator']->addResource('xliff', $file, $app['locale'], 'validators');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
    }
}
