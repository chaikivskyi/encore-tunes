<?php

namespace Tests\Feature\ContactMe;

use App\ContactMe\Mail\ContactMeMail;
use App\ContactMe\Settings\ContactMeSettings;
use App\Livewire\ContactMe\ContactForm;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactMeFormTest extends TestCase
{
    protected ContactMeSettings $contactMeSettings;

    protected function setUp(): void
    {
        parent::setUp();
        $this->contactMeSettings = $this->createMock(ContactMeSettings::class);
        $this->contactMeSettings->email = 'admin@example.com';
    }

    public function test_contact_me_form_can_be_rendered()
    {
        $response = $this->get(route('index'));
        $response
            ->assertOk()
            ->assertSeeLivewire(ContactForm::class);
    }

    public function test_user_submit_contact_form()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->set('message', 'Test Message')
            ->call('submit', $this->contactMeSettings);

        Mail::assertSent(ContactMeMail::class, function ($mail) {
            return $mail->hasTo('admin@example.com');
        });
    }
}
