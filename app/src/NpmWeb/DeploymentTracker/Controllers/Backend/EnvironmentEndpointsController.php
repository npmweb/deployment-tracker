<?php namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\DeploymentTracker\Models\Endpoint;
use NpmWeb\DeploymentTracker\Models\EnvironmentEndpoint;

class EnvironmentEndpointsController extends BaseController {

    /**
     * Display a listing of environmentendpoints
     *
     * @return Response
     */
    public function index($appUid, $endpointUid)
    {
        $endpoint = Endpoint::find($endpointUid);
        if( $endpoint->application->uid != $appUid ) {
            return App::abort('404'); // no html view
        }

        if( Request::wantsJson() ) {
            $environmentendpoints = $endpoint->environmentEndpoints()->with('environment')->with('domain')->get();
            return Response::json([
                'status' => 'success',
                'environmentendpoints' => $environmentendpoints->toArray(),
            ]);
        } else {
            return View::make('environment_endpoints.index', compact('endpoint'));
        }
    }

    /**
     * Show the form for creating a new environmentendpoint
     *
     * @return Response
     */
    public function create($appUid, $endpointUid)
    {
        $endpoint = Endpoint::find($endpointUid);
        if( $endpoint->application->uid != $appUid ) {
            return App::abort('404'); // no html view
        }

        $environmentendpoint = new EnvironmentEndpoint;
        $environmentendpoint->endpoint_id = $endpoint->id;

        return View::make('environment_endpoints.edit',compact('environmentendpoint'));
    }

    /**
     * Store a newly created environmentendpoint in storage.
     *
     * @return Response
     */
    public function store($appUid, $endpointUid)
    {
        $endpoint = Endpoint::find($endpointUid);
        if( $endpoint->application->uid != $appUid ) {
            return App::abort('404'); // no html view
        }

        $environmentendpoint = new EnvironmentEndpoint(Input::all());
        $environmentendpoint->endpoint_id = $endpoint->id;
        $environmentendpoint->save();

        if ($environmentendpoint->errors()->any())
        {
            return Redirect::back()->withErrors($environmentendpoint->errors())->withInput();
        }

        return Redirect::route('applications.endpoints.environment_endpoints.index', [$appUid, $endpointUid])
            ->with('myflash', 'Your environmentendpoint has been created.');
    }

    /**
     * Display the specified environmentendpoint.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($appUid, $endpointUid, $id)
    {
        $environmentendpoint = EnvironmentEndpoint::findOrFail($id);
        if( $environmentendpoint->endpoint->uid != $endpointUid
            || $environmentendpoint->endpoint->application->uid != $appUid
        ) {
            return App::abort('404'); // no html view
        }

        return View::make('environment_endpoints.show', compact('environmentendpoint'));
    }

    /**
     * Show the form for editing the specified environmentendpoint.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($appUid, $endpointUid, $id)
    {
        $environmentendpoint = EnvironmentEndpoint::findOrFail($id);
        if( $environmentendpoint->endpoint->uid != $endpointUid
            || $environmentendpoint->endpoint->application->uid != $appUid
        ) {
            return App::abort('404'); // no html view
        }

        return View::make('environment_endpoints.edit', compact('environmentendpoint'));
    }

    /**
     * Update the specified environmentendpoint in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($appUid, $endpointUid, $id)
    {
        $environmentendpoint = EnvironmentEndpoint::findOrFail($id);
        if( $environmentendpoint->endpoint->uid != $endpointUid
            || $environmentendpoint->endpoint->application->uid != $appUid
        ) {
            return App::abort('404'); // no html view
        }

        $environmentendpoint->update(Input::all());
        if ($environmentendpoint->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('applications.endpoints.environment_endpoints.index',[$appUid, $endpointUid])
            ->with('myflash', 'Your environmentendpoint has been updated.');
    }

    /**
     * Remove the specified environmentendpoint from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($appUid, $endpointUid, $id)
    {
        $environmentendpoint = EnvironmentEndpoint::findOrFail($id);
        if( $environmentendpoint->endpoint->uid != $endpointUid
            || $environmentendpoint->endpoint->application->uid != $appUid
        ) {
            return App::abort('404'); // no html view
        }

        EnvironmentEndpoint::destroy($id);

        return Redirect::route('applications.endpoints.environment_endpoints.index', [$appUid, $endpointUid])
            ->with('myflash', 'Your environmentendpoint has been deleted.');
    }

}
