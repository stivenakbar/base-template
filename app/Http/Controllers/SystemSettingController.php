<?php

namespace App\Http\Controllers;

use App\DataTables\SystemSettingDataTable;
use App\Models\SystemSettingModel;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(){
        $this->middleware('permission:admin-system-setting');
    }

    public function index(SystemSettingDataTable $datatable)
    {
        return $datatable->render("pages.admin.system-setting.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemSettingModel $systemSettingModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SystemSettingModel $systemSettingModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SystemSettingModel $systemSettingModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemSettingModel $systemSettingModel)
    {
        //
    }
}
