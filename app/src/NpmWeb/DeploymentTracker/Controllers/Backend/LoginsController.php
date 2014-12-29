<?php

namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use Auth;
use Input;
use Redirect;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use Illuminate\Auth\GenericUser;

class LoginsController extends BaseController {

    protected $modelName = 'logins';
    protected $loggedInDefaultUrl = '/';
    protected $loggedOutDefaultUrl = '/';

    /**
     * Show the login form.
     *
     * @return Response
     */
    public function create()
    {
        if( Auth::check() ) {
            return Redirect::to($this->loggedInDefaultUrl);
        }
        return View::make($this->modelName.'.edit',['model'=>new GenericUser([])]);
    }

    /**
     * Attempt to log the user in.
     *
     * @return Response
     */
    public function store()
    {
        if(Auth::attempt(['username'=>Input::get('username'),
                            'password'=>Input::get('password')])) {
            return Redirect::intended();
        } else {
            return Redirect::route($this->modelName.'.create')
                ->with('myflash','Username or password incorrect.');
        }
    }

    /**
     * Log the user out.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Auth::logout();
        return Redirect::to($this->loggedOutDefaultUrl);
    }

}
