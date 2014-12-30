<?php namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\DeploymentTracker\Models\Application;
use NpmWeb\DeploymentTracker\Models\Endpoint;

class EndpointsController extends BaseController {

    /**
     * Display a listing of endpoints
     *
     * @return Response
     */
    public function index($appUid)
    {
        $application = Application::find($appUid);
        if( Request::wantsJson() ) {
            $endpoints = $application->endpoints;
            return Response::json([
                'status' => 'success',
                'endpoints' => $endpoints->toArray(),
            ]);
        } else {
            return View::make('endpoints.index', compact('application'));
        }
    }

    /**
     * Show the form for creating a new endpoint
     *
     * @return Response
     */
    public function create($appUid)
    {
        $endpoint = new Endpoint;
        $endpoint->application_id = Application::find($appUid)->id;
        return View::make('endpoints.edit',compact('endpoint'));
    }

    /**
     * Store a newly created endpoint in storage.
     *
     * @return Response
     */
    public function store($appUid)
    {
        $endpoint = new Endpoint(Input::all());
        $endpoint->application_id = Application::find($appUid)->id;

        $endpoint->save();
        if ($endpoint->errors()->any())
        {
            return Redirect::back()->withErrors($endpoint->errors())->withInput();
        }

        return Redirect::route('applications.endpoints.index', $appUid)
            ->with('myflash', 'Your endpoint has been created.');
    }

    /**
     * Display the specified endpoint.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($appUid, $id)
    {
        $endpoint = Endpoint::findOrFail($id);
        if( $endpoint->application->uid != $appUid ) {
            return App::abort('404'); // no html view
        }

        return View::make('endpoints.show', compact('endpoint'));
    }

    /**
     * Show the form for editing the specified endpoint.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($appUid, $id)
    {
        $endpoint = Endpoint::findOrFail($id);
        if( $endpoint->application->uid != $appUid ) {
            return App::abort('404'); // no html view
        }

        return View::make('endpoints.edit', compact('endpoint'));
    }

    /**
     * Update the specified endpoint in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($appUid, $id)
    {
        $endpoint = Endpoint::findOrFail($id);
        if( $endpoint->application->uid != $appUid ) {
            return App::abort('404'); // no html view
        }

        $endpoint->update(Input::all());
        if ($endpoint->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('applications.endpoints.index', $appUid)
            ->with('myflash', 'Your endpoint has been updated.');
    }

    /**
     * Remove the specified endpoint from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($appUid, $id)
    {
        $endpoint = Endpoint::findOrFail($id);
        if( $endpoint->application->uid != $appUid ) {
            return App::abort('404'); // no html view
        }
        Endpoint::destroy($id);

        return Redirect::route('applications.endpoints.index', $appUid)
            ->with('myflash', 'Your endpoint has been deleted.');
    }

}
