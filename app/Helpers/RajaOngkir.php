<?php 

namespace App\Helpers;

use GuzzleHttp\Exception\RequestException;

class RajaOngkir
{
	public static function getprovince($parameter,$token)
	{
        $url = 'starter/province';
        $base_url = 'https://api.rajaongkir.com/';
        $param = http_build_query($parameter); 
		$parameter = $url."?".$param;
		
		if ($token != null) {
			$auth = [
				'headers' => [
					'key' => $token
				]
			];
		}else {
			$auth = [
			];
		}

		try {
	     	$client = new \GuzzleHttp\Client(['base_uri' => $base_url]);
	     	$response = $client->request('GET', $parameter, $auth);
		} catch (RequestException $exception) {
			$response = $exception->getResponse();
        }
        
        $result = [
            'status_code' => $response->getStatusCode(),
            'data' => json_decode($response->getBody()->getContents())
        ];
        
        return $result;
        
	}

	public static function getcity($parameter,$token)
	{
        $url = 'starter/city';
        $base_url = 'https://api.rajaongkir.com/';
        $param = http_build_query($parameter); 
		$parameter = $url."?".$param;
		
		if ($token != null) {
			$auth = [
				'headers' => [
					'key' => $token
				]
			];
		}else {
			$auth = [
			];
		}

		try {
	     	$client = new \GuzzleHttp\Client(['base_uri' => $base_url]);
	     	$response = $client->request('GET', $parameter, $auth);
		} catch (RequestException $exception) {
			$response = $exception->getResponse();
        }
        
        $result = [
            'status_code' => $response->getStatusCode(),
            'data' => json_decode($response->getBody()->getContents())
        ];
        
        return $result;
        
	}

	public static function getcost($parameter,$token)
	{
		$url = 'starter/cost';
		$base_url = 'https://api.rajaongkir.com/';
		
		if ($token != null) {
			$headers = [
				'headers' => [
					'key' => $token
				],
				'form_params' => $parameter
			];
		}else{
			$headers = [
				'form_params' => $parameter
			];
		}

		try {
			$client = new \GuzzleHttp\Client(['base_uri' => $base_url]);
			$response = $client->request('POST', $url, $headers);
		} catch (RequestException $exception) {
			$response = $exception->getResponse();
		}
		
		$result = [
            'status_code' => $response->getStatusCode(),
            'data' => json_decode($response->getBody()->getContents())
        ];
        
        return $result;
	}
}