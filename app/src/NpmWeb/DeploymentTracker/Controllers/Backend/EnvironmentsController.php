<?php namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\DeploymentTracker\Models\Environment;

class EnvironmentsController extends BaseController {

    /**
     * Display a listing of environments
     *
     * @return Response
     */
    public function index()
    {
        if( Request::wantsJson() ) {
            $environments = Environment::all();
            return Response::json([
                'status' => 'success',
                'environments' => $environments->toArray(),
            ]);
        } else {
            return View::make('environments.index');
        }
    }

    /**
     * Show the form for creating a new environment
     *
     * @return Response
     */
    public function create()
    {
        $environment = new Environment;
        return View::make('environments.edit',compact('environment'));
    }

    /**
     * Store a newly created environment in storage.
     *
     * @return Response
     */
    public function store()
    {
        $environment = new Environment(Input::all());
        $environment->save();

        if ($environment->errors()->any())
        {
            return Redirect::back()->withErrors($environment->errors())->withInput();
        }

        return Redirect::route('environments.index')
            ->with('myflash', 'Your environment has been created.');
    }

    /**
     * Display the specified environment.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $environment = Environment::findOrFail($id);

        return View::make('environments.show', compact('environment'));
    }

    /**
     * Show the form for editing the specified environment.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $environment = Environment::findOrFail($id);

        return View::make('environments.edit', compact('environment'));
    }

    /**
     * Update the specified environment in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $environment = Environment::findOrFail($id);
        $environment->update(Input::all());

        if ($environment->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('environments.index')
            ->with('myflash', 'Your environment has been updated.');
    }

    /**
     * Remove the specified environment from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Environment::destroy($id);

        return Redirect::route('environments.index')
            ->with('myflash', 'Your environment has been deleted.');
    }

}
