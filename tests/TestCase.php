<?php

namespace Sluggable\Tests;

class TestCase extends \Orchestra\Testbench\Dusk\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}
