<?php

return [
	'mailgun' => [
		'key' => getenv('MAILGUN_KEY'),
		'domain' => getenv('MAILGUN_DOMAIN'),
		'from' => getenv('MAILGUN_FROM'),
	]
];

?>