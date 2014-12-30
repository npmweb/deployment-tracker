<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseUidModel;

class Server extends BaseUidModel {

    public static $rules = [
        'environment_id' => ['required','integer'],
        'display_name' => ['required','max:50'],
        'hostname' => ['required','max:100'], // TODO add domain validator
    ];

    // Don't forget to fill this array
    protected $fillable = [ 'environment_id', 'display_name', 'hostname' ];

    public function environment() {
        return $this->belongsTo(Environment::class);
    }

    public function ipAddresses() {
        return $this->hasMany(IpAddress::class);
    }

}