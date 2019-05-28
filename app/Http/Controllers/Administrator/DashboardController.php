<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 12/3/16
 * Time: 9:31 PM
 */

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\AdministratorController;

class DashboardController extends AdministratorController
{
    public $data = array();

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->data['module'] = 'dashboard';
        $this->data['modules'] = 'dashboard';
        $this->data['module_title'] = 'Dashboard';
        $this->data['module_titles'] = 'Dashboard';
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboard()
    {
        return view('administrator.dashboard', ['data' => $this->data]);
    }
}