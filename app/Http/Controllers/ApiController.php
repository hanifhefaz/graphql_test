<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiController extends Controller
{
    //
    public function sendRequest()
{
    $client = new Client();
    $url = 'http://127.0.0.1:8000/graphql';
    $query = 'query {
        mainCategories: mainCategories {
          id
          name_dr
        }

      }
      ';

    try {
        $response = $client->request('POST', $url, [
            'json' => ['query' => $query],
        ]);

        $data = json_decode($response->getBody(), true);


        // return response()->json($data);

        return view('welcome',compact('data'));
    } catch (GuzzleException $e) {
        // Handle exception if the request fails
    }
}


public function getCategory(Request $request)
{

    $from_category = $request->from_category;
    $to_category = $request->to_category;
    $id = $request->id;
    $client = new Client();
    $url = 'http://127.0.0.1:8000/graphql';



    $query = 'query {

        '.$to_category.': '.$to_category.'('.$from_category.': '.$id.') {
          id
          name_dr
        }
     
      }
      ';

    try {
        $response = $client->request('POST', $url, [
            'json' => ['query' => $query],
        ]);

        $data = json_decode($response->getBody(), true);


        return response()->json($data);

        // return view('welcome',compact('data'));
    } catch (GuzzleException $e) {
        // Handle exception if the request fails
    }
}

}
