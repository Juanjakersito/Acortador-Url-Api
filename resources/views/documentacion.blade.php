<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('favicon.png') }}">
    {{-- AGREGANDO WATER CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AcortarUrl API</title>
</head>

<body>
    <h1>Bievenid@ a la API Acortar Url</h1>
    <p>La API de acortamiento de URL ofrece una solución rápida y sencilla para convertir enlaces largos en versiones
        más concisas. Con un simple llamado a nuestra API, puedes generar URLs más amigables y fáciles de compartir,
        perfectas para redes sociales, mensajes de texto y más.</p>
    <section>
        <h2><li>Mostrar las url registradas</li></h2>
        <span>Para que puedas ver todas las url registradas realiza una petición GET a:
            <br><br> <strong>{{ app()->make('url')->to('api/urls') }}</strong></span>
    </section>

    <section>
        <h2><li>Acortar una Url</li></h2>
        <span>Para poder acortar una url deberas hacer una petición POST a:
            <br><br> <strong>{{ app()->make('url')->to('api/urls') }}</strong></span><br><br>
        <span>El <strong>BODY</strong> de tu petición debera ser de la siguiente forma: <br><br> <strong>{"url_destino": "https://www.tuUrl.net/..."}</strong><br><br></span>
        <span>Optendras como respuesta un Json que tendra sigiente forma: <br><br> <strong>{"url_acortada": "{{ app()->make('url')->to('aaaaaa') }}"}</strong><br><br></span>
    </section>

    <section>
        <h2><li>Acortar una Url de Forma Personalizada</li></h2>
        <span>Para poder acortar una url deberas hacer una petición POST a:
            <br><br><strong>{{ app()->make('url')->to('api/urls') }}</strong><br><br></span>
        <span>El <strong>body</strong> de tu petición debera ser de la siguiente forma: <br><br><strong>{"url_destino": "https://www.tuUrl.net/...", "url_llave": "HolaPaquito"}</strong><br><br> </span>
        <span>Optendras como respuesta un Json con tu url personalizada, tendra siguiente forma: <br><br><strong>{"url_acortada": "{{ app()->make('url')->to('HolaPaquito') }}"}</strong></span>

        <h3>En caso de insertar una url_llave que alguien mas ya haya usado...</h3>
        <span>Optendras como respuesta un Json con recomendaciones de nombres que puedes utilizar para tu url: 
            <br><br> <strong>{"urls_disponibles": "[paquito123,paquito444,...]"}</strong> </span>
    </section>

    <section>
        <h2><li>Errores</li></h2>
        <span>Si llega a surgir algún error en la petición, se devolvera un Json con la descripción del error de la siguiente manera: <br><br><strong>{"mensaje": "breve descripción del error"}<br><br></strong></span>
        <span>Acá un listado de causas por las que pueda surgir un error en la petición</span>
        <ul>
            <li>Ingresar más de 700 caracteres en el url_destino</li>
            <li>Ingresar más de 100 caracteres en el url_llave</li>
            <li>Dejar el url_llave ó el url_destino vacios</li>
            <li>Ingresar una url_destino Inválida</li>
            <li>Ingresar una url_llave Inválida</li>
        </ul>
    </section>
</body>

</html>
