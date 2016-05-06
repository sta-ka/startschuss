<?php namespace App\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Cartalyst\Sentry\Users as UserException;
use Cartalyst\Sentry\Throttling as ThrottlingException;

use App\Models\User\UserRepository as Users;
use App\Services\Creator\UserCreator;

use App\Services\Mailers\UserMailer;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\ForgottenPasswordRequest;
use App\Http\Requests\User\NewPasswordRequest;
use App\Http\Requests\User\ContactRequest;

use Input;
use Sentry;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Frontend
 */
class UsersController extends Controller {

	/**
	 * Display Login page.
     *
     * @return \Illuminate\View\View
	 */
	public function login()
	{
		return view('start.misc.login');
	}

	/**
	 * Process Login.
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function processLogin(LoginRequest $request)
	{
		try {
			$credentials = [
					'username' => Input::get('username'),
					'password' => Input::get('password')
			];

			$user = Sentry::findUserByLogin($credentials['username']);

			Sentry::authenticate($credentials, false);

			event('log.login', [$request->get('username'), true, null, $user->getId()]);
			
			notify('success', 'login');

			// routing depending on type of group
			if ($user->inGroup(Sentry::findGroupByName('admin'))) {
				return redirect('admin/users');
			} elseif ($user->inGroup(Sentry::findGroupByName('organizer'))) {
				return redirect('organizer/profile');
			} elseif ($user->inGroup(Sentry::findGroupByName('company'))) {
				return redirect('company/profile');
			} elseif ($user->inGroup(Sentry::findGroupByName('applicant'))) {
				return redirect('applicant/dashboard');
			} else {
				return redirect('logout');
			}
		} catch (UserException\WrongPasswordException $e) {
			$message = 'Falsches Passwort';
		} catch (UserException\UserNotFoundException $e) {
			$message = 'Nutzer nicht gefunden';
		} catch (ThrottlingException\UserSuspendedException $e) {
			$message = 'Nutzer temporär gespeert';
		} catch (ThrottlingException\UserBannedException $e) {
			$message = 'Nutzer gespeert';
		} catch (UserException\UserNotActivatedException $e) {
			$message = 'Nutzer nicht aktiviert';
		} catch (\Exception $e) {
			$message = 'Unbekannter Fehler';
		}

		event('log.login', [$request->get('username'), false, $message]);
		notify('error', 'login');

		return back()->withInput($request->only('username'));
	}

	/**
	 * Display Register page.
     *
     * @return mixed
	 */
	public function register() 
	{
//		notify('error', 'registration_disabled', false);
//
//		return redirect('home');

		return view('start.misc.register');
	}

	/**
	 * Process Registration.
     *
     * @param RegisterRequest $request
     * @param Users $userRepo
     *
     * @return mixed
	 */
	public function processRegistration(RegisterRequest $request, Users $userRepo)
	{
//		notify('error', 'registration_disabled', false);
//
//		return redirect('home');

		$success = (new UserCreator($userRepo))
        			->register($request->all());

        notify($success, 'registration');

        return redirect('home');
	}


	/**
	 * Activate account if correct key is given.
     *
     * @param string $key
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function activateAccount($key)
	{
		try {
			list($user_id, $activation_key) = explode('/', base64_decode($key));

			$user = Sentry::findUserById($user_id);

			if ($user->attemptActivation($activation_key) == false) {
                notify('error', 'activate');
                return redirect('home');
            }

            event('log.event', [$user->username .': Kontoaktivierung.']);
            notify('success', 'activate');

            return redirect('home');
		} catch (UserException\UserNotFoundException $e) {
			event('log.event', ['Kontoaktivierung: Nutzer nicht gefunden.']);
			notify('error', 'activate');
		} catch (UserException\UserAlreadyActivatedException $e) {
			event('log.event', ['Kontoaktivierung: Nutzer bereits aktiv.']);
			notify('error', 'user_already_activated', false);
		}

		return redirect('home');
	}

	/**
	 * Display 'Forgot password' form.
     *
     * @return \Illuminate\View\View
	 */
	public function forgotPassword()
	{
		return view('start.misc.forgot_password');
	}

	/**
	 * Process 'Forgot password' form.
     *
     * @param ForgottenPasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function processForgottenPassword(ForgottenPasswordRequest $request)
	{
        $credentials = [
            'username' 	=> $request->get('username'),
            'email'		=> $request->get('email')
        ];

		try {
			$user = Sentry::findUserByCredentials($credentials);

            $data['reset_code'] = base64_encode($user->getId() .'/'. $user->getResetPasswordCode());

            $success = (new UserMailer($user))
                        ->resetPasswordMail($data)->deliver(false);

            if ($success == false) {
                notify('error', 'new_password_mail_not_sent', false);
                return redirect('home');
            }

            $message = 'Mail für neues Passwort versandt ('. $user->username . '/' . $user->email .').';
            event('log.event', [$message]);

            notify('success', 'new_password_mail_sent', false);
            return redirect('home');
        } catch (UserException\UserNotFoundException $e) {
            $message = 'Passwort zurücksetzen fehlgeschlagen (' .$credentials['username'] . '/' . $credentials['email'] .').';
            event('log.event', [$message]);

            notify('error', 'new_password_mail_not_sent', false);

            return back()->withInput();
        }
    }

	/**
	 * Display 'Reset password' form.
     *
     * @param string $key
     *
     * @return \Illuminate\View\View
	 */
	public function newPassword($key)
	{
		try {
			list($user_id, $reset_code) = explode('/', base64_decode($key));

			$user = Sentry::findUserById($user_id);

			// Check if the reset password code is valid
			if ($user->checkResetPasswordCode($reset_code) == false) {
                notify('error', 'key_not_found', false);
                return redirect('home');
            }

            return view('start.misc.reset_password');
		} catch (UserException\UserNotFoundException $e) {
			event('log.event', ['Versuchte Vergabe eines neuen Passworts. Nutzer nicht gefunden.']);
			notify('error', 'key_not_found', false);

			return redirect('home');
		}
		
	}

	/**
	 * Process reset password form.
     *
     * @param NewPasswordRequest $request
     * @param string $key
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function processNewPassword(NewPasswordRequest $request, $key)
	{
		try {
			list($user_id, $reset_code) = explode('/', base64_decode($key));

			$user = Sentry::findUserById($user_id);

			// Check if the reset password code is valid and attempt to reset the user password
			if ($user->checkResetPasswordCode($reset_code) == false || $user->attemptResetPassword($reset_code, $request->get('password')) == false) {
                notify('error', 'reset_password');
                return redirect('home');
            }

            event('log.event', [$user->username .': Neues Passwort vergeben.']);

            notify('success', 'reset_password');
            return redirect('home');
        } catch (UserException\UserNotFoundException $e) {
			event('log.event', ['Versuchte Vergabe eines neuen Passworts. Nutzer nicht gefunden.']);

			notify('error', 'reset_password');
			return redirect('home');
		}
	}

	/**
	 * Log user out.
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout()
	{
		Sentry::logout();

		notify('success', 'logout');
		return redirect('home');
	}

	/**
	 * Display 'Contact' form.
     *
     * @return \Illuminate\View\View
	 */
	public function contact()
	{
		return view('start.misc.contact');
	}

	/**
	 * Process 'Contact' form and send mail.
     *
     * @param ContactRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
	 */
	public function sendContactMail(ContactRequest $request)
	{
        (new UserMailer)->contact($request->all())
                        ->deliver();

		return redirect('home');
	}

}	
