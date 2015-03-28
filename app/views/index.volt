<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        {{ get_title() }}
        {{ stylesheet_link('css/estilo.css') }} 
        {{ stylesheet_link('css/logado.css') }}
        {{ stylesheet_link('css/slippry.css') }} 
        {{ javascript_include('js/jquery-1.11.2.min.js') }}
        {{ stylesheet_link('css/bootstrap.min.css') }} 
        {{ stylesheet_link('css/font-awesome.min.css') }}
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Armando Freitas">
    </head>
    <body>
     {{ content() }}
     {{ javascript_include('js/bootstrap.min.js') }} 
     {{ javascript_include('js/jquery-ui.min.js') }}
     {{ javascript_include('js/customElements.js') }}
     {{ javascript_include('js/slippry.min.js') }} 
     {{ javascript_include('js/funcoes.js') }}
</body>
</html>