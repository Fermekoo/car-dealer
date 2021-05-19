<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            background-color:#bdc3c7;
            margin:0;
        }
        .card {
            background-color:#fff;
            padding:20px;
            margin:20%;
            /* text-align:center; */
            margin:0px auto;
            width: 580px; 
            max-width: 580px;
            margin-top:10%;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }
        .garis {
            width: 100%;
        }
        
    </style>
</head>
<body>
    <div class="card">
        <h3 class="">Halo, {{$data['name']}}</h3>
            
           <p>Berikut adalah detail pembelian anda</p>
           <ul>
               <li>Nama : {{$data['detail']['name']}}</li>
               <li>Email : {{$data['detail']['email']}}</li>
               <li>Phone : {{$data['detail']['phone']}}</li>
               <li>Merk Mobil : {{$data['detail']['merk']}}</li>
               <li>harga Pembelian : {{$data['detail']['price']}}</li>
           </ul> 
        <hr class="garis">
    
        <p style="text-align:center;">Car Dealer</p>
    </div>
</body>
</html>