# Tell Sara
Will translate Slack[http://www.slack.com] messages into spanish for you and reply to the channel.

## Installation

To install you just need to run composer
```composer install```

## Configuration

Fill in the incoming webhook URL in the config.php file, and set the target language aswell.

Please ensure the *LOG_FILE* and *CACHE_PATH* paths exist on the file system and have 777 permissions.

## Dependencies

This project has a couple of dependencies mainly ```Slim``` and ```Doctrine``` cache library.

### Slim

Slim is used simply for routing and for request variable filter.

### Doctrine Cache Library

The Doctrine cache library is simply used to cache the responses from the Google Translate API. The Translate API can be quite slow and there's no point hitting their end-point for things already said!

## Roadmap

Things to do;

* Allow you to specify the target language
* Use custom emoticons/profile icons for different languages
