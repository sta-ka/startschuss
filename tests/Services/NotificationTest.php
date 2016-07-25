<?php

use App\Services\Notification\NotificationService;

class NotificationTest extends TestCase {

    protected $notification;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->notification =  new NotificationService();
    }

    /**
     * Test setting "Success Notification".
     */
    public function testSuccessNotification()
    {
        $text = "Test was succesful";
        $this->notification->success($text);

        $output = $this->notification->display();

        $this->assertContains("alert-success", $output); // has class name
        $this->assertContains($text, $output); // contains message
    }

    /**
     * Test setting "Error Notification".
     */
    public function testErrorNotification()
    {
        $text = "Test was not succesful";
        $this->notification->error($text);

        $output = $this->notification->display();

        $this->assertContains("alert-danger", $output); // has class name
        $this->assertContains($text, $output); // contains message
    }

    /**
     * Test setting a message.
     */
    public function testSettingMessage()
    {
        $text = 'This is an success message.';
        $type = 'success';

        $this->notification->set($text, $type);

        $this->assertTrue(\Session::has('message'));

        $message = \Session::get('message');

        // contains message
        $this->assertEquals($type, $message['type']);
        $this->assertEquals($text, $message['message']);
    }

}
