<?php

namespace SLLH\Tests\Provider;

use Silex\Application;
use SLLH\Provider\IsoCodesValidatorServiceProvider;

class IsoCodesValidatorServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $app = new Application();

        $app->register(new IsoCodesValidatorServiceProvider());

        return $app;
    }
}
