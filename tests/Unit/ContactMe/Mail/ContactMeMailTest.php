<?php

namespace Tests\Unit\ContactMe\Mail;

use App\ContactMe\Mail\ContactMeMail;
use Illuminate\Mail\Mailables\Content;
use Tests\TestCase;

class ContactMeMailTest extends TestCase
{
    protected ContactMeMail $contactMeMail;

    public function setUp(): void
    {
        parent::setUp();
        $this->contactMeMail = $this->app->make(
            ContactMeMail::class,
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'message' => 'Hello, this is a test message.'
            ]
        );
    }

    public function testEnvelope()
    {
        config()->set('app.name', 'Test App');
        $envelope = $this->contactMeMail->envelope();
        $this->assertEquals(config('app.name') . ' - Contact Me', $envelope->subject);
    }

    public function testContent(): void
    {
        $content = $this->contactMeMail->content();
        $this->assertInstanceof(Content::class, $content);
        $this->assertEquals(
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'message' => 'Hello, this is a test message.',
            ],
            $content->with
        );
    }
}
