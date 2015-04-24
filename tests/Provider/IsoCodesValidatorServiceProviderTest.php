<?php

namespace SLLH\Tests\Provider;

use Silex\Application;
use Silex\Provider\TranslationServiceProvider;
use Silex\Translator;
use SLLH\Provider\IsoCodesValidatorServiceProvider;

class IsoCodesValidatorServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisterAndBoot()
    {
        $app = new Application();

        $app->register(new IsoCodesValidatorServiceProvider());
        $app->boot();

        return $app;
    }

    public function testRegisterWithTranslator()
    {
        $app = new Application();

        $app->register(new TranslationServiceProvider(), array(
            'locale_fallbacks' => array(),
        ));
        $app->register(new IsoCodesValidatorServiceProvider());
    }

    /**
     * @dataProvider getValidLocales
     */
    public function testTranslationFiles($locale, $existing)
    {
        $app = new Application(array(
            'locale' => $locale,
        ));

        $app->register(new TranslationServiceProvider(), array(
            'locale_fallbacks' => array(),
        ));
        $app->register(new IsoCodesValidatorServiceProvider());

        /** @var Translator $translator */
        $translator = $app['translator'];

        $source = 'This value is not a valid VAT.';
        $translation =$translator->trans($source, array(), 'validators', $locale);
        if ($locale !== 'en') {
            // String should be translated
            $existing ? $this->assertNotEquals($source, $translation) : $this->assertEquals($source, $translation);
        }
    }

    public function getValidLocales()
    {
        return array(
            array('en', true),
            array('fr', true),
            array('mad_locale', false),
        );
    }

}
