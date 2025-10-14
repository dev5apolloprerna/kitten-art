<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	public $table = 'profile';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'strCompanyName',
        'strName',
        'strUrlDisplayName',
        'strDesignation',
        'strNatureOfBusiness',
        'iType',
        'iMobile',
        'iWhatsAppNo',
        'strAddress',
        'strEmail',
        'strWebsite',
        'strAboutUs',
        'strOtherLink',
        'strFacebook',
        'strInsta',
        'strTwitter',
        'strYoutube',
        'strLinkedin',
        'strExpiryDate',
        'strIP',
        'iStatus',
        'isDelete',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
    ];
}
