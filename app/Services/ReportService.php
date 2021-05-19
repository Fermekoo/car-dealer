<?php 
namespace App\Services;

use App\Models\Buyer;
use Illuminate\Support\Facades\DB;
class ReportService
{
    public function getReport()
    {
        $most_car_seling_today = DB::select("select * from 
                                            (select count(buyers.id) total_sell, cars.name from buyers join cars on buyers.car_id = cars.id where date(buyers.created_at) = ? group by car_id ) as total 
                                            where total_sell = (select max(total_sell) from (select count(buyers.id) total_sell, cars.name from buyers join cars on buyers.car_id = cars.id where date(buyers.  created_at) = ? group by car_id ) as tt)", [date("Y-m-d"), date("Y-m-d")]);
        $car_name = '';
        foreach ($most_car_seling_today as $most_car) : 
            $car_name .= $most_car->name.',';
        endforeach;
        $last_day_selling     = Buyer::whereDate('created_at', now()->subDay(1)->format('Y-m-d'))->count();
        $today_selling        = Buyer::whereDate('created_at', now()->format('Y-m-d'))->count();
        $last_day_selling_rp  = Buyer::whereDate('created_at', now()->subDay(1)->format('Y-m-d'))->sum('purchasing_price');
        $today_selling_rp     = Buyer::whereDate('created_at', now()->format('Y-m-d'))->sum('purchasing_price');

        $percentage_today_selling    = (($today_selling - $last_day_selling) / $today_selling) * 100;
        $percentage_today_selling_rp = (($today_selling_rp - $last_day_selling_rp) / $today_selling_rp) * 100;
        $selling_sign                = ($today_selling >= $last_day_selling) ? '+' : '-';
        $selling_sign_rp             = ($today_selling_rp >= $last_day_selling_rp) ? '+' : '-';


        $most_car_seling_7day = DB::select("select * from 
        (select count(buyers.id) total_sell, cars.name from buyers join cars on buyers.car_id = cars.id where date(buyers.created_at) >= date(now() - interval 7 day) group by car_id ) as total 
        where total_sell = (select max(total_sell) from (select count(buyers.id) total_sell, cars.name from buyers join cars on buyers.car_id = cars.id where date(buyers.  created_at) >= date(now() - interval 7 day) group by car_id ) as tt)");

        $last_day7_selling     = Buyer::whereDate('created_at', '>=',now()->subDay(7)->format('Y-m-d'))->count();
        $last_day7_selling_rp  = Buyer::whereDate('created_at','>=' ,now()->subDay(7)->format('Y-m-d'))->sum('purchasing_price');

        $car_name_7 = '';
        foreach ($most_car_seling_7day as $most_car7) : 
            $car_name_7 .= $most_car7->name.',';
        endforeach;

        $result = [
            'most_car_selling_today' => rtrim($car_name, ","),
            'today_selling'          => $today_selling. '( ' .$selling_sign. $percentage_today_selling.'% )',
            'today_selling_rp'       => 'Rp.'.number_format($today_selling_rp). '( '.$selling_sign_rp.$percentage_today_selling_rp. '% )',
            'most_car_selling_day7'  => rtrim($car_name_7,","),
            'last_day7_selling'      => $last_day7_selling,
            'last_day7_selling_rp'   => 'Rp.'.number_format($last_day7_selling_rp)
        ];

        return $result;
    }
}