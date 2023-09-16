<div class="text-center">
                            
                        {!! QrCode::size(300)->generate('https://digiestate.co.in/assets/img/documents/'.$list->url) !!}
                            <p>Scan me to download image.</p>
                        </div>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>

    <div class="container mt-4">

        <div class="card">
            <div class="card-header">
                <h2>Simple QR Code</h2>
            </div>
            <div class="card-body">
               {!! QrCode::size(300)->generate('https://www.google.com/search?q=yrfy&oq=yrfy&aqs=chrome..69i57j0i10i131i433i512l4j0i10i433i512j0i10i512l4.999j0j7&sourceid=chrome&ie=UTF-8') !!}
                 <tr>
          <td>Download QR code</td>
          <td>
             <a href="{{ asset('images/qrcode.png') }}" download>Download</a>
          </td>
        </tr>
               <!-- <a href="{!! QrCode::size(300)->generate('https://www.google.com/search?q=yrfy&oq=yrfy&aqs=chrome..69i57j0i10i131i433i512l4j0i10i433i512j0i10i512l4.999j0j7&sourceid=chrome&ie=UTF-8') !!}" download>Download</a> -->
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>
            <div class="card-body">
                {!! QrCode::size(300)->backgroundColor(255,90,0)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!}
            </div>
        </div>

    </div>
</body>
</html>