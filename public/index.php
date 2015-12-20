<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$routes = new RouteCollection();
$routes->add('hello', new Route('/add/{param1}', array(
        '_controller' => function (Request $request) {
            return new Response("asdfasdf". $request->get("param1"));
        }
    )
));
$routes->add('hello', new Route('/', array(
        '_controller' => function (Request $request) {
            return new Response("Asdf");
        }
    )
));
    use Symfony\Component\Intl\Intl;

\Locale::setDefault('en');

$currencies = Intl::getCurrencyBundle()->getCurrencyNames('de');
// => array('AFN' => 'Afghan Afghani', ...)

$currency = Intl::getCurrencyBundle()->getCurrencyName('INR');
// => 'Indian Rupee'

$symbol = Intl::getCurrencyBundle()->getCurrencySymbol('INR');
// => '₹'

$fractionDigits = Intl::getCurrencyBundle()->getFractionDigits('INR');
// => 2

$roundingIncrement = Intl::getCurrencyBundle()->getRoundingIncrement('INR');
// => 0
print_r([$currencies, $currency, $symbol, $fractionDigits, $roundingIncrement]);


\Locale::setDefault('en');

$languages = Intl::getLanguageBundle()->getLanguageNames();
// => array('ab' => 'Abkhazian', ...)

$language2 = Intl::getLanguageBundle()->getLanguageName('de');
// => 'German'

$language3 = Intl::getLanguageBundle()->getLanguageName('de', 'AT');
// => 'Austrian German'

$scripts = Intl::getLanguageBundle()->getScriptNames();
// => array('Arab' => 'Arabic', ...)

$script = Intl::getLanguageBundle()->getScriptName('Hans');
// => 'Simplified'

print_r([$languages, $language2, $language3, $scripts, $script]);


\Locale::setDefault('pl');

$countries = Intl::getRegionBundle()->getCountryNames();
// => array('AF' => 'Afghanistan', ...)

$country = Intl::getRegionBundle()->getCountryName('GB');
// => 'United Kingdom'
    
print_r([$countries, $country]);


\Locale::setDefault('pl');

$locales = Intl::getLocaleBundle()->getLocaleNames();
// => array('af' => 'Afrikaans', ...)

$locale = Intl::getLocaleBundle()->getLocaleName('save');
// => 'Chinese (Simplified, Macau SAR China)'

print_r([$locales, $locale]);


$request = Request::createFromGlobals();

$matcher = new UrlMatcher($routes, new RequestContext());

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher));

$resolver = new ControllerResolver();
$kernel = new HttpKernel($dispatcher, $resolver);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);