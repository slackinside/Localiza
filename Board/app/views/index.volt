<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {{ get_title() }}
        {{ stylesheet_link('css/bootstrap.min.css') }} 
        {{ stylesheet_link('css/sb-admin.css') }} 
        {{ stylesheet_link('css/font-awesome.min.css') }}
        {{ stylesheet_link('css/jquery-ui.min.css') }}
        {{ stylesheet_link('css/bootstrap-select.min.css') }}
        {{ stylesheet_link('css/bootstrap-checkbox.css') }}
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>
    <body>
     {{ content() }}
     

     {{ javascript_include('js/jquery-1.11.0.js') }} 
     {{ javascript_include('js/bootstrap.min.js') }} 
     {{ javascript_include('js/bootstrap-select.min.js') }}
     {{ javascript_include('js/bootstrap-checkbox.js') }}
     {{ javascript_include('js/jquery-ui.min.js') }}
     {{ javascript_include('js/customElements.js') }}
</body>
</html>