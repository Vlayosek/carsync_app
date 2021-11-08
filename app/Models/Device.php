<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as MongoModel;

class Device extends MongoModel
{
    use HasFactory;

    protected $collection = 'devicesXuser';
    protected $connection= 'mongodb';

     protected $fillable = [
        'id_device',
        'deviceTypeCode',
        'imei',
        'notes',
        'externalId',
        'isShareDevice',
        'createdOn',
        'installedOn'
    ];
}
