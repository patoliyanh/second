<?php

namespace Tests\Feature;

use Tests\TestCase;

class ConsoleCommandTest extends TestCase
{
    /** @test */
    public function test_inspire_command_runs_with_input_and_choice()
    {
        $this->artisan('greet')
             ->expectsQuestion('What is your name?', 'Namita')
             ->expectsChoice('Which language do you prefer?', 'PHP', ['PHP', 'Python', 'Ruby'])
             ->expectsOutput('Your name is Namita and you prefer PHP.')
             ->assertExitCode(0);
    }
}
