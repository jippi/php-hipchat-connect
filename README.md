# Introduction

This toolkit will help you construct valid HipChat connect manifest files.

It provides basic validation for the most important keys, and help you avoid hours of
frustrating debugging, but guiding you through a fluent and consistent interface for
configuring your HipChat Connect manifest files.

If any validation errors are found, an `HipChat\Exception\ValidationException` will be thrown.
This exception instance have a `getValidationErrorCount` and `getValidationErrors` method to help
inspect the found validation errors.

Most code currently live in the `HipChat\Manifest\AbstractNode` and `HipChat\Manifest\Capabilities` classes.

The toolkit uses `cakephp/validation` for data validation

# Installation

`composer.json`

```json
{
    "minimum-stability": "dev",
    "require": {
        "jippi/php-hipchat-connect": "dev-master"
    }
}
```

run `composer install`

or

```
composer require jippi/php-hipchat-connect
```

# Example

```php
<?php
require 'vendor/autoload.php';

$generator = new \HipChat\Manifest\Generator();
$generator->name = 'Example App';
$generator->description = 'An integration that does wonderful things with examples';
$generator->key = 'com.example.demo';
$generator->vendor()
    ->set('name', 'Bownty')
    ->set('url', 'bownty.com');
$generator->links()
    ->set('homepage', 'https://addon.example.com/')
    ->set('self', 'https://addon.example.com/capabilities');
$generator->capabilities()
    ->webhook('email_sniffer')
        ->set('url', 'https://addon.example.com/email_sniffer')
        ->set('pattern', '[@]')
        ->set('event', 'room_message')
        ->set('authentication', 'none')
        ->set('name', 'E-mail sniffer');
$generator->capabilities()
    ->action('demo')
        ->set('key', 'message.reminder')
        ->set('name', ['value' => 'Set reminder'])
        ->set('target', 'message.reminder.dialog')
        ->set('location', 'hipchat.message.action');
$generator->capabilities()
    ->dialog('demo')
        ->set('key', 'meh')
        ->set('title', ['value' => 'Add Reminder'])
        ->set('url', 'https://addon.example.com/message/reminders')
        ->set('options', ['filter' => ['placeholder' => ['value' => 'muh']]]);
$generator->capabilities()
    ->glance('demo')
        ->set('key', 'meh')
        ->set('icon', [
            'url' => 'https://addon.example.com/small.jpg',
            'url@2x' => 'https://addon.example.com/small@2x.jpg'
        ])
        ->set('name', ['value' => 'Locked Repositories'])
        ->set('target', ['value' => 'locked.repos.sidebar'])
        ->set('queryUrl', 'https://addon.example.com/glance/example');
$generator->capabilities()
    ->installable()
        ->set('allowGlobal', true)
        ->set('allowRoom', true);

$generator->validate();

echo json_encode($generator);
?>
```

will output

```json
{
  "name": "Example App",
  "description": "An integration that does wonderful things with examples",
  "key": "com.example.demo",
  "vendor": {
    "name": "Bownty",
    "url": "bownty.com"
  },
  "links": {
    "homepage": "https://addon.example.com/",
    "self": "https://addon.example.com/capabilities"
  },
  "capabilities": {
    "action": [
      {
        "key": "message.reminder",
        "name": {
          "value": "Set reminder"
        },
        "target": "message.reminder.dialog",
        "location": "hipchat.message.action"
      }
    ],
    "webhook": [
      {
        "url": "https://addon.example.com/email_sniffer",
        "pattern": "[@]",
        "event": "room_message",
        "authentication": "none",
        "name": "E-mail sniffer"
      }
    ],
    "dialog": [
      {
        "key": "meh",
        "title": {
          "value": "Add Reminder"
        },
        "url": "https://addon.example.com/message/reminders",
        "options": {
          "filter": {
            "placeholder": {
              "value": "muh"
            }
          }
        }
      }
    ],
    "glance": [
      {
        "key": "meh",
        "icon": {
          "url": "https://addon.example.com/small.jpg",
          "url@2x": "https://addon.example.com/small@2x.jpg"
        },
        "name": {
          "value": "Locked Repositories"
        },
        "target": {
          "value": "locked.repos.sidebar"
        },
        "queryUrl": "https://addon.example.com/glance/example"
      }
    ],
    "installable": {
      "allowGlobal": true,
      "allowRoom": true
    }
  }
}
```
