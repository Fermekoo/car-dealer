<?php 
namespace  App\Services;

use App\Models\Car;
use Illuminate\Database\QueryException;

class CarService
{
    public function getAll()
    {
        return Car::get();
    }

    public function create($request)
    {
        try {
           $car = Car::create([
                'name'  => strip_tags($request->carName),
                'price' => (int)$request->carPrice,
                'stock' => (int)$request->carStock
            ]);

        } catch (QueryException $e) {
            throw $e;
        }

        return $car;
    }

    public function update($id, $request)
    {
        try {
            $car = Car::find($id);
            $car->name  = strip_tags($request->carName);
            $car->price = (int)$request->carPrice;
            $car->stock = (int)$request->carStock;
            $car->save();

        } catch (QueryException $e) {
            throw $e;
        }

        return $car;
    }

    public function delete($id)
    {
        return Car::where('id',$id)->delete();
    }

    public function decrementStock($id)
    {
        $car = Car::find($id);

        if($car->stock < 1) throw new \Exception('Insufficient Stock');

        try {
            $car->decrement('stock');
            
        } catch (QueryException $e) {
            throw $e;
        }

        return $car;
    }
}