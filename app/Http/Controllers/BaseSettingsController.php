<?php namespace App\Http\Controllers;

use App\Models\User\UserRepository as Users;

use App\Http\Requests\User\UpdatePasswordRequest;
use App\Http\Requests\User\UpdateEmailRequest;

use Input;
use Sentry;

/**
 * Class BaseSettingsController
 *
 * @package App\Http\Controllers
 */
class BaseSettingsController extends Controller {

    /**
     * @var Users.
     */
    private $userRepo;

    /**
     * Usertype (admin, company, applicant, organizer).
     *
     * @var $user_type
     */
    protected $user_type;

    /**
     * Constructor: inject dependencies.
     *
     * @param Users $userRepo
     */
    public function __construct(Users $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Redirect to 'Settings overview' page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return redirect($this->user_type . '/settings/show');
    }

    /**
     * Settings overview.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $data['user'] = $this->userRepo->findById(Sentry::getUser()->getId());

        return view($this->user_type . '.settings.show', $data);
    }

    /**
     * Display 'Change password' form.
     *
     * @return \Illuminate\View\View
     */
    public function changePassword()
    {
        return view($this->user_type . '.settings.change_password');
    }

    /**
     * Process changing password.
     *
     * @param UpdatePasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $success = $request->persist();

        $user = \Sentry::getUser();

        if ($success == false) {
            notify('error', 'password_change');

            $message = '%s (ID: %d): Passwort Änderung fehlgeschlagen.';
            event('log.event', [sprintf($message, $user->username, $user->getId())]);

            return back();
        }

        $message = '%s (ID: %d): Passwort geändert.';
        event('log.event', [sprintf($message, $user->username, $user->getId())]);

        notify('success', 'password_change');

        return redirect($this->user_type . '/settings/show');
    }

    /**
     * Display 'Change email' form.
     *
     * @return \Illuminate\View\View
     */
    public function changeEmail()
    {
        return view($this->user_type . '.settings.change_email');
    }

    /**
     * Process changing email.
     *
     * @param UpdateEmailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEmail(UpdateEmailRequest $request)
    {
        $success = $request->persist();

        if ($success == false) {
            notify('error', 'email_update');
            return back()->withInput(Input::only('email'));
        }

        $user = \Sentry::getUser();
        $message = '%s (ID: %d): Email Adresse geändert.';
        event('log.event', [sprintf($message, $user->username, $user->getId())]);

        notify('success', 'email_update');
        return redirect($this->user_type . '/settings/show');
    }
}