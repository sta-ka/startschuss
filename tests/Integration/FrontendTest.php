<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontendTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic frontpage test.
     *
     * @return void
     */
    public function testFrontpage()
    {
        $this->visit('/')
             ->see('Karriere- und Jobmessen');
    }

    /**
     * Test for successful registration.
     *
     * @return void
     */
    public function testNewUserRegistration()
    {
        $this->withoutEvents();

        $this->visit('registrieren')
             ->type('max.h.online', 'username')
             ->type('max.h.online@gmx.de', 'email')
             ->type('secretpw', 'password')
             ->type('secretpw', 'password_confirmation')
             ->press('Registrieren');

        // expected response
        $this->see('Registrierung war erfolgreich');

        $this->seeInDatabase('users', ['username' => 'max.h.online', 'activated' => 0]);
    }

    /**
     * Test new user registration with validation errors.
     *
     * @return void
     */
    public function testNewUserRegistrationValidation()
    {
        $this->visit('registrieren')
             ->type('max.', 'username')
             ->type('max.h.online', 'email')
             ->type('secretpw', 'password')
             ->type('wrongpw', 'password_confirmation')
             ->press('Registrieren');

        // expected validation error
        $this->see('<strong>Login</strong> ist nicht gültig.')
             ->see('<strong>E-Mail</strong> ist keine gültige E-Mail-Adresse.')
             ->see('<strong>Passwort</strong> und Passwort-Bestätigung müssen übereinstimmen.');
    }

    /**
     * Test validation for contact form.
     *
     * @return void
     */
    public function testContactValidation()
    {
        $this->visit('kontakt')
             ->type('', 'name')
             ->type('max.h.online', 'email')
             ->type('Testnachricht', 'body')
             ->press('Senden');

        // expected validation error
        $this->see('<strong>Name</strong> muss ausgefüllt sein.')
             ->see('<strong>E-Mail</strong> ist keine gültige E-Mail-Adresse.');
    }
}
