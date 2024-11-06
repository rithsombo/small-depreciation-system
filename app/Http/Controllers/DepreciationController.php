<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Depreciation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class DepreciationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cus_id = $request->query('cusid');

        if ($cus_id) {
            $data = Depreciation::where('cusid', $cus_id)->get();
        } else {
            $data = Depreciation::all();
        }

        return view('depreciation.depreciation', ['data' => $data]);
    }
    public function clear(Request $request, $depreid, $cusid)
    {
        $depreciation = Depreciation::findOrFail($depreid);

        // Set the clear_by_userid and clear_date fields
        $depreciation->clear_by_userid = -2;
        $depreciation->clear_date = now();
        $depreciation->save();
        return redirect()->route('depreciation', ['cusid' => $cusid])->with('success', 'Depreciation cleared successfully');
    }
    // report of customers in 14 days to collect
    public function report()
    {
        $data = Depreciation::whereBetween('paid_date', [
            now(),
            now()->addDays(14)
        ])
            ->whereNull('clear_by_userid')
            ->get();
        return view('report.Money_Report', ['data' => $data]);
    }
    // on pending
    public function dont()
    {
        $data = Depreciation::where('paid_date', '<', now())
            ->whereNull('clear_by_userid')
            ->get();
        foreach ($data as $item) {
            $item->statusPiad = $item->clear_by_userid === null ? 'Padding' : 'Paid';
        }
        return view('report.customer_havenot_paid', ['data' => $data]);
    }
    // customer who already paid
    public function paid()
    {
        // Subquery for ranking depreciation details
        $rankedDepreciation = DB::table('tbldepreciationdatail')
            ->select([
                'cusid',
                'paid_date',
                'clear_by_userid',
                DB::raw('ROW_NUMBER() OVER (PARTITION BY cusid ORDER BY (CASE WHEN clear_by_userid IS NULL THEN NULL ELSE 1 END), paid_date) AS row_num'),
            ])
            ->toSql(); // Convert the query to a raw SQL string

        // Main query to join ranked depreciation details with customers and count distinct customers
        $customerCount = DB::table(DB::raw('(' . $rankedDepreciation . ') AS RankedDepreciation'))
            ->join('tblcustomer', function ($join) {
                $join->on('RankedDepreciation.cusid', '=', 'tblcustomer.cusid');
            })
            ->where('row_num', 1)
            ->whereNotNull('RankedDepreciation.clear_by_userid')
            ->distinct('tblcustomer.cusid')
            ->count('tblcustomer.cusid'); // Count distinct customers

        // Retrieve customer data for display
        $data = DB::table(DB::raw('(' . $rankedDepreciation . ') AS RankedDepreciation'))
            ->select([
                'tblcustomer.cusname',
                'productname',
                'product_price',
                'interest',
                'duration',
                'photo',
            ])
            ->join('tblcustomer', function ($join) {
                $join->on('RankedDepreciation.cusid', '=', 'tblcustomer.cusid');
            })
            ->where('row_num', 1)
            ->whereNotNull('RankedDepreciation.clear_by_userid')
            ->get();

        return view('report.customer_paid', ['data' => $data, 'customerCount' => $customerCount]);
    }
    // customer who never yet pay
    public function un()
    {
        // Subquery for ranking depreciation details
        $rankedDepreciation = DB::table('tbldepreciationdatail')
            ->select([
                'cusid',
                'paid_date',
                'clear_by_userid',
                DB::raw('ROW_NUMBER() OVER (PARTITION BY cusid ORDER BY (CASE WHEN clear_by_userid IS NULL THEN NULL ELSE 1 END), paid_date) AS row_num'),
            ])
            ->toSql(); // Convert the query to a raw SQL string

        // Main query to join ranked depreciation details with customers and count distinct customers
        $customerCount = DB::table(DB::raw('(' . $rankedDepreciation . ') AS RankedDepreciation'))
            ->join('tblcustomer', function ($join) {
                $join->on('RankedDepreciation.cusid', '=', 'tblcustomer.cusid');
            })
            ->where('row_num', 1)
            ->whereNull('RankedDepreciation.clear_by_userid')
            ->distinct('tblcustomer.cusid')
            ->count('tblcustomer.cusid'); // Count distinct customers

        // Retrieve customer data for display
        $data = DB::table(DB::raw('(' . $rankedDepreciation . ') AS RankedDepreciation'))
            ->select([
                'tblcustomer.cusname',
                'productname',
                'product_price',
                'interest',
                'duration',
                'photo',
            ])
            ->join('tblcustomer', function ($join) {
                $join->on('RankedDepreciation.cusid', '=', 'tblcustomer.cusid');
            })
            ->where('row_num', 1)
            ->whereNull('RankedDepreciation.clear_by_userid')
            ->get();

        return view('report.customer_unpaid', ['data' => $data, 'customerCount' => $customerCount]);
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Depreciation $depreciation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depreciation $depreciation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depreciation $depreciation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depreciation $depreciation)
    {
        //
    }
}
