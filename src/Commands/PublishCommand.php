<?php

namespace Raid\Core\Gate\Commands;

use \Illuminate\Console\Command;
class PublishCommand extends Command
{
    /**
     * The console command name.
     */
    protected $name = 'publish:core-gate';

    /**
     * The console command description.
     */
    protected $description = 'Publish core gate config files.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('vendor:publish', [
            '--tag' => 'config-gate'
        ]);
    }
}