<?php

namespace App\Http\Controllers;

use Dusterio\LumenPassport\Http\Controllers\AccessTokenController;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use App\Models\User;
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
	public function register(Request $request)
	{
		$nom = $request->nom;
		$prenom = $request->prenom;
        $email = $request->email;
        $password = $request->password;

        // Check if field is not empty
        if (empty($nom) or empty($prenom) or empty($email) or empty($password)) {
            return response()->json(['status' => 'error', 'message' => 'You must fill all the fields']);
        }

        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => 'error', 'message' => 'You must enter a valid email']);
        }

        // Check if password is greater than 5 character
        if (strlen($password) < 6) {
            return response()->json(['status' => 'error', 'message' => 'Password should be min 6 character']);
        }

        // Check if user already exist
        if (User::where('email', '=', $email)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'User already exists with this email']);
        }

        // Create new user
        try {
            $user = new User();
            $user->nom = $nom;
            $user->prenom = $prenom;
            $user->email = $email;
            $user->password = app('hash')->make($password);

            if ($user->save()) {
                // Will call login method
                return $this->login($request);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
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
		try {
            auth()->user()->tokens()->each(function ($token) {
                $token->delete();
            });

            return response()->json(['status' => 'success', 'message' => 'Logged out successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
	}

	public function is_logged_in()
	{
		return response()->json(['is_logged_in' => auth()->check()]);
	}

	public function refresh_token(Request $request)
	{
		$oauth = DB::table('oauth_clients')->where('id',2)->first();
		$client = new Client();
		try {
			return $client->post('https://rfid123.azurewebsites.net/api/oauth/token/refresh', [
				'form_params' => [
					'grant_type' => 'refresh_token',
					'client_secret' => $oauth->secret,
					'client_id' => 2,
					'refresh_token' => $request->refresh_token
				],
				'headers' => [
					'Authorization' => 'Bearer '.$request->bearerToken(),
				]
			]);
		} catch (Exception $e) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	}
}
