<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],
    
    'facebook' => [
        'client_id'         =>  env('FB_APP_ID', 'your-facebook-app-id'),
        'client_secret'     =>  env('FB_APP_SECRET', 'your-facebook-app-secret'),
        'redirect'          =>  env('FB_CALL_BACK_URL', 'http://your-registered-call-back-url'),
    ],

];
