<?php
/**
 * Please create the following directories first and make sure they 777.
 */
define('CACHE_PATH', __DIR__.'/cache');
define('LOG_FILE', __DIR__.'/logs/'.date(Ymd).'.log');

/**
 * This is the target language it has to be a 2 letter locale setting.
 */
define('TARGET_LANG', 'es');

/**
 * You will need to setup your Slack Incoming integration for your
 * team first. The setup will give you an incoming URL that the
 * system will POST your response to.
 */
define('CALLBACK_URL', 'YOUR-SLACK-INCOMING-URL');
