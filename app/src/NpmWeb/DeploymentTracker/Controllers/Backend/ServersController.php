<?php namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\DeploymentTracker\Models\Server;

class ServersController extends BaseController {

    /**
     * Display a listing of servers
     *
     * @return Response
     */
    public function index()
    {
        if( Request::wantsJson() ) {
            $servers = Server::with('environment')->get();
            return Response::json([
                'status' => 'success',
                'servers' => $servers->toArray(),
            ]);
        } else {
            return View::make('servers.index');
        }
    }

    /**
     * Show the form for creating a new server
     *
     * @return Response
     */
    public function create()
    {
        $server = new Server;
        return View::make('servers.edit',compact('server'));
    }

    /**
     * Store a newly created server in storage.
     *
     * @return Response
     */
    public function store()
    {
        $server = new Server(Input::all());
        $server->save();

        if ($server->errors()->any())
        {
            return Redirect::back()->withErrors($server->errors())->withInput();
        }

        return Redirect::route('servers.index')
            ->with('myflash', 'Your server has been created.');
    }

    /**
     * Display the specified server.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $server = Server::findOrFail($id);

        return View::make('servers.show', compact('server'));
    }

    /**
     * Show the form for editing the specified server.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $server = Server::findOrFail($id);

        return View::make('servers.edit', compact('server'));
    }

    /**
     * Update the specified server in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $server = Server::findOrFail($id);
        $server->update(Input::all());

        if ($server->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('servers.index')
            ->with('myflash', 'Your server has been updated.');
    }

    /**
     * Remove the specified server from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Server::destroy($id);

        return Redirect::route('servers.index')
            ->with('myflash', 'Your server has been deleted.');
    }

}
