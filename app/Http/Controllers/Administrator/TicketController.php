<?php
/**
 * Created by PhpStorm.
 * User: mshedid
 * Date: 3/28/19
 * Time: 2:33 AM
 */

namespace App\Http\Controllers\Administrator;


use App\Http\Controllers\AdministratorController;
use App\Models\Ticket;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Arr;
use Validator;

/**
 * @property Ticket model
 * @property Unit unit
 */
class TicketController extends AdministratorController
{
    public $data = array();

    /**
     * TicketController constructor.
     * @param Ticket $ticket
     * @param Unit $unit
     */
    public function __construct(Ticket $ticket, Unit $unit)
    {
        $this->model = $ticket;
        $this->unit = $unit;

        $this->data['module'] = 'ticket';
        $this->data['modules'] = 'tickets';
        $this->data['module_title'] = 'Ticket';
        $this->data['module_titles'] = 'Tickets';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTickets()
    {
        $this->data['nonRentPayments'] = $this->nonRentPayments;
        $this->data['ticketStatus'] = $this->ticketStatus;
        return view('administrator.' . $this->data['module'] . '.' . 'index', ['data' => $this->data]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postTicketsAjax(Request $request)
    {
        $inputs = $request->all();
        $orderBy = $inputs['columns'][$inputs['order'][0]['column']]['data'];
        $dir = $inputs['order'][0]['dir'];
        $start = $inputs['start'];
        $length = $inputs['length'];
        $search = $inputs['search']['value'];
        $data = $this->model->getTicketsFilter($orderBy, $dir, $start, $length, $search);
        return response()->json(['draw' => $inputs['draw'], 'recordsTotal' => $data->count(), 'recordsFiltered' => $this->model->count(), 'data' => $data], 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getCreateTicket()
    {
        if (Auth::user()->type == 2) {
            $this->data['units'] = $this->unit->getAllUnitsForTenant();
            $this->data['nonRentPayments'] = $this->nonRentPayments;
            return view('administrator.' . $this->data['module'] . '.' . 'create', ['data' => $this->data]);
        } else {
            Session::flash('alert', 'success');
            Session::flash('message', 'You are not allow to create a ticket.');
            return Redirect::to('/' . $this->data['modules']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateTicket(Request $request)
    {
        if (Auth::user()->type == 2) {
            $inputs = $request->all();
            $inputs = Arr::except($inputs, ['_token']);
            // Set Enabled

            $inputs['from_user_id'] = Auth::user()->id;
            $inputs['to_user_id'] = DB::table('units')->where('id', $inputs['unit_id'])->first()->landlord_id;
            $inputs['status'] = 0;

            $model = $this->model;
            $rules = $model->rulesTickets(Auth::user()->type);
            $validation = Validator::make($inputs, $rules);
            if (!$validation->fails()) {
                $this->model->create($inputs)->id;
                Session::flash('alert', 'success');
                Session::flash('message', $this->data['module_title'] . ' Saved');
                return Redirect::to('/' . $this->data['modules']);
            }
            return Redirect::to('/' . $this->data['module'] . '/create')->withInput()->withErrors($validation->messages());
        } else {
            Session::flash('alert', 'success');
            Session::flash('message', 'You are not allow to create a ticket.');
            return Redirect::to('/' . $this->data['modules']);
        }
    }

    /**
     * @param $ticketId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getShowTicket($ticketId)
    {
        if (Auth::user()->type == 2) {
            $ticket = $this->model->find($ticketId);
            $this->data['ticketStatus'] = $this->ticketStatus;
            $this->data['model'] = $ticket;
            $this->data['unitName'] = DB::table('units')->where('id', $ticket->unit_id)->first()->name;
            $this->data['nonRentPayment'] = $this->nonRentPayments[$ticket->type];
            return view('administrator.' . $this->data['module'] . '.' . 'show', ['data' => $this->data]);
        } else {
            Session::flash('alert', 'success');
            Session::flash('message', 'You are not allow to Show a ticket.');
            return Redirect::to('/' . $this->data['modules']);
        }
    }

    /**
     * @param $ticketId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEditTicket($ticketId)
    {
        if (Auth::user()->type == 1) {
            $ticket = $this->model->find($ticketId);
            $this->data['ticketStatus'] = $this->ticketStatus;
            $this->data['ticketAssistantId'] = $ticket->assistant != null ? $ticket->assistant->id : 0;
            $this->data['assistants'] = Auth::user()->assistants()->get();
            $this->data['model'] = $ticket;
            $this->data['unitName'] = DB::table('units')->where('id', $ticket->unit_id)->first()->name;
            $this->data['nonRentPayment'] = $this->nonRentPayments[$ticket->type];
            return view('administrator.' . $this->data['module'] . '.' . 'edit', ['data' => $this->data]);
        } else {
            Session::flash('alert', 'success');
            Session::flash('message', 'You are not allow to edit a ticket.');
            return Redirect::to('/' . $this->data['modules']);
        }
    }

    /**
     * @param Request $request
     * @param $ticketId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditTicket(Request $request, $ticketId)
    {
        if (Auth::user()->type == 1) {
            $inputs['assigned_user_id'] = $request->get('assigned_user_id') != 0 ? $request->get('assigned_user_id') : 0;
            $inputs['note'] = $request->get('note');
            $inputs['status'] = $request->get('status');
            $model = $this->model;
            $rules = $model->rulesTickets(Auth::user()->type);
            $validation = Validator::make($inputs, $rules);
            if (!$validation->fails()) {
                $model = $this->model->find($ticketId);
                $model->update($inputs);
                Session::flash('alert', 'success');
                Session::flash('message', $this->data['module_title'] . ' Saved');
                return Redirect::to('/' . $this->data['modules']);
            } else return Redirect::to('/' . $this->data['module'] . '/edit/'. $ticketId)->withInput()->withErrors($validation->messages());
        } else {
            Session::flash('alert', 'success');
            Session::flash('message', 'You are not allow to edit a ticket.');
            return Redirect::to('/' . $this->data['modules']);
        }
    }
}