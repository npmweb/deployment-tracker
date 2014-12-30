<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseUidModel;

class IpAddress extends BaseUidModel {

    // Add your validation rules here
    public static $rules = [
        'server_id' => ['required','integer'],
        'public_address' => ['required','max:40','ip'],
        'private_address' => ['max:40','ip'],
    ];

    // Don't forget to fill this array
    protected $fillable = ['server_id', 'public_address', 'private_address'];

    public function server() {
        return $this->belongsTo(Server::class);
    }

    public function domains() {
        return $this->hasMany(Domain::class);
    }

}