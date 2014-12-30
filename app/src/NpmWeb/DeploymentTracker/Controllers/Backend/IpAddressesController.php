<?php namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use App;
use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\DeploymentTracker\Models\IpAddress;
use NpmWeb\DeploymentTracker\Models\Server;

class IpAddressesController extends BaseController {

    /**
     * Display a listing of ipaddresses
     *
     * @return Response
     */
    public function index($serverUid)
    {
        $server = Server::find($serverUid);
        if( Request::wantsJson() ) {
            $ipaddresses = $server->ipAddresses()->with('domains')->get();
            return Response::json([
                'status' => 'success',
                'ipaddresses' => $ipaddresses->toArray(),
            ]);
        } else {
            return View::make('ip_addresses.index', compact('server'));
        }
    }

    /**
     * Show the form for creating a new ipaddress
     *
     * @return Response
     */
    public function create($serverUid)
    {
        $ipaddress = new IpAddress;
        $ipaddress->server_id = Server::find($serverUid)->id;
        // var_dump($ipaddress);

        return View::make('ip_addresses.edit',compact('ipaddress'));
    }

    /**
     * Store a newly created ipaddress in storage.
     *
     * @return Response
     */
    public function store($serverUid)
    {
        $ipaddress = new IpAddress(Input::all());
        $ipaddress->server_id = Server::find($serverUid)->id;
        $ipaddress->save();

        if ($ipaddress->errors()->any())
        {
            return Redirect::back()->withErrors($ipaddress->errors())->withInput();
        }

        return Redirect::route('servers.ip_addresses.index',$ipaddress->server->uid)
            ->with('myflash', 'Your ipaddress has been created.');
    }

    /**
     * Display the specified ipaddress.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($serverUid, $id)
    {
        $ipaddress = IpAddress::findOrFail($id);

        if( $ipaddress->server->uid != $serverUid ) {
            return App::abort('404'); // no html view
        }

        return View::make('ip_addresses.show', compact('ipaddress'));
    }

    /**
     * Show the form for editing the specified ipaddress.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($serverUid, $id)
    {
        $ipaddress = IpAddress::findOrFail($id);
        if( $ipaddress->server->uid != $serverUid ) {
            return App::abort('404'); // no html view
        }

        return View::make('ip_addresses.edit', compact('ipaddress'));
    }

    /**
     * Update the specified ipaddress in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($serverUid, $id)
    {
        $ipaddress = IpAddress::findOrFail($id);
        if( $ipaddress->server->uid != $serverUid ) {
            return App::abort('404'); // no html view
        }

        $ipaddress->update(Input::all());
        if ($ipaddress->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('servers.ip_addresses.index',$ipaddress->server->uid)
            ->with('myflash', 'Your ipaddress has been updated.');
    }

    /**
     * Remove the specified ipaddress from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($serverUid, $id)
    {
        $ipaddress = IpAddress::findOrFail($id);
        if( $ipaddress->server->uid != $serverUid ) {
            return App::abort('404'); // no html view
        }
        IpAddress::destroy($id);

        return Redirect::route('servers.ip_addresses.index', $serverUid)
            ->with('myflash', 'Your ipaddress has been deleted.');
    }

}
