<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::with('packages')->paginate(10);
        return view('deliveries.index', compact('deliveries'));
    }
    public function create()
    {
        return view('deliveries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pickup_address' => 'required|string|max:255',
            'pickup_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:100',
            'pickup_contact_no' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'pickup_email' => 'nullable|email|max:255',
            'delivery_address' => 'required|string|max:255',
            'delivery_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:100',
            'delivery_contact_no' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'delivery_email' => 'nullable|email|max:255',
            'type_of_good' => 'required|string|in:Document,Parcel',
            'delivery_provider' => 'required|string|in:DHL,STARTRACK,ZOOM2U,TGE',
            'delivery_status' => 'required|string|in:Pending,In Transit,Delivered,Cancelled',
            'priority' => 'required|string|in:Standard,Express,Immediate',
            'shipment_pickup_date' => 'required|date|before_or_equal:today',
            'shipment_pickup_time' => 'required|date_format:H:i',
            'packages' => 'required|array|min:1',
            'packages.*.package_description' => 'required|string|max:255',
            'packages.*.length' => 'required|integer|min:1|max:1000',
            'packages.*.height' => 'required|integer|min:1|max:1000',
            'packages.*.width' => 'required|integer|min:1|max:1000',
            'packages.*.weight' => 'required|integer|min:1|max:1000',
        ]);


        $delivery = Delivery::create($request->only([
            'pickup_address',
            'pickup_name',
            'pickup_contact_no',
            'pickup_email',
            'delivery_address',
            'delivery_name',
            'delivery_contact_no',
            'delivery_email',
            'type_of_good',
            'delivery_provider',
            'priority',
            'shipment_pickup_date',
            'shipment_pickup_time',
            'delivery_status'
        ]));

        foreach ($request->packages as $packageData) {
            $delivery->packages()->create($packageData);
        }

        return redirect()->route('deliveries.index')->with('success', 'Delivery created successfully!');
    }

    public function edit($id)
    {
        $delivery = Delivery::with('packages')->findOrFail($id);
        return view('deliveries.edit', compact('delivery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pickup_address' => 'required|string|max:255',
            'pickup_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:100',
            'pickup_contact_no' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'pickup_email' => 'nullable|email|max:255',
            'delivery_address' => 'required|string|max:255',
            'delivery_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:100',
            'delivery_contact_no' => 'required|string|regex:/^\+?[0-9]{10,15}$/',
            'delivery_email' => 'nullable|email|max:255',
            'type_of_good' => 'required|string|in:Document,Parcel',
            'delivery_provider' => 'required|string|in:DHL,STARTRACK,ZOOM2U,TGE',
            'delivery_status' => 'required|string|in:Pending,Processed,Delivered,Cancelled',
            'priority' => 'required|string|in:Standard,Express,Immediate',
            'shipment_pickup_date' => 'required|date|before_or_equal:today',
            'shipment_pickup_time' => 'required|date_format:H:i',
            'packages' => 'required|array|min:1',
            'packages.*.package_description' => 'required|string|max:255',
            'packages.*.length' => 'required|integer|min:1|max:1000',
            'packages.*.height' => 'required|integer|min:1|max:1000',
            'packages.*.width' => 'required|integer|min:1|max:1000',
            'packages.*.weight' => 'required|integer|min:1|max:1000',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update($request->only([
            'pickup_address',
            'pickup_name',
            'pickup_contact_no',
            'delivery_address',
            'delivery_name',
            'delivery_contact_no',
            'type_of_good',
            'priority',
            'shipment_pickup_date',
            'shipment_pickup_time',
            'delivery_status'
        ]));

        $delivery->packages()->delete();
        foreach ($request->packages as $packageData) {
            $delivery->packages()->create($packageData);
        }

        return redirect()->route('deliveries.index')->with('success', 'Delivery updated successfully!');
    }
}
