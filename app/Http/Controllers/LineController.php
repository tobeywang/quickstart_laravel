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
            $ecdata=base64_encode($response->getRawBody());
            $decdata = base64_decode($response->getRawBody());
            echo 'Succeeded!';
            echo $ecdata;
            return;
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
