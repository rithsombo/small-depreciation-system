<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Depreciation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::all();
        return view('customer.customer', compact('data'));
    }
    public function total()
    {
        $data = Customer::all();
        $customerCount = $data->count(); // Count the total number of customers

        return view('report.total_customer', compact('data', 'customerCount'));
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
        // Validate the input
        $validated = $request->validate([
            'cusname' => 'required|string|max:255',
            'custtel' => 'required|string|max:255',
            'idcard' => 'required|string|max:255',
            'cusaddress' => 'required|string|max:255',
            'productname' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_price' => 'required|numeric',
            'interest' => 'required|numeric',
            'duration' => 'required|integer',
            'create_date' => 'required|date',
        ]);

        DB::beginTransaction();

        try {
            // Handle file upload
            if ($request->hasFile('photo')) {
                $imageName = time().'.'.$request->photo->extension();
                $request->photo->move(public_path('photo'), $imageName);
            } else {
                return redirect()->back()->with('error', 'Photo upload failed');
            }

            // Create customer
            $customer = Customer::create([
                'cusname' => $validated['cusname'],
                'custtel' => $validated['custtel'],
                'idcard' => $validated['idcard'],
                'cusaddress' => $validated['cusaddress'],
                'productname' => $validated['productname'],
                'photo' => $imageName,
                'product_price' => $validated['product_price'],
                'interest' => $validated['interest'],
                'duration' => $validated['duration'],
                'create_date' => $validated['create_date'],
            ]);

            $principal = $validated['product_price'] / $validated['duration'];
            $interest_month = $validated['product_price'] * $validated['interest'] / 100;

            for ($i = 1; $i <= $validated['duration']; $i++) {
                $next_month = Carbon::parse($validated['create_date'])->addMonths($i)->format('Y-m-d');
                Depreciation::create([
                    'cusid' => $customer->cusid,
                    'principal' => $principal,
                    'interest_month' => $interest_month,
                    'paid_date' => $next_month,
                    'clear_date' => null,
                    'clear_by_userid' => null,
                ]);
            }

            DB::commit();
            return redirect()->route('customer')->with('success', 'Customer and depreciation details added successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to add customer and depreciation details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add customer and depreciation details');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->cusname = $request->cusname;
        $customer->custtel = $request->custtel;
        $customer->idcard = $request->idcard;
        $customer->cusaddress = $request->cusaddress;

        if (isset($request->image)){
            $imageName = time().'.'.$request->image->extension();
            $profile =  $request->image->move(public_path('photo'), $imageName);
            $customer->photo = $imageName;
            $customer->save();
        }

        $customer->save();

        return redirect()->route('customer')->with('success', 'User updated successfully');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        // Find the customer by primary key (cusid) and fail if not found
        $customer = Customer::findOrFail($id);

        // Delete the customer record
        $customer->delete();

        // Redirect to the customer route with a success message
        return redirect()->route('customer')->with('success', 'User deleted successfully');
    }
    public function destroy()
    {

    }
}
