<?php namespace NpmWeb\DeploymentTracker\ViewComposers;

use Illuminate\View\View;
use NpmWeb\LaravelBase\BaseViewComposer;

/**
 * Adds data to every view in the app. Useful for data used in the layout.
 *
 * @author Josh Justice
 */
class GlobalViewComposer extends BaseViewComposer {

    /**
     * Adds data to the view.
     *
     * @param \Illuminate\View\View $view
     */
    public function compose( View $view)
    {
        parent::compose($view);

        $view_data = [
            // add any additional view data here
        ];

        $view->with($view_data);
    }

}
