<?php

use Carbon\Carbon;
use Illuminate\Http\Request;

function get_local_time(){

       
       $ip = \Request::getClientIp(true);
       if($ip=="127.0.0.1"){
        $ip = file_get_contents("http://ipecho.net/plain");
       }
       $url = 'http://ip-api.com/json/'.$ip;
       $tz = file_get_contents($url);

       $tz = json_decode($tz,true)['timezone'];

       $time=Carbon::now($tz);
       $time=$time->format('Y-m-d H:i:s');

       return $time;

    }