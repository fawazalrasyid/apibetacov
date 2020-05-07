<?php

	function readData($url){
	$data = curl_init();
    curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($data, CURLOPT_URL, $url);
    curl_setopt($data, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
    curl_setopt($data, CURLOPT_HEADER, 0);  
    $hasil = curl_exec($data);
    curl_close($data);
    return $hasil;
    }
    
    $dataTarget =  readData('https://covid19.bengkuluprov.go.id/databengkulu');
    $dataTargetConfir =  readData('https://covid19.bengkuluprov.go.id/');

    $getDataOdp = explode('<span data-toggle="counter-up">', $dataTarget);
    $dataOdp = explode('</span>',$getDataOdp[1]);

    $getDataPdp = explode('<span data-toggle="icofont-heart-beat">', $dataTarget);
    $dataPdp = explode('</span>',$getDataPdp[1]);

    $getDataPositif = explode('<span data-toggle="counter-up">', $dataTargetConfir);
    $dataPositif = explode('</span>',$getDataPositif[3]);

    $getDataSembuh = explode('<span data-toggle="icofont-heart-beat">', $dataTargetConfir);
    $dataSembuh = explode('</span>',$getDataSembuh[1]);

    $getDataMeninggal = explode('<span data-toggle="counter-up">', $dataTargetConfir);
    $dataMeninggal = explode('</span>',$getDataMeninggal[4]);

    $getDataUpdate = explode('<h2>', $dataTargetConfir);
    $dataUpdate = explode('</h2>',$getDataUpdate[2]);
    
    $json = array(
        'confirmed' => ['value' => $dataPositif[0]],
        'recovered' => ['value' => $dataSembuh[0]],
        'deaths' => ['value' => $dataMeninggal[0]],
        'pdp' => ['value' => $dataPdp[0]],
        'odp' => ['value' => $dataOdp[0]],
        'metadata' => ['lastUpdatedAt' => $dataUpdate[0]"18:00:00"]
    
);

    echo json_encode($json)

?>