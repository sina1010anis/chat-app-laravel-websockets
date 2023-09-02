<!DOCTYPE html>
<html>
    <head>
        <script src="{{mix('js/app.js')}}" defer></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{url('/css/mt_style.css')}}">
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
    </head>
    <body class="antialiased">
        <div id="app">
            @if (session('msg_ok'))
                <div class="text-center bg-success p-2 text-white">
                    {{session('msg_ok')}}
                </div>
            @endif
            @if (session('msg_error'))
                <div class="text-center bg-danger p-2 text-white">
                    {{session('msg_error')}}
                </div>
            @endif
            @foreach ($products as $product)
                <p class="py-3 text-center">
                    <a href="{{route('edit.product', ['product' => $product->name])}}">{{$product->name}}</a>
                </p>
            @endforeach
        </div>
    </body>
</html>
