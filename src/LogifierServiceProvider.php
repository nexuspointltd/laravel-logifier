<?php

namespace NexusPoint\Logifier;

use Illuminate\Support\ServiceProvider;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Processor\WebProcessor;

class LogifierServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application events.
     */
    public function boot()
    {
    	$configFile = __DIR__ . '/config/config.php';
        $this->mergeConfigFrom($configFile, 'logifier');

        $this->registerCustomLogger();
    }

	/**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function registerCustomLogger()
    {
    	$config = $this->app['config']->get('logifier.slack');
        if (!$config['enabled']) return;

        $monolog = \Log::getMonolog();

        $handler = new \Monolog\Handler\SlackHandler(
            $config['token'], // token
            $config['channel'], // channel
            $config['username'], // username
            true, // useAttachment
            null, // iconEmoji
            $config['warning_level'],
            true, // bubble
            false, // useShortAttachment
            true // includeContextAndExtra
        );
        $handler->pushProcessor(new WebProcessor());
        $handler->setFormatter(new HtmlFormatter());
        $user = \Auth::user();
        if ($user) {
            $monolog->addInfo('USER ID: ' . $user->id);
        }
        //dd($handler);
        $monolog->pushHandler($handler);
    }
}