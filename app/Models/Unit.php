<?php
/**
 * Created by PhpStorm.
 * User: mshedid
 * Date: 3/27/19
 * Time: 10:26 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    protected $table = 'units';
    protected $guarded = ['id'];

    /**
     * @param $orderBy
     * @param $dir
     * @param $skip
     * @param $take
     * @param $search
     * @return mixed
     */
    public function getUnitsFilter($orderBy, $dir, $skip, $take, $search)
    {
        $user = Auth::user();

        $units = $this->leftJoin('users as landlord', 'landlord.id', '=', 'units.landlord_id');
        $units->leftJoin('users as tenant', 'tenant.id', '=', 'units.tenant_id');

        $units->select('units.*', 'landlord.id as landlord_id', 'landlord.first_name as landlord_first_name', 'landlord.last_name as landlord_last_name', 'landlord.email as landlord_email',
                                  'tenant.id as tenant_id', 'tenant.first_name as tenant_first_name', 'tenant.last_name as tenant_last_name', 'tenant.email as tenant_email');
        $units->orderBy($orderBy, $dir);
        $units->skip($skip)->take($take);

        if ($user->type == 1) $units->where('units.landlord_id', '=', $user->id);
        else if ($user->type == 2) $units->where('units.tenant_id', '=', $user->id);
        else $units->where('units.tenant_id', '=', $user->id);

        // For searching
        $units->where('units.name', 'like', '%' . $search . '%');

        return $units->get();
    }

    /**
     * @return mixed
     */
    public function getAllUnitsForTenant()
    {
        return $this->where('tenant_id', Auth::user()->id)->orderBy('name')->pluck('name', 'id');
    }
}