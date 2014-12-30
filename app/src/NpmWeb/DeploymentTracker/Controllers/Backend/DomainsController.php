<?php namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use App;
use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\DeploymentTracker\Models\Domain;
use NpmWeb\DeploymentTracker\Models\IpAddress;

class DomainsController extends BaseController {

    /**
     * Display a listing of domains
     *
     * @return Response
     */
    public function index( $serverUid, $ipAddressUid )
    {
        $ipAddress = IpAddress::find($ipAddressUid);
        if( $ipAddress->server->uid != $serverUid ) {
            return App::abort('404'); // no html view
        }

        if( Request::wantsJson() ) {

            $domains = $ipAddress->domains;
            return Response::json([
                'status' => 'success',
                'domains' => $domains->toArray(),
            ]);
        } else {
            return View::make('domains.index',
                compact('ipAddress'));
        }
    }

    /**
     * Show the form for creating a new domain
     *
     * @return Response
     */
    public function create($serverUid, $ipAddressUid)
    {
        $ipaddress = IpAddress::findOrFail($ipAddressUid);
        if( $ipaddress->server->uid != $serverUid ) {
            return App::abort('404'); // no html view
        }

        $domain = new Domain;
        $domain->ip_address_id = $ipaddress->id;

        return View::make('domains.edit',compact('domain'));
    }

    /**
     * Store a newly created domain in storage.
     *
     * @return Response
     */
    public function store($serverUid, $ipAddressUid)
    {
        $ipaddress = IpAddress::findOrFail($ipAddressUid);
        if( $ipaddress->server->uid != $serverUid ) {
            return App::abort('404'); // no html view
        }

        $domain = new Domain(Input::all());
        $domain->ip_address_id = $ipaddress->id;
        $domain->save();

        if ($domain->errors()->any())
        {
            return Redirect::back()->withErrors($domain->errors())->withInput();
        }

        return Redirect::route('servers.ip_addresses.domains.index',[$serverUid, $ipAddressUid])
            ->with('myflash', 'Your domain has been created.');
    }

    /**
     * Display the specified domain.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($serverUid, $ipAddressUid, $id)
    {
        $domain = Domain::findOrFail($id);
        if( $domain->ipaddress->uid != $ipAddressUid
            || $domain->ipaddress->server->uid != $serverUid
        ) {
            return App::abort('404'); // no html view
        }

        return View::make('domains.show', compact('domain'));
    }

    /**
     * Show the form for editing the specified domain.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($serverUid, $ipAddressUid, $id)
    {
        $domain = Domain::findOrFail($id);
        if( $domain->ipaddress->uid != $ipAddressUid
            || $domain->ipaddress->server->uid != $serverUid
        ) {
            return App::abort('404'); // no html view
        }

        return View::make('domains.edit', compact('domain'));
    }

    /**
     * Update the specified domain in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($serverUid, $ipAddressUid, $id)
    {
        $domain = Domain::findOrFail($id);
        if( $domain->ipaddress->uid != $ipAddressUid
            || $domain->ipaddress->server->uid != $serverUid
        ) {
            return App::abort('404'); // no html view
        }

        $domain->update(Input::all());
        if ($domain->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('servers.ip_addresses.domains.index',[$serverUid, $ipAddressUid])
            ->with('myflash', 'Your domain has been updated.');
    }

    /**
     * Remove the specified domain from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($serverUid, $ipAddressUid, $id)
    {
        $domain = Domain::findOrFail($id);
        if( $domain->ipaddress->uid != $ipAddressUid
            || $domain->ipaddress->server->uid != $serverUid
        ) {
            return App::abort('404'); // no html view
        }
        Domain::destroy($id);

        return Redirect::route('servers.ip_addresses.domains.index', [$serverUid, $ipAddressUid])
            ->with('myflash', 'Your domain has been deleted.');
    }

}
