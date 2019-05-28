<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $guarded = ['id'];


    /**
     * @param $userType
     * @return array
     */
    public function rulesTickets($userType)
    {
        if ($userType == 2){
            return array(
                'name' => 'required|min:3|max:50',
                'unit_id' => 'required|integer',
                'from_user_id' => 'required|integer',
                'to_user_id' => 'required|integer',
                'status' => 'required|in:0,1,2,3',
                'type' => 'required|in:0,1,2,3',
                'amount' => 'required|numeric|between:0,99999999.99',
                'description' => 'required|max:5500',
                'note' => 'nullable|max:5500',
            );
        } else {
            return array(
                'assigned_user_id' => 'nullable|integer',
                'status' => 'required|in:0,1,2,3',
                'note' => 'nullable|max:5500',
            );
        }

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assistant()
    {
        return $this->belongsTo('App\Models\Assistant', 'assigned_user_id');
    }

    /**
     * @param $orderBy
     * @param $dir
     * @param $skip
     * @param $take
     * @param $search
     * @return array
     */
    public function getTicketsFilter($orderBy, $dir, $skip, $take, $search)
    {
        $user = Auth::user();

        $tickets = $this->leftJoin('users as landlord', 'landlord.id', '=', 'tickets.to_user_id');
        $tickets->leftJoin('users as tenant', 'tenant.id', '=', 'tickets.from_user_id');
        $tickets->leftJoin('units', 'units.id', '=', 'tickets.unit_id');

        $tickets->select(
            'tickets.*', 'units.id as unit_id', 'units.name as unit_name',
            'landlord.id as landlord_id', 'landlord.first_name as landlord_first_name', 'landlord.last_name as landlord_last_name', 'landlord.email as landlord_email',
            'tenant.id as tenant_id', 'tenant.first_name as tenant_first_name', 'tenant.last_name as tenant_last_name', 'tenant.email as tenant_email'
        );

        $tickets->orderBy($orderBy, $dir);
        $tickets->skip($skip)->take($take);

        if ($user->type == 1) $tickets->where('tickets.to_user_id', '=', $user->id);
        else if ($user->type == 2) $tickets->where('tickets.from_user_id', '=', $user->id);
        else return [];

        // For searching
        $tickets->where('units.name', 'like', '%' . $search . '%');

        return $tickets->get();
    }
}