<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseUidModel;

class Application extends BaseUidModel {

    // Add your validation rules here
    public static $rules = [
        'name' => ['required','max:50'],
    ];

    // Don't forget to fill this array
    protected $fillable = ['name'];

    public function endpoints() {
        return $this->hasMany(Endpoint::class);
    }

}