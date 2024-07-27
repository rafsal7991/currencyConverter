<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CurrencyController extends Controller
{
    private $apiKey;
    private $apiUrl;

    public function __construct()
    {
        $this->apiKey = '45abb7b2dda8c7580e3794e6';
        $this->apiUrl = 'https://v6.exchangerate-api.com/v6/' . $this->apiKey;
    }

    public function index()
    {
        return view('currency_converter');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'from_currency' => 'required|string',
            'to_currency' => 'required|string',
        ]);

        $amount = $request->input('amount');
        $from_currency = $request->input('from_currency');
        $to_currency = $request->input('to_currency');

       
        $exchange_rate = $this->fetchExchangeRate($from_currency, $to_currency);

 
        $converted_amount = $amount * $exchange_rate;

        return response()->json([
            'amount' => $amount,
            'from_currency' => $from_currency,
            'to_currency' => $to_currency,
            'converted_amount' => $converted_amount
        ]);
    }

    private function fetchExchangeRate($from_currency, $to_currency)
    {
        $client = new Client();
        $response = $client->get("{$this->apiUrl}/pair/{$from_currency}/{$to_currency}");
        $data = json_decode($response->getBody(), true);

        if (isset($data['conversion_rate'])) {
            return $data['conversion_rate'];
        }

        return 1;
    }
}
?>