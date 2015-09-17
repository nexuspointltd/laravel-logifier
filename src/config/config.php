<?php

return [

	'slack' => [
	
		'enabled'  => env('APP_DEBUG'),
		'token'    => env('SLACK_TOKEN'),
	    'channel'  => env('SLACK_CHANNEL'),
	    'username' => env('SLACK_USERNAME'),

	],

];