<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Provinsi,City,User};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // AKUN --------------------------------------------------------------------------------------------

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'api_token' => null,
        ]);

        return response()->json([
            'message'=>'Berhasil Register',
            'statusCode'=>200
        ], 200);
    }

    public function login(Request $request)
    {
        User::where('email',$request['email'])->update([
            'api_token' => Str::random(60)
        ]);

        $user = User::where('email',$request['email'])->first();
        if($user != null){
            if(Hash::check($request['password'], $user->password)){

                return response()->json([
                    'message'=>'Berhasil Login',
                    'result' => $user,
                    'statusCode'=>200
                ], 200);
    
            }else{
    
                return response()->json([
                    'message'=>'Email atau Password salah',
                    'statusCode'=>404
                ], 404);
    
            }

        }else{
            return response()->json([
                'message'=>'Email atau Password salah',
                'statusCode'=>404
            ], 404);
        }

    }


    // PROVINSI ----------------------------------------------------------------------------------------

    public function province()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key:0df6d5bf733214af6c6644eb8717c92c"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $json = json_decode($response, true);
        
        $data = $json['rajaongkir']['results'];
        
        $checkData = Provinsi::where('id',$data['0']['province_id'])->where('province',$data['0']['province'])->count();
        if($checkData != 0){
            return response()->json([
                'message'=>'Anda sudah melalukan fetching data',
                'statusCode'=>404
            ], 404);    
        }
        
        foreach($data as $key => $value){
            Provinsi::create([
                'id' => $value['province_id'],
                'province'=>$value['province'],
            ]);
        }        
        return response()->json([
            'message'=>'Sukses Fetching Data Province',
            'statusCode'=>200
        ], 200);
    }

    // CITY ----------------------------------------------------------------------------------------

    public function cities()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key:0df6d5bf733214af6c6644eb8717c92c"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $json = json_decode($response, true);
        
        $data = $json['rajaongkir']['results'];
        
        $checkData = City::where('id',$data['0']['city_id'])
                        ->where('province_id',$data['0']['province_id'])
                        ->where('city_name',$data['0']['city_name'])
                        ->count();

        if($checkData != 0){
            return response()->json([
                'message'=>'Anda sudah melalukan fetching data',
                'statusCode'=>404
            ], 404);    
        }

        foreach($data as $key => $value){
            City::create([
                'id' => $value['city_id'],
                'province_id'=>$value['province_id'],
                'type'=>$value['type'],
                'city_name'=>$value['city_name'],
                'postal_code'=>$value['postal_code'],
            ]);
        }

        return response()->json([
            'message'=>'Sukses Fetching Data City',
            'statusCode'=>200
        ], 200);
        
    }


    // SEARCH ----------------------------------------------------------------------------------------

    public function search_province()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data = Provinsi::where('id',$id)->first();
            $data['city'] = City::where('province_id',$id)->get();
            return response()->json([
                'message'=>'Sukses',
                'result'=>$data,
                'statusCode'=>200
            ], 200);
        }else{
            $data = Provinsi::get();
            foreach($data as $key => $value){
                $data[$key]['city'] = City::where('province_id',$value->id)->get();
            }
            return response()->json([
                'message'=>'Sukses',
                'result'=>$data,
                'statusCode'=>200
            ], 200);
        }
    }

    public function search_city()
    {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data = City::where('id',$id)->first();
            $data['province_name'] = Provinsi::where('id',$data->province_id)->first()->province;

            return response()->json([
                'message'=>'Sukses',
                'result'=>$data,
                'statusCode'=>200
            ], 200);    
        }else{
            $data = City::get();
            foreach($data as $key => $value){
                $data[$key]['province_name'] = Provinsi::where('id',$value->province_id)->first()->province;
            }
            return response()->json([
                'message'=>'Sukses',
                'result'=>$data,
                'statusCode'=>200
            ], 200);  
        }
    }
}
