<?php

namespace NexusPoint\Logifier;

use Illuminate\Support\ServiceProvider;

class LogifierServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application events.
     */
    public function boot()
    {
    	$configFile = __DIR__ . '/config/config.php';
        $this->mergeConfigFrom($configFile, 'logifier');
    }

	/**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    	if ($this->app['config']->get('app.debug')) return;

        $monolog = \Log::getMonolog();
        $config = $this->app['config']->get('logifier');

    	$monolog->pushHandler(
            new \Monolog\Handler\SlackHandler(
                $config['token'], // token
                $config['channel'], // channel
                $config['username'], // username
                true, // useAttachment
                null, // iconEmoji
                \Monolog\Logger::WARNING,
                true, // bubble
                false, // useShortAttachment
                true // includeContextAndExtra
            )
        );
    }
}