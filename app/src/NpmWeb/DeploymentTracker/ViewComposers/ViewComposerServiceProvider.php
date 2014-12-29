<?php

namespace NpmWeb\DeploymentTracker\ViewComposers;

class ViewComposerServiceProvider extends \Illuminate\Support\ServiceProvider {

    /**
     * Register the reference instance
     *
     * @return void
     */
    public function register()
    {
        $this->app->view->composer('*', 'NpmWeb\DeploymentTracker\ViewComposers\GlobalViewComposer');
    }

}
