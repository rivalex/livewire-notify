# Livewire - Notify

Livewire Notify is a simple notifications system with zero dependencies above [TALL-stack](https://tallstack.dev/)
([Tailwind CSS](https://tailwindcss.com/), [Alpine.JS](https://alpinejs.dev/), [Laravel](https://laravel.com/) and [Livewire](https://laravel-livewire.com/)).
<p align="center">
    <img src="https://github.com/rivalex/livewire-notify/blob/main/screenshots/livewire-notify.jpg?raw=true" alt="Livewire Notify">
</p>

## Requirements

Make sure that [Livewire](https://laravel-livewire.com/) and [Alpine.JS](https://github.com/alpinejs/alpine) are installed properly.
The easiest way to do it is to install [Laravel Jetstream](https://jetstream.laravel.com) with **Livewire stack** (post-install command `php artisan jetstream:install livewire`).

**Alpine.JS** must be imported in `resources/js/app.js` package:
```javascript
import 'alpinejs'
```
**Livewire** scripts and styles tags must be present in the layout file:
```html
…
<head>
…
    <livewire:styles/>
…
</head>
<body>
…
    <livewire:scripts/>
</body>
</html>
```
## Installation

Via Composer

```bash
$ composer require rivalex/livewire-notify
```

Proceed with installation process:

```bash
$ php artisan livewire-notify:install
```

Afterwards the package config can be found at `config/livewire-notify.php` and views at `resources/views/vendor/livewire-notify/`.

It's required because of Tailwind config is needed to be extended with new purge paths.

Otherwise you won't see messages styled properly.

<p align="center">
    <img src="https://github.com/rivalex/livewire-notify/blob/main/screenshots/livewire-notify-basic.jpg?raw=true" alt="Livewire Notify">
</p>

## Usage

Put Livewire-component `<livewire:notify/>` into the app layout.
Make sure to insert it into correct context because it may be positioned absolutely.

Now you can use it from frontend and backend both.

## Message options

Message added at backend (from any Livewire component) must have type of `array`.
Message added at frontend (from JavaScript) must have type of `object`.

``` php
$message = [
        'text' => __('Post is saved!'),
        'title' => '', // Optional
        'type' => 'success', // Optional. By default: success | optional: error (or fail), warning (or warn), info
        // you can find all types options in the config file
        'icon' => '', // Optional. It replaces the default type icon. Can be pure html, icon fonts or svg code

        // Attention! The following options override ones from the config file

        'duration' => 5000, // Optional. The time of message to be shown. To show infinitely set to 0
        'msgClass' =>  'bg-gradient-to-r from-green-200 to-green-300', // Optional. Tailwind class for message container
        'progressClass' =>  'bg-green-500', // Optional. Tailwind class for progress bar. If null progress bar won't be shown
        'closable' => false, // Optional. True by default. Whether message is closable by click on message or Esc key press on window
    ]
```
``` javascript
let message = {
    text: 'Post is saved!'
}
```

### Backend

**Livewire event**

From any Livewire component push `emit` trigger to render new message.

``` php
public function save(){
    ...
    $this->emitTo('notify','message',['text'=>__('The post is saved!')]);
}
```

**Session flash variable**
``` php
public function save(){
    ...
    session()->flash('notify',['text'=>__('The post is saved!')]);
    return $this->redirect(route('posts'));
}
```

### Frontend
Add new message from javascript:
``` javascript
Livewire.emitTo('notify','message',{text:'The post is saved!'})
```

### Example
Try to put the following code (with Laravel Jetstream w/Livewire stack installed):
```html
<div class="flex flex-row space-x-4">
    <x-jet-button x-data="{}" @click="Livewire.emitTo('notify','message',{text:'Success',type:'success'})">Success</x-jet-button>
    <x-jet-button x-data="{}" @click="Livewire.emitTo('notify','message',{text:'Error',type:'error'})">Error</x-jet-button>
    <x-jet-button x-data="{}" @click="Livewire.emitTo('notify','message',{text:'Warning',type:'warning'})">Warning</x-jet-button>
    <x-jet-button x-data="{}" @click="Livewire.emitTo('notify','message',{text:'Info',type:'info'})">Info</x-jet-button>
    <x-jet-button x-data="{}" @click="Livewire.emitTo('notify','message',{text:'Default',type:'default'})">Default</x-jet-button>
</div>
```

## Config file

After `php artisan livewire-notify:install` command is fired, config file will be published to `config/livewire-notify.php`. There you can change some value for customization.
``` php
<?php
return [
    // Messages container positioning
    'positionClass' => 'absolute top-0 right-0',
    // Default message Tailwind stylinh
    'defaultMsgClass' => 'w-80 rounded-xl shadow-xl',
    // Time of each message to be shown by default
    'duration' => 2200,
    // Messages types
    'types' => [
        'success' => [
            // 'msgClass'=>'bg-green-200',
            'msgClass'=>'bg-gradient-to-r from-green-200 to-green-300',
            'progressClass' => 'bg-green-500',
            // View for icon
            'icon' => 'livewire-notify::icons.success',
        ],
        'error' => [
            // 'msgClass'=>'bg-red-200',
            'msgClass'=>'bg-gradient-to-r from-red-200 to-red-300',
            'progressClass' => 'bg-red-500',
            // View for icon
            'icon' => 'livewire-notify::icons.error',
        ],
        'fail' => [
            // 'msgClass'=>'bg-red-200',
            'msgClass'=>'bg-gradient-to-r from-red-200 to-red-300',
            'progressClass' => 'bg-red-500',
            // View for icon
            'icon' => 'livewire-notify::icons.error',
        ],
        'warning' => [
            // 'msgClass'=>'bg-yellow-200',
            'msgClass'=>'bg-gradient-to-r from-yellow-200 to-yellow-300',
            'progressClass' => 'bg-yellow-500',
            // View for icon
            'icon' => 'livewire-notify::icons.error',
        ],
        'warn' => [
            // 'msgClass'=>'bg-yellow-200',
            'msgClass'=>'bg-gradient-to-r from-yellow-200 to-yellow-300',
            'progressClass' => 'bg-yellow-500',
            // View for icon
            'icon' => 'livewire-notify::icons.error',
        ],
        'info' => [
            // 'msgClass'=>'bg-blue-200',
            'msgClass'=>'bg-gradient-to-r from-blue-200 to-blue-300',
            'progressClass' => 'bg-blue-500',
            // View for icon
            'icon' => 'livewire-notify::icons.info',
        ],
        'default' => [
            // 'msgClass'=>'bg-gray-200',
            'msgClass'=>'bg-gradient-to-r from-gray-200 to-gray-300',
            'progressClass' => 'bg-gray-700',
            // View for icon
            'icon' => 'livewire-notify::icons.info',
        ]
    ]
];
```

## Troubleshooting

Your messages don't get any styles? Please, run `livewire-notify:install` command to publish views. Therefore, Laravel Mix compiler will find package Blade-views and will purge CSS properly.

## Updating

Simply update like all other packages with `composer update`. Be sure to run `livewire-notify:install` to updated published views.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

```bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- Forked project from [Dmitriy Belyaev](https://github.com/codespb/livewire-notifier)
- Update to Laravel 9 [Rivalex](https://rivalex.com)

## License

Please see the [license file](license.md) for more information.
