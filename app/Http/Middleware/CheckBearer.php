<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use App\Models\{Provinsi,City,User};
use Illuminate\Http\Request;

class CheckBearer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            
            $header = $request->header('Authorization', '');
            if($header == ''){
                return response()->json([
                    'message'=>'Login Terlebih Dahulu',
                    'statusCode'=>404
                ], 404);
            }
            if (Str::startsWith($header, 'Bearer ')) {
                    $data = Str::substr($header,7);
                    if(!is_null(User::where('api_token',$data)->first())){
                        return $next($request);
                    }else{
                        return response()->json([
                            'message'=>'Token Anda Salah',
                            'status'=>404
                        ], 404);
                    }
            }else{
                return response()->json([
                    'message'=>'Header Menggunakan Bearer',
                    'status'=>404
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Login Terlebih Dahulu',
                'statusCode'=>404
            ], 404);
        }
        
    }
}

?>
