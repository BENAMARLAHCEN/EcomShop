<?php

namespace App\Widgets;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class Payments extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = Payment::count();
        $string = 'Payments';
        $total = Payment::all()->sum(function($Payment){
            return $Payment->amount;
        });
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-wallet',
            'title'  => "{$count} {$string}",
            'text'   => 'You have 9 Payments in your database. with total Amout '. $total.' Click on button below to view all pages.' ,
            'button' => [
                'text' => 'View all Payments',
                'link' => route('voyager.payments.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/03.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('Page'));
    }
}
