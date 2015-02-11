<?php

date_default_timezone_set('Europe/London');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use Stichoza\Google\GoogleTranslate;
use Doctrine\Common\Cache\FilesystemCache as Cacher;
use GuzzleHttp\Client as Client;
use Monolog\Logger as Logger;
use Monolog\Handler\StreamHandler as Streamer;

$app = new \Slim\Slim();
$app->post('/', function () use ($app) {

	$entext = $app->request->post('text');

	$log = new Logger("TellSara");
        $log->pushHandler(new Streamer(LOG_FILE, Logger::INFO));
	$log->addInfo("Incoming Text: ".$entext);

	$cache = new Cacher(CACHE_PATH);
	if(!$cache->contains($entext))
	{
		$tr = new GoogleTranslate();
		$tr->setLangFrom('en');
		$tr->setLangTo(TARGET_LANG);

		$estext = $tr->translate($entext);	
		$cache->save($entext,$estext);

		$log->addInfo("Outgoing Text: ".$estext);
		
	}
	else
	{
		$log->addInfo("Using Cache.");
		$estext = $cache->fetch($entext);
	}


	if($app->request->post('user_name'))
	{
		$log->addInfo("Message sent by ".$app->request->post('user_name'));
		$estext = $app->request->post('user_name').' dice; '.$estext;
	}

	$res = new \stdClass();
	$res->username = 'señor Slackbot';
	$res->icon_emoji = ':man:';

	if($app->request->post('channel_name'))
	{
		$log->addNotice("Sending to channel ".$app->request->post('channel_name'));
		$res->channel = '#'.$app->request->post('channel_name');
	}

	$res->text = $estext;

	$client = new Client();
	$client->post(CALLBACK_URL, [
		'headers'=> ['Content-type' => 'application/json'],
		'body' => json_encode($res)
	]);

});
$app->run();
