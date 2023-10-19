<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Http\Resources\ReservationResource;
use App\Models\Application;
use App\Models\Booking;
use App\Models\Group;
use App\Models\Module;
use App\Models\Reservation;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OperationController extends Controller
{
    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function operations(): \Illuminate\Http\JsonResponse
    {
        $bookings = BookingResource::collection(Booking::where('user_id', Auth::user()->id)->latest()->get());
        $flights = ReservationResource::collection(Reservation::where('user_id', Auth::user()->id)->where('type', 'flight')->latest()->get());
        $hotels = ReservationResource::collection(Reservation::where('user_id', Auth::user()->id)->where('type', 'hotel')->latest()->get());

        return $this->success(compact('bookings', 'flights', 'hotels'));
    }

    public function import(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'data' => 'required|array'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the following errors:', 500);
        }

        $data = match ($request->category) {
            'applications' => $this->loadApps($request->data),
            'modules' => $this->loadMods($request->data),
            default => []
        };

        return $this->success($data, 'Data loaded successfully!!');
    }

    private function loadApps(array $data): array
    {
        $chunked = [];
        $group = Group::where('label', 'administrators')->first();
        foreach ($data as $value) {
            $application = Application::where('code', $value['CODE'])->first();

            if (! $application && $group) {
                $application = Application::create([
                    'name' => $value['NAME'],
                    'icon' => $value['ICON'],
                    'code' => $value['CODE'],
                    'path' => $value['PATH'],
                    'description' => $value['DESCRIPTION'],
                ]);

                $application->groups()->save($group);
            }

            $chunked[] = $application;
        }

        return $chunked;
    }

    private function loadMods(array $data): array
    {
        $chunked = [];
        $group = Group::where('label', 'administrators')->first();
        foreach ($data as $value) {
            $module = Module::where('code', $value['CODE'])->first();
            $application = Application::where('code', $value['APP'])->first();

            if (! $module && $group && $application) {
                $module = Module::create([
                    'name' => $value['NAME'],
                    'icon' => $value['ICON'],
                    'code' => $value['CODE'],
                    'path' => $value['PATH'],
                    'description' => $value['DESCRIPTION'],
                    'application_id' => $application->id
                ]);

                $module->groups()->save($group);
            }

            $chunked[] = $module;
        }

        return $chunked;
    }
}
