<?php namespace NpmWeb\DeploymentTracker\Models;

use NpmWeb\LaravelBase\Models\BaseModel;

class EnvironmentEndpoint extends BaseModel {

    // Add your validation rules here
    public static $rules = [
        'environment_id' => ['required','integer'],
        'endpoint_id' => ['required','integer'],
        'domain_id' => ['required','integer'],
        'path' => ['required', 'max:50'],
    ];

    // Don't forget to fill this array
    protected $fillable = ['environment_id', 'endpoint_id', 'domain_id', 'path'];

    public function environment() {
        return $this->belongsTo(Environment::class);
    }

    public function endpoint() {
        return $this->belongsTo(Endpoint::class);
    }

    public function domain() {
        return $this->belongsTo(Domain::class);
    }

    public function __construct($attributes = []) {
        parent::__construct($attributes);
        $this->path = '/';
    }

}