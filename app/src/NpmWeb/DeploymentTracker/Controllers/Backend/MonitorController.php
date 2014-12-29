<?php

namespace NpmWeb\DeploymentTracker\Controllers\Backend;

use View;
use NpmWeb\LaravelBase\Controllers\BaseController;

class MonitorController extends BaseController {

	public function index()
	{
		return View::make('monitor')
			->with('ip', $_SERVER['SERVER_ADDR']);
	}
}