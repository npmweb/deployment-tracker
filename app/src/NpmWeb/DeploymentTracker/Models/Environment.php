<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseUidModel;

class Environment extends BaseUidModel {

    // Add your validation rules here
    public static $rules = [
        'name' => ['required', 'max:10'],
    ];

    // Don't forget to fill this array
    protected $fillable = ['name'];

    public function servers() {
        return $this->hasMany(Server::class);
    }

    public function environmentEndpoints() {
        return $this->hasMany(EnvironmentEndpoint::class);
    }

    public function __toString() {
        return $this->name;
    }

    public static function forDropdownValues() {
        $elems = [];
        $orgs = self::all();
        foreach($orgs as $org ) {
            $elems[$org->id] = $org->name;
        }
        natcasesort($elems);

        return $elems;
    }

}