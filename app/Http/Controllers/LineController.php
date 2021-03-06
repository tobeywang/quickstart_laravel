<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class LineController extends Controller
{
    //
    public function __construct()
    {
        // 建構服務層調用器
        $this->httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(env('LINE_CHANNEL_TOKEN'));        
        $this->bot = new \LINE\LINEBot($this->httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

    }
    //richmenu
    public function getrichmenuImgAndSave($richmenuId)
    {
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . env('LINE_CHANNEL_TOKEN'),
            'sink' => '/'
        ];
        // echo('richmenuid:'.$richmenuId);
        $richmenuId="richmenu-e6331662f9cee7852e0f4f6dbe1f6aeb";
        $response=$this->bot->downloadRichMenuImage($richmenuId);
        if ($response->isSucceeded()) {
            //Image to binary conversion: ps.明明傳來的是說binary data
            $image=$response->getRawBody();
            $ecdata=base64_encode($image);
            //Binary to image conversion:
            //$decdata = base64_decode($response->getRawBody());
            $imageInfo=getimagesizefromstring($image);
            // output:
            // [0]=> int(667) 
            // [1]=> int(184) 
            // [2]=> int(3) 
            // [3]=> string(24) "width="667" height="184"" 
            // ["bits"]=> int(8) 
            // ["mime"]=> string(9) "image/png" 
            foreach ($imageInfo as $info){
                echo $info;
            }
            // return view('welcome',['body'=>$ecdata]);
        }
        
        // $response = $client->request('GET', 'https://api-data.line.me/v2/bot/richmenu/' . $richmenuId . '/content', [
        //     'headers' => $headers
        // ]);
        // //status
        // $status=$response->getStatusCode();
        // if($status==200){
        //     echo($status.'ok');
        //     // Get all of the response headers.
        //     foreach ($response->getHeaders() as $name => $values) {
        //         echo $name . ': ' . implode(', ', $values) . "\r\n";
        //     }
        //     $body=$response->getBody();
        //     $body64=base64_decode($body);
        //     //下載檔案
        //     //Storage::download('file.jpg');
            
        //     // // response()->download($response);
        //     // //body 
        //     // $body=$response->getBody();
        //     // echo($body);
        //     // // echo($response->getHeader('Content-Type'));
        //     // echo($body->getContents());
        //     return view('welcome',['body'=>$body64]);
        // }
        // else
        //     echo('None');
    }

}
