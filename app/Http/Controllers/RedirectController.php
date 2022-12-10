<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Country;
use Jenssegers\Agent\Agent;
use GeoIp2\Database\Reader;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    /**
     * Redirect the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function redirect(Request $request, $code)
    {
        // Search for a link in the database.
        $link = Link::where('code', $code)->first();

        // Returns 404.
        if (!$link) {
            abort(404);
        }

        $agent = new Agent();

        // Redirects robots.
        $robot = $agent->isRobot();
        if ($robot && !empty($link->robot_url)) {
            return redirect($link->robot_url);
        }

        // Redirects smartphones and tablets.
        $device = '';
        $device_url = $link->device_url;

        if ($agent->is('iPhone')) {
            $device = 'iphone';
        } elseif ($agent->is('iPad')) {
            $device = 'ipad';
        } elseif ($agent->is('AndroidOS')) {
            $device = 'android';
        } elseif ($agent->is('Windows Phone')) {
            $device = 'windows-phone';
        }

        if (!empty($device) && !empty($device_url)) {

            /**
             * @link https://www.php.net/manual/fr/function.array-search.php
             * @link https://www.php.net/manual/fr/function.array-column.php
             */
            $key = array_search($device, array_column($device_url, 'code'), true);

            if ($key !== false && array_key_exists($key, $device_url)) {
                return redirect($device_url[$key]['url']);
            }

        }

        // Redirects countries based on the client IP address.
        $country = '';
        $country_url = $link->country_url;
        $ip = $request->ip();
        // $ip = '88.164.186.219';

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {

            $reader = new Reader(base_path() . DIRECTORY_SEPARATOR . env('DESTINATION_DIRECTORY_PATH') . DIRECTORY_SEPARATOR . 'GeoLite2-Country' . DIRECTORY_SEPARATOR . 'GeoLite2-Country.mmdb');
            $country = $reader->country($ip)->country->isoCode;

            if (!empty($country) && !empty($country_url)) {

                // Get index
                $key = array_search($country, array_column($country_url, 'code'), true);

                if ($key !== false && array_key_exists($key, $country_url)) {
                    return redirect($country_url[$key]['url']);
                }

            }
        }

        // Default redirect.
        $defaul_url = $link->default_url;
        return redirect($defaul_url);

    }
}
