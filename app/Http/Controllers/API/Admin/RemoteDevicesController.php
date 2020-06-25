<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RemoteDeviceStoreRequest;
use App\Models\DeviceType;

/**
 * Class RemoteDevicesController
 * @package App\Http\Controllers\API\Admin
 */
class RemoteDevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(DeviceType::with(['roles:id,name', 'device_group:id,name'])->get());
    }

    /**
     * Store a newly created resource in storage Or
     * Update the specified resource in storage.
     *
     * @param RemoteDeviceStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(RemoteDeviceStoreRequest $request, $id = null)
    {
        $request->save($id)
            ->roles()->sync($request->role_id);

        return response()->json(['message' => "Remote IoT Device saved successfully!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $device = DeviceType::with('roles')->findOrFail($id);

        $device->role_id = optional($device->roles->first())->id;

        return response()->json($device);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        DeviceType::findOrFail($id)->delete();

        return response()->json(['message' => 'Remote IoT Device removed successfully!']);
    }
}
