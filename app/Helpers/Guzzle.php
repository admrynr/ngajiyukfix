<?php 

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class Guzzle
{
	public static function post($parameter = [], $base_url, $url, $token)
	{
		if ($token != null) {
			$headers = [
				'headers' => [
					'Authorization' => 'Bearer '.$token
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
		
		if(!is_null($response)){
			$result = [
				'status_code' => $response->getStatusCode(),
				'data' => json_decode($response->getBody()->getContents())
			];
			return $result;
		} else return redirect()->route('error.apidown');
	}

	public static function put($parameter = [], $base_url, $url, $token)
	{
		if ($token != null) {
			$headers = [
				'headers' => [
					'Authorization' => 'Bearer '.$token
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
			$response = $client->request('PUT', $url, $headers);
		} catch (RequestException $exception) {
			$response = $exception->getResponse();
		}

		if(!is_null($response)){
			$result = [
				'status_code' => $response->getStatusCode(),
				'data' => json_decode($response->getBody()->getContents())
			];
			return $result;
		} else return redirect()->route('error.apidown');
	}

	public static function del($parameter = [], $base_url, $url, $token)
	{
		$headers = [
			'headers' => [
				'Authorization' => 'Bearer '.$token,
			],
		];

		try {
			$client = new \GuzzleHttp\Client(['base_uri' => $base_url]);
			$response = $client->request('DELETE', $url, $headers);
		} catch (RequestException $exception) {
			$response = $exception->getResponse();
		}

		if(!is_null($response)){
			$result = [
				'status_code' => $response->getStatusCode(),
				'data' => json_decode($response->getBody()->getContents())
			];
			return $result;
		} else return redirect()->route('error.apidown');
	}

	public static function get($parameter, $base_url, $url, $token)
	{
		$param = http_build_query($parameter); 
		$parameter = $url."?".$param;
		
		if ($token != null) {
			$auth = [
				'headers' => [
					'Authorization' => 'Bearer '.$token
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

		if(!is_null($response)){
			$result = [
				'status_code' => $response->getStatusCode(),
				'data' => json_decode($response->getBody()->getContents())
			];
			return $result;
		} else return redirect()->route('error.apidown');
	}

	public static function sendToken($parameter = [], $base_url = '', $url = '')
	{
		$auth = [
			'form_params' => $parameter
		];
		
		try {
			$client = new \GuzzleHttp\Client(['base_uri' => $base_url]);
			$response = $client->request('POST', $url, $auth);
		} catch (RequestException $exception) {
			$response = $exception->getResponse();
		}
		
		if(!is_null($response)){
			return $response;
		} else return redirect()->route('error.apidown');
	}

	public static function getContents($response)
	{
		$data = $response->getBody()->getContents();
		return json_decode($data);
	}

	/**
	* Get parameter API Value for internal
	* param array('value', 'condition')
	* recieve condition =, !=, <=, >=, like
	* not acceptable  for beetwen
	* return string
	*/
	public static function getParamValue($parameter)
	{
		return implode(',', $parameter);
	}
}