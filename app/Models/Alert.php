<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Alert extends MongoModel
{
    use HasFactory;

    protected $collection = 'alerts';
    protected $connection= 'mongodb';

    public $timestamps = false;

     protected $fillable = [
        'messageKey',
        'tripNumber',
        'imei',
        'address',
        'generateTime',
        'messageTime',
        'deviceIncrementalMessageCounter',
        'addressStatus',
        'heading',
        'lat',
        'lng',
        'speed',
        'isBuffer',
        'alertId',
        'body',
        'alertDescription',
        'temperatureSensorsId',
        'temperatureSensors',
        'geofence'
    ];

    protected $casts = [
        'body' => 'array',
        'alertDescription' => 'array',
        'temperatureSensorsId' => 'array',
        'temperatureSensors' => 'array',
    ];
}
