<?php

class UsersController extends BaseController{

	
	public function index(){
		return Company::find(1)->types()->get()->toJson();
	}
	public function getLogin() {
		return Auth::check()?Redirect::route('dashboard'):View::make('users.login');
	}

	public function postLogin() {
		Session::put('email_remembered', Input::get('email'));
		if ( Auth::attempt( array('email' => Input::get('email'), 'password' => Input::get('password') ) ) ) {
			return Redirect::intended( URL::to('/') )->with('success', 'Welcome! You have successfully logged in.');
		} else {
			return Redirect::route('login')->with('error', sprintf('Your email address and/or password is incorrect. Click here to <a href="%s">reset your password</a>.', URL::route('reset-password')));
		}
	}

	public function getLogout() {
		Session::flush();
		Auth::logout();
		Session::flash('success', 'You have successfully logged out.');
		return Redirect::route('login');
	}

	public function getResetPassword() {
		return View::make('users.reset-password');
	}

	public function postResetPassword() {
		$credentials = array('email' => Input::get('email'));
		Password::remind($credentials, function($message, $user) {
			$message->subject('Reset your password');
		});
		Session::flash('success', 'Please check your email for a link to reset your password.');
		return Redirect::route('login');
	}

	public function getResetPasswordToken($token) {
		Session::flash('info', 'Please enter a new password.');
		return View::make('users.reset-password')->with('token', $token);
	}

	public function postResetPasswordToken($token) {
		$credentials = array('email' => Input::get('email'));
		return Password::reset($credentials, function($user, $password) {
			$user->password = Hash::make($password);
			$user->save();
			Auth::login($user);
			Session::flash('success', 'Your password has been successfully changed.');
			return Redirect::route('dashboard');
		});
	}

	public function getChangePassword() {
		return View::make('users.change-password');
	}

	public function postChangePassword() {
		$credentials = array('email' => Auth::user()->email, 'password' => Input::get('password'));
		if ( Auth::validate($credentials) ) {
			$validator = Validator::make(
				Input::all(),
				array('new_password' => array('required', 'min:8', 'confirmed'))
			);
			if ( $validator->fails() ) {
				$messages = $validator->messages();
				return Redirect::route('change-password')->with('error', join('<br>', $messages->all()));
			} else {
				$user = User::find(Auth::user()->id);
				$user->password = Hash::make(Input::get('new_password'));
				$user->save();
				return Redirect::route('dashboard')->with('success', 'Your password has been successfully changed.');
			}
		} else {
			return Redirect::route('change-password')->with('error', 'Your current password is incorrect.');
		}
	}
}

