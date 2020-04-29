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
        ];
        echo('richmenuid:'.$richmenuId);
        $richmenuId="richmenu-e6331662f9cee7852e0f4f6dbe1f6aeb";
        $response = $client->request('POST', 'https://api-data.line.me/v2/bot/richmenu/' . $richmenuId . '/content/', [
            'headers' => $headers
        ]);
        //status
        $status=$response->getStatusCode();
        if($status==200){
            //body 
            $body=$response->getBody();
            echo($body);
        }
        echo('None');

    }

}
