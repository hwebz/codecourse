<?php

  namespace AI\Providers;

  use Pimple\Container;
  use Silex\Application;
  //use Silex\ServiceProviderInterface; just for Silex 1.*
  use Pimple\ServiceProviderInterface;
  use Uploadcare\Api;

  class UploadcareProvider implements ServiceProviderInterface {

    public function register(Container $app) {
      $app['uploadcare'] = function($app) {
        return new Api('ace34b6d792cf2bfc00f', '6fb7147c95e0ef3d9a83');
      };
    }

    public function boot(Application $app) {

    }
  }

?>
