<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use Url as GlobalUrl;
use UrlControllerMethods;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $urls = Url::all();
        return $urls;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUrlRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrlRequest $request)
    {
        //verifica que no se exceda la rl de 700 caracteres
        if(strlen($request->url_destino)>700){
            $mensaje='La url ó la url llave es muy larga';
            return response()->json([
                'mensaje' => $mensaje
            ]);
        }


        //Busca si ya existe una url corta para esa url, si ya existe no se guarda
        if (Url::where('url_destino', $request->url_destino)->exists()) {
            $mensaje='Esta url ya fue registrada por alguien mas';
            return response()->json([
                'url_acortada' => Url::regresarUrlExistente($request->url_destino),
                'mensaje' => $mensaje
            ]);
        }


        //VERIFICA QUE LA URL SEA VALIDA
        if (Url::verificarSiUrlEsValida($request->url_destino)) {
            $url_llave = Url::generarUrlCorta($request->url_destino);
            return response()->json(['url_acortada' => $url_llave]);
        } else {
            $error_url = 'Inserta una url valida';
            // return $error_url;
            return response()->json(['mensaje' => $error_url]);
        }
    }


    public function storeUrlPersonalizada(StoreUrlRequest $request)
    {



        //verifica que la url destino y la url llave no saean demasiado largas
        if(strlen($request->url_destino)>700 || strlen($request->url_llave)>100){
            $mensaje='La url ó la url llave es muy larga';
            return response()->json([
                'mensaje' => $mensaje
            ]);
        }


        //Verifica que los campos no esten vacios
        if ($request->url_llave == "") {
            $error_null = 'Rellena todos los campos';
            return response()->json(['mensaje' => $error_null]);
        }


        //verifica que la url llave insertada sea valida
        if (strpos($request->url_llave, ' ') !== false) {
            $error_espacio = 'No pongas espacios para personalizar tu url';
            return response()->json(['mensaje' => $error_espacio]);
        }


        

        //Verifica si la url destino ya existe
        if (Url::where('url_destino', $request->url_destino)->exists()) {
            $mensaje='Esta url ya fue registrada por alguien mas';
            return response()->json([
                'url_acortada' => Url::regresarUrlExistente($request->url_destino),
                'mensaje' => $mensaje
            ]);
        }

        //Verifica si existe una url con la url llave  identica a la insertada
        if (Url::where('url_llave', $request->url_llave)->exists()) {
            return response()->json([
                'urls_disponibles' => Url::regresarUrlsDisponibles($request->url_llave)
            ]);
        }




        //verifica que la url insertada sea valida
        if (Url::verificarSiUrlEsValida($request->url_destino)) {
            Url::create([
                'url_destino' => $request->url_destino,
                'url_llave' => $request->url_llave
            ]);
            return response()->json(['url_acortada' => Url::regresarUrlExistente($request->url_destino)]);
        }

        $error_url = 'Inserta una url valida';
        return response()->json(['mensaje' => $error_url]);
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUrlRequest  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
    }
}
