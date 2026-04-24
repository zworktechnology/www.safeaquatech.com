<?php

namespace App\Models;

use App\Mail\ContactMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message'
    ];

    public static function boot()
    {
        Parent::boot();

        // static::created(function ($item) {

        //     $to_submited_author = 'safeaquatech@gmail.com';

        //     Mail::to($to_submited_author)->send(new ContactMail ($item));
        // });
    }
}
