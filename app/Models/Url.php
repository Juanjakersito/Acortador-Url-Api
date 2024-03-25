<?php

namespace App\Models;

use Doctrine\ORM\Query\Expr\Func;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $table='mis_urls';
    protected $fillable=['url_llave','url_destino'];


    // LOGICA DEL MODELO

    public static function verificarSiUrlEsValida(String $urlDestino){
        // Remover los caracteres ilegales de la url
           $urlDestino = filter_var($urlDestino, FILTER_SANITIZE_URL);
        // Validar url
           if (!filter_var($urlDestino, FILTER_VALIDATE_URL) === false) {
           return true;
           } else {
           return false;
           }
       }
   
       public static function generarUrlCorta(String $urlDestino): String{
           $llaveRandom=Str::random(6);
           while(self::where('url_llave',$llaveRandom)->exists()){
           $llaveRandom=Str::random(6);
           }
   
           self::create([
               'url_destino'=> $urlDestino,
               'url_llave'=> $llaveRandom
           ]);
           
           return app()->make('url')->to($llaveRandom);
        }
        
    
       public static function regresarUrlExistente(String $url): String{
           $url_info=self::where('url_destino',$url)->first();
           return app()->make('url')->to($url_info->url_llave);
       }

       public static function regresarUrlsDisponibles(String $url_llave){
        $urlsDisponibles=array();

        for ($x = 0; $x < 5; $x++) {
            $llaveRandom=Str::random(6);
            while(self::where('url_llave',$url_llave.$llaveRandom)->exists()){
            $llaveRandom=Str::random(6);
            }
            array_push($urlsDisponibles,$url_llave.$llaveRandom);
          }
        return $urlsDisponibles;
       }
}
