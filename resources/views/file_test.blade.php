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
            <form action="{{route('new.product.post')}}" method="post">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                @error('name')
                    <p style="color: red"><b>{{$message}}</b></p>
                @enderror
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Price</label>
                  <input type="number" class="form-control" name="price" id="exampleInputPassword1">
                </div>
                @error('price')
                    <p style="color: red"><b>{{$message}}</b></p>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
