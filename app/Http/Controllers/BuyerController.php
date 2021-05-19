<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyerRequest;
use App\Services\BuyerService;
use App\Services\CarService;
use Yajra\DataTables\Facades\DataTables;

class BuyerController extends Controller
{
    protected $buyer;
    protected $car;
    public function __construct(BuyerService $buyer, CarService $car)
    {   
        $this->buyer = $buyer;
        $this->car   = $car;
    }

    public function index()
    {
        $cars = $this->car->getAll();

        return view('buyer.index', compact('cars'));
    }

    public function dataBuyer()
    {
        $buyers = $this->buyer->getAll();

        $data = DataTables::of($buyers)
                ->addColumn('car', function($row){
                    return $row->car->name;
                })
                ->make(true);

        return $data;
    }

    public function create(BuyerRequest $request)
    {
        try {

            $this->buyer->create($request);
            
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Buyer created successfully');
    }
}
