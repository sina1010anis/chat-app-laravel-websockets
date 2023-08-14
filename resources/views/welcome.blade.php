<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{url('/css/mt_style.css')}}">
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
        <script src="{{mix('js/app.js')}}" defer></script>
    </head>
    <body class="antialiased">
        <div id="app">
            <index-page :users="{{$users}}" :box_msg="{{(isset($box_msg)) ? $box_msg : null}}" :name="{{$name}}"/>
        </div>
    </body>
</html>
