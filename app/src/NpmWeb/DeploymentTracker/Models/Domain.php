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

    public function __toString() {
        return $this->name . ' (' . $this->ipAddress->server->display_name . ')';
    }

    public function ipAddress() {
        return $this->belongsTo(IpAddress::class);
    }

    public function environmentEndpoints() {
        return $this->hasMany(EnvironmentEndpoint::class);
    }

    public static function forDropdownValues() {
        $elems = [];
        $orgs = self::all();
        foreach($orgs as $org ) {
            $elems[$org->id] = $org->__toString();
        }
        natcasesort($elems);

        return $elems;
    }

}