<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseUidModel;

class Endpoint extends BaseUidModel {

    // Add your validation rules here
    public static $rules = [
        'application_id' => ['required','integer'],
        'name' => ['required','max:50'],
    ];

    // Don't forget to fill this array
    protected $fillable = ['name'];

    public function __toString() {
        return $this->name;
    }

    public function application() {
        return $this->belongsTo(Application::class);
    }

    public function environmentEndpoints() {
        return $this->hasMany(EnvironmentEndpoint::class);
    }

}