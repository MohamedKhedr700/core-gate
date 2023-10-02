# Core Gate Package

This package is responsible for handling all gates in the system.

## Installation

``` bash
composer require raid/core-gate
```

## Configuration

``` bash
php artisan core:publish-gate
```


## Usage

``` php
class UserController extends Controller
{
    /**
     * Invoke the controller method.
     */
    public function __invoke(Request $request)
    {
        $user = User::create($request->only(['name', 'email', 'password']));
        
        // let's trigger the create event.
        User::events('create', $user);
        
        // or using the trigger method
        User::events()->trigger('create', $user);

        // using the facade
        Events::trigger('user.create', $user);
        
        // using the helper
        events()->trigger('user.create', $user);
    }
}
```

# How to work this

Let's start with our eventable class `User`.

``` php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Raid\Core\Event\Traits\Event\Eventable;

class User extends Model
{
    use Eventable;
}
```

To define the eventable class ex:`User` model events, we have two ways:

1. Define `getEvents` method.

``` php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Raid\Core\Event\Traits\Event\Eventable;
use App\Events\CreateUserEvent;

class User extends Model
{
    use Eventable;
    
    /**
     * Get eventable events.
     */
    public static function getEvents(): array
    {
        return [
            // here we define our event classes.
            CreateUserEvent::class,
        ];
    }
}
```

2. Define `config/event.php` events.

``` php
'events' => [
    // here we define our eventable class.
    User::class => [
        // here we define our event classes.
        CreateUserEvent::class,
    ],
], 
```

Now, let's create our event class `CreateUserEvent`.

you can use this command to create the event class.

``` bash
php artisan core:make-event CreateUserEvent
```
Here is the event class.

``` php
<?php

namespace App\Events;

use Raid\Core\Event\Events\Contracts\EventInterface;
use Raid\Core\Event\Events\Event;

class CreateUserEvent extends Event implements EventInterface
{
    /**
     * {@inheritdoc}
     */
    public const ACTION = '';

    /**
     * {@inheritdoc}
     */
    public const LISTENERS = [];
}
```

The event class must implement `EventInterface` interface.

The event class must extend `Event` class.

The event class must define `ACTION` constant, which is the event action name.

The `LISTENERS` constant is an array of listener classes that will be called when the event is triggered.

Now, let's create our event listener `CreateUserListener`.

you can use the command `php artisan core:make-listener CreateUserListener` to create the event listener class.

``` php
<?php

namespace App\Listeners;

use Raid\Core\Event\Events\Contracts\EventListenerInterface;

class CreateUserListener implements EventListenerInterface
{
    /**
     * Initialize the listener.
     */
    public function init(): void
    {
    }

    /**
     * Handle the listener.
     */
    public function handle(): void
    {
    }
}
```

The event listener class must implement `EventListenerInterface` interface.

The `init` method is the method that will be called when the event listener is initialized.

The `handle` method is the method that will be called when the event is triggered.

Let's finish our event class and listener class.

``` php
<?php

namespace App\Events;

use Raid\Core\Event\Events\Contracts\EventInterface;
use Raid\Core\Event\Events\Event;

class CreateUserEvent extends Event implements EventInterface
{
    /**
     * {@inheritdoc}
     */
    public const ACTION = 'create';

    /**
     * {@inheritdoc}
     */
    public const LISTENERS = [
        CreateUserListener::class,
    ];
}
```

``` php
<?php

namespace App\Listeners;

use App\Models\User;
use Raid\Core\Event\Events\Contracts\EventListenerInterface;

class CreateUserListener implements EventListenerInterface
{
    /**
     * Handle the listener.
     */
    public function handle(User $user): void
    {
        // here we can do many things with the event given arguments.
    }
}
```

Now, let's trigger the event with its listeners.

``` php
<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Invoke the controller method.
     */
    public function __invoke(Request $request)
    {
        $user = User::create($request->only(['name', 'email', 'password']));
    
        User::events()->trigger('create', $user);
    }
}
```

The `events` method is a static method that will be called from the `Eventable` trait.

The `trigger` method is a method that will be called from the `Events` and `Listeners` related to the triggered action.

This will call the `handle` method in each listener
related to the triggered event action without calling the `init` method.

And that's it.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- **[Mohamed Khedr](https://github.com/MohamedKhedr700)**

## Security

If you discover any security-related issues, please email
instead of using the issue tracker.

## About Raid

Raid is a PHP framework created by **[Mohamed Khedr](https://github.com/MohamedKhedr700)**

and it is maintained by **[Mohamed Khedr](https://github.com/MohamedKhedr700)**.

## Support Raid

Raid is an MIT-licensed open-source project. It's an independent project with its ongoing development made possible.

