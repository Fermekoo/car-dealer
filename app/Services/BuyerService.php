<?php 
namespace  App\Services;

use App\Services\CarService;
use Illuminate\Support\Facades\DB;
use App\Models\Buyer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class BuyerService
{
    public function getAll()
    {
        return Buyer::get();
    }

    public function create($request)
    {
        DB::beginTransaction();

        $car = new CarService;

        try {

           $update_car = $car->decrementStock($request->carId);

        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
           $buyer = Buyer::create([
                'name'              => strip_tags($request->name),
                'email'             => $request->email,
                'phone'             => $request->phone,
                'car_id'            => $request->carId,
                'purchasing_price'  => $update_car->price
            ]);

        } catch (QueryException $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
         
        $data = [
            'subject' => 'Invoice Pembelian Mobil',
            'name'    => $request->name,
            'detail'  => [
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'price' => $update_car->price,
                'merk'  => $update_car->name
            ]
        ];

        try {
            Mail::to($request->email)->send(new InvoiceMail($data));
        } catch (\Exception $e) {
            
        }

        return $buyer;
    }
}