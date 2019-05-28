<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 12/16/16
 * Time: 4:17 PM
 */

namespace App\Http\Controllers;

class AdministratorController extends Controller
{
    protected $data;
    // non rent payments (water, service charge ..etc)
    protected $nonRentPayments = ['Water', 'Service Charge', 'Electricity', 'Internet'];
    // the status of the tickets (solved, closed, canceled).
    protected $ticketStatus = ['Pending', 'Solved', 'Closed', 'Canceled'];
}