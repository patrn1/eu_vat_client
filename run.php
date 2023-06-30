<?php

function abc($countyCode) {
    $client = new SoapClient('https://ec.europa.eu/taxation_customs/tedb/ws/VatRetrievalService.wsdl');


    $req = [
        'memberStates' => [$countyCode],
        'situationOn' => '2023-06-08T00:00:00',
        'cpaCodes' => ['47'],
    ];

    // die(json_encode($client->retrieveVatRates($req)));

    $vatRateResults = $client->retrieveVatRates($req)->vatRateResults;

    // var_dump($vatRateResults);die();

    if (!is_array($vatRateResults)) $vatRateResults = [ $vatRateResults ];

    foreach ($vatRateResults as $result) {
        if ($result->type === "STANDARD") return $result->rate->value;
    }

    return null;
}


var_dump(abc('IT'));  
