<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
       <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
           

           
        </style>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          

    </head>

    <body>
       <div class="container">
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
    <header class="row">
       
        @include('bbb.links')
    </header>    
        <div class="flex-center position-ref full-height">
           
			
            
            <div class="content">
 				    
                <div class="title m-b-md">
                  
                   @yield('content')
                </div>
				          
               
            </div>
        </div>
    </body>
    <footer class="row">
        
    </footer>
	</div>    
</html>
