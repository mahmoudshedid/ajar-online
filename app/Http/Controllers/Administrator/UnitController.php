<?php

namespace App\Http\Controllers\Administrator;


use App\Http\Controllers\AdministratorController;
use App\Models\Unit;
use Illuminate\Http\Request;

/**
 * @property Unit model
 */
class UnitController extends AdministratorController
{
    public $data = array();

    /**
     * UnitController constructor.
     * @param Unit $unit
     */
    public function __construct(Unit $unit)
    {
        $this->model = $unit;

        $this->data['module'] = 'unit';
        $this->data['modules'] = 'units';
        $this->data['module_title'] = 'Unit';
        $this->data['module_titles'] = 'Units';
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUnits()
    {
        return view('administrator.' . $this->data['module'] . '.' . 'index', ['data' => $this->data]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUnitsAjax(Request $request)
    {
        $inputs = $request->all();
        $orderBy = $inputs['columns'][$inputs['order'][0]['column']]['data'];
        $dir = $inputs['order'][0]['dir'];
        $start = $inputs['start'];
        $length = $inputs['length'];
        $search = $inputs['search']['value'];
        $data = $this->model->getUnitsFilter($orderBy, $dir, $start, $length, $search);
        return response()->json(['draw' => $inputs['draw'], 'recordsTotal' => $data->count(), 'recordsFiltered' => $this->model->count(), 'data' => $data], 200, [], JSON_NUMERIC_CHECK);
    }
}