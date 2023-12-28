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

        $response = $this->forexRepository->findBySymbol($currency_pair);
        return response()->json($response);
    }

}
