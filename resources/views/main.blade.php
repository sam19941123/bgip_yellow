<!DOCTYPE html>
<html>
    <head>
        <title>BGIP - @yield('title')</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    
        <script>
            $(document).ready(function(){
                $("div[name='main']").fadeIn("slow");
            });
        </script>
    </head>

    <body>

      <br>
      <div style="display:none" name="main" class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
          <div class="panel-body">
            @section('content')
              這裡顯示內容。
            @show
          </div>
        </div>
      </div>
    </body>
</html>