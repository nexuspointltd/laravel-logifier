<?php

return [

	'slack' => [
	
		'enabled'  		=> env('APP_DEBUG'),
		'warning_level' => env('SLACK_WARNING_LEVEL', \Monolog\Logger::WARNING),
		'token'    		=> env('SLACK_TOKEN'),
	    'channel'  		=> env('SLACK_CHANNEL'),
	    'username'		=> env('SLACK_USERNAME'),

	],

];