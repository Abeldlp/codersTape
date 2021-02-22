<?php

namespace Tests\Feature;

use App\Events\NewEntryReceivedEvent;
use App\Mail\WelcomeContestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Throwable;

class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();

    }

    /** @test */
    public function an_email_can_be_entered_into_the_contest()
    {
        $this->post('/contest', [
            'email' => 'test@test.com'
        ]);
        $this->assertDatabaseCount('contest_entries', 1);
    }

    /** @test */
    public function email_is_required()
    {
        $this->post('/contest', [
            'email' => ''
        ]);
        $this->assertDatabaseCount('contest_entries', 0);
    }

    /** @test */
    public function email_needs_to_be_an_email()
    {
        $this->post('/contest', [
            'email' => 'asfasg'
        ]);
        $this->assertDatabaseCount('contest_entries', 0);
    }

    /** @test */
    public function an_event_is_fired_when_used_register()
    {
        Event::fake([
            NewEntryReceivedEvent::class,
        ]);

        $this->post('/contest', [
            'email' => 'test@test.com'
        ]);

        Event::assertDispatched(NewEntryReceivedEvent::class);
    }

    /** @test */
    public function a_welcome_email_is_sent()
    {
        $this->post('/contest', [
            'email' => 'test@test.com'
        ]);

        Mail::assertQueued(WelcomeContestMail::class);
    }
}
