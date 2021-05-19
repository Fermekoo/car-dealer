@extends('home.template')
@section('content')
  <h2>Report</h2>
  <div class="table-responsive">
        <table class="table table-striped table-sm">
          <tbody>
            <tr>
              <td>DATA HARI INI</td>
              <td></td>
            </tr>
            <tr>
              <td>Mobile Yang Paling Banyak Dijual</td>
              <td>{{ $report['most_car_selling_today'] }}</td>
            </tr>
            <tr>
              <td>Penjualan Hari Ini</td>
              <td>{{ $report['today_selling'] }}</td>
            </tr>
            <tr>
              <td>Total Penjualan hari Ini</td>
              <td>{{ $report['today_selling_rp'] }}</td>
            </tr>
          </tbody>
        </table>
        <table class="table table-striped table-sm">
          <tbody>
            <tr>
              <td>DATA 7 HARI TERAKHIR</td>
              <td></td>
            </tr>
            <tr>
              <td>Mobil Yang Paling Banyak Dijual</td>
              <td>{{ $report['most_car_selling_day7'] }}</td>
            </tr>
            <tr>
              <td>Penjualan 7 Hari Terakhir</td>
              <td>{{ $report['last_day7_selling'] }}</td>
            </tr>
            <tr>
              <td>Total Penjualan 7 Hari Terakhir</td>
              <td>{{ $report['last_day7_selling_rp'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
@endsection
