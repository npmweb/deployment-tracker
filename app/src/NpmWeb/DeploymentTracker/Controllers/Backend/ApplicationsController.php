<?php namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\DeploymentTracker\Models\Application;

class ApplicationsController extends BaseController {

    /**
     * Display a listing of applications
     *
     * @return Response
     */
    public function index()
    {
        if( Request::wantsJson() ) {
            $applications = Application::all();
            return Response::json([
                'status' => 'success',
                'applications' => $applications->toArray(),
            ]);
        } else {
            return View::make('applications.index');
        }
    }

    /**
     * Show the form for creating a new application
     *
     * @return Response
     */
    public function create()
    {
        $application = new Application;
        return View::make('applications.edit',compact('application'));
    }

    /**
     * Store a newly created application in storage.
     *
     * @return Response
     */
    public function store()
    {
        $application = new Application(Input::all());
        $application->save();

        if ($application->errors()->any())
        {
            return Redirect::back()->withErrors($application->errors())->withInput();
        }

        return Redirect::route('applications.index')
            ->with('myflash', 'Your application has been created.');
    }

    /**
     * Display the specified application.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $application = Application::findOrFail($id);

        return View::make('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified application.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $application = Application::findOrFail($id);

        return View::make('applications.edit', compact('application'));
    }

    /**
     * Update the specified application in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $application = Application::findOrFail($id);
        $application->update(Input::all());

        if ($application->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('applications.index')
            ->with('myflash', 'Your application has been updated.');
    }

    /**
     * Remove the specified application from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Application::destroy($id);

        return Redirect::route('applications.index')
            ->with('myflash', 'Your application has been deleted.');
    }

}
