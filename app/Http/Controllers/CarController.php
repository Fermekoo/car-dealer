<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Services\CarService;
use Yajra\DataTables\Facades\DataTables;

class CarController extends Controller
{
    protected $car;

    public function __construct(CarService $car)
    {
        $this->car = $car;
    }

    public function index()
    {
        return view('car.index');
    }

    public function dataCar()
    {
        $cars = $this->car->getAll();

        $data = DataTables::of($cars)->make(true);

        return $data;
    }

    public function create(CarRequest $request)
    {
        try {
            $this->car->create($request);
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Car created successfully');
    }

    public function update($id, CarRequest $request)
    {
        try {
            $this->car->update($id, $request);
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Car updated successfully');
    }

    public function delete($id)
    {
        try {
            $this->car->delete($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Car deleted successfully');
    }
}
