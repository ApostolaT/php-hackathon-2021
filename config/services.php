<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Service\ProgrammeUserPostService;
use Symfony\Component\Serializer\Serializer;

//use Symfony\Component\Serializer\Encoder\JsonEncoder;
//use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


return function(ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('App\\', '../src/*')
        ->exclude('../src/{DependencyInjection,Entity,Tests,Kernel.php}');

    $services->load("App\\Controller\\", '../src/Controller');

//    $services->set('program_user_post_service', ProgrammeUserPostService::class)
//        ->arg('$serializer', service('serializer'));

//    $services->set('object_normalizer', ObjectNormalizer::class)
//        ->tag('serializer.normalizer');
//
//    $services->set('object_encoder', JsonEncoder::class)
//        ->tag('serializer.encoder');
};
