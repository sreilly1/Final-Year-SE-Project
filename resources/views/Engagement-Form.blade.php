@foreach ($modules as $module)

<!-- <p> This is a module {{ $module -> module_name}}</p>
//<p> This is a module {{ $module -> id}}</p> -->

<html>
<head>
  <meta charset="utf-8">
  <title>foundation on laravel</title>
  <link rel="stylesheet" href="{{ asset('css/app.css')}}">
  <script src="{{ asset('js/modernizr.js') }}"> </script>
</head>
<body>

  <nav class="top-bar" data-top-bar role="navigation">
  </nav>
  Hello



  <script src="{{ asset('js/f5_vendors.js') }}"> </script>
  <script src="{{ asset('js/f5_components.js') }}"> </script>
</body>
</html>

@endforeach