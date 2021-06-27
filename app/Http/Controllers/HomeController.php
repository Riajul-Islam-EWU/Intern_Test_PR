<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductCategory::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> 
                    <a href="' . route('delete', $row->id) . '" onclick="deleteProducts(' . $row->id . ')" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function deleteProducts($id)
    {
        $productrow = ProductCategory::find($id);
        $productrow->delete();
        return response()->json([
            'success' => 'Data deleted successfully!'
        ]);
    }
}
