<?php

namespace App\Http\Controllers;

use App\Models\ForexCurrency;

use App\Repositories\ForexRepository;


class ForexController extends Controller
{
    private ForexRepository $forexRepository;

    public function __construct(ForexRepository $forexRepository)
    {

        $this->forexRepository = $forexRepository;
    }

    public function index(){

        $currencies = $this->forexRepository->getCurrency();
        return response()->json($currencies);
    }

    public function show(string $currency_pair){
        $rates = ForexCurrency::where('currency_pair',$currency_pair)->forexRates->orderBy('created_at', 'desc')->get();

        foreach ($rates->toArray() as $key => $value) {
            dump($value);
        }
        return response()->json($rates);
    }

}
