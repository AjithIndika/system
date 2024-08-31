<?php

namespace App\Http\Controllers;

use App\Models\EquipmentHistory;
use App\Http\Requests\StoreEquipmentHistoryRequest;
use App\Http\Requests\UpdateEquipmentHistoryRequest;

class EquipmentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEquipmentHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipmentHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EquipmentHistory  $equipmentHistory
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentHistory $equipmentHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentHistory  $equipmentHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentHistory $equipmentHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEquipmentHistoryRequest  $request
     * @param  \App\Models\EquipmentHistory  $equipmentHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipmentHistoryRequest $request, EquipmentHistory $equipmentHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentHistory  $equipmentHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentHistory $equipmentHistory)
    {
        //
    }
}
