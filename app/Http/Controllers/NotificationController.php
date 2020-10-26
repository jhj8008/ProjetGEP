<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\OffersNotification;

class NotificationController extends Controller
{
    public function __construct(){

    }

    public function index(){
        return view('welcome');
    }

    public function sendParentNotification($notifData, $user_id){
        $userschema = \App\Elèveparent::find($user_id);

        /*$notifData = [
            'name' => 'GEP',
            'body' => 'Nouvelle notification',
            'thanks' => 'Merci pour avoir utiliser nos services',
            'notifText' => 'Découvrer votre nouveau profil',
            'notifUrl' => url('/'),
            'notif_id' => 007
        ];*/

        Notification::send($userschema, new OffersNotification($notifData));

        /*return redirect()->back();*/
    }

    public function sendEmployeNotification($notifData, $user_id){
        $userschema = \App\Employe::find($user_id);
        Notification::send($userschema, new OffersNotification($notifData));
    }
}
