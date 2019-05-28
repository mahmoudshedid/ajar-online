<?php
/**
 * Created by PhpStorm.
 * User: mshedid
 * Date: 3/27/19
 * Time: 5:47 PM
 */

namespace App\Http\Controllers;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHome()
    {
        return view('welcome');
    }
}