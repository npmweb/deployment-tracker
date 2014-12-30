<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseUidModel;

class Server extends BaseUidModel {

    public static $rules = [
        'display_name' => ['required','max:50'],
        'hostname' => ['required','max:100'], // TODO add domain validator
    ];

    // Don't forget to fill this array
    protected $fillable = [ 'display_name', 'hostname' ];

    public function ipAddresses() {
        return $this->hasMany(IpAddress::class);
    }

}