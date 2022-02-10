<?php

namespace App\Http\Controllers;

use Dusterio\LumenPassport\Http\Controllers\AccessTokenController;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	public function login(Request $request)
	{
		//$username = $request->username;
		$email = $request->email;
		$password = $request->password;

		if (empty($email) && empty($password)) {
			return response()->json(['status' => 'error', 'message' => 'You must fill all fields']);
		}
		$oauth = DB::table('oauth_clients')->where('id',2)->first();
		$client = new Client();
		try {
			return $client->post('http://rfid.com/api/oauth/token', [
				'form_params' => [
					'client_secret' => $oauth->secret,
					'grant_type' => 'password',
					'client_id' => 2,
					'username' => $request->email,
					'password' => $request->password
				]
			]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
		/*
		Encryption keys generated successfully.
		Personal access client created successfully.
		Client ID: 1
		Client secret: yj5EWgGjPQXV0I23umOah0l860E9pmJAEYWGJOYS
		Password grant client created successfully.
		Client ID: 2
		Client secret: SuRTgJLIOt2fUjFyGer99gAl9gCpTu7eu0S1ad7J
		*/
	}

	public function logout(Request $request)
	{
		//
	}
}
