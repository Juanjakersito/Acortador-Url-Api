<?php

use App\Models\Url;


class UrlControllerMethods{
    public static function verificarSiUrlExisteYLaRetorna($url_destino){
        if(Url::where('url_destino',$url_destino)->exists()){
            // return Url::regresarUrlExistente($request->url_destino);
             return response()->json(['url_acortada'=>Url::regresarUrlExistente($url_destino)]) ;
         }
    }

    public static function verificarSiUrlEsValidaYLaRetorna($url_destino){
        if(Url::verificarSiUrlEsValida($url_destino)){
            $url_llave=Url::generarUrlCorta($url_destino);
   
            //return $url_llave;
            return response()->json(['url_acortada'=>$url_llave]) ;
           }else{
               $error_url='Inserta una url valida';
              // return $error_url;
            return response()->json(['url_acortada'=>$error_url]) ;
           }
    }
}