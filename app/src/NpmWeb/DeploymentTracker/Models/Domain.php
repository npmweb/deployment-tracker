<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseUidModel;

class Domain extends BaseUidModel {

    // Add your validation rules here
    public static $rules = [
        'ip_address_id' => ['required','integer'],
        'name' => ['required','max:100'], // TODO validate domain
    ];

    // Don't forget to fill this array
    protected $fillable = ['ip_address_id', 'name'];

    public function ipAddress() {
        return $this->belongsTo(IpAddress::class);
    }

}