<?php
namespace DoctorFinder\Model;

/**
 * This is wrapper class of Sentry package
 */

use Cartalyst\Sentry\Facades\Laravel\Sentry as Sentry;

class User
{
    /**
     * Wrapper method of Sentry
     * @param $credentials
     * @param bool $remember_me
     * @return string
     */
    public function authenticate($credentials, $remember_me = false)
    {
        $response = null;
        try {
            $response = Sentry::login($credentials, false);
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {

            $response = 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $response = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
            $response = 'Wrong password, try again.';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            $response = 'User was not found.';
        } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
            $response = 'User is not activated.';
        }

        return $response;
    }

    /**
     * Check current user login
     * @return boolean
     */
    public function isLogin()
    {
        return Sentry::check();
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Sentry::logout();
    }

    /**
     * Register user
     * @param $credentials
     * @param bool $activate
     * @return mixed
     */
    public function register($credentials, $activate = false)
    {
        $response = null;
        try {
            $register = Sentry::register($credentials, $activate);
            $response = $register->getActivationCode();
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            $response = 'Login field is required.';
        } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
            $response = 'Password field is required.';
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            $response = 'User with this login already exists.';
        }
        return $response;
    }
}
