<?php

namespace Raid\Core\Gate\Commands;

use Raid\Core\Command\Commands\PublishCommand;

class PublishGateCommand extends PublishCommand
{
    /**
     * The console command name.
     */
    protected $name = 'core:publish-gate';

    /**
     * The console command description.
     */
    protected $description = 'Publish core gate config files.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->publishCommand('config-gate');
    }
}