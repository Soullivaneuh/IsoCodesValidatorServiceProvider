<?php

namespace SLLH\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

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
            $r = new \ReflectionClass('SLLH\IsoCodesValidator\IsoCodesConstraintValidator');
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
