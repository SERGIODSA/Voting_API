<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	/**
	 * Login user with given credentials
	 */
	public function login(Request $request)
	{ 
		$user = User::whereEmail($request->get('username'))->first();

		if (!$user) {
			return Response()->json(['message' => 'User Not Found'], 404);
		}

		$data = [
			'grant_type' => 'password',
			'client_id' => Config::get('auth.oauth.client_id'),
			'client_secret' => Config::get('auth.oauth.client_secret'),
			'username' => $request->get('username'),
			'password' => $request->get('password'),
		];

		$response = $this->handleOauthResponse(
			app()->handle(Request::create('/oauth/token', 'POST', $data))
		);

		return Response()->json(
			$response ? [
				'access_token' => $response->access_token,
				'refresh_token' => $response->refresh_token,
				] : ['message' => 'Unauthorized']
			, 
			$response ? 200 : 401
		);
	}

	/**
	 * Logout authenticated user
	 */
	public function logout(Request $request)
	{
		DB::table('oauth_refresh_tokens')
			->where('access_token_id', $request->user()->token()->id)
			->update([
				'revoked' => true,
			]);

		$request->user()->token()->revoke();

		return Response()->json('success', 200);
	}

	/**
	 * Validate fields
	 */
	private function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);
	}

	/**
	 * Handle the OAuth2 Response
	 */
	private function handleOauthResponse($response)
	{
		// Check if the request was successful
		if ($response->getStatusCode() != 200) {
			return null;
		}
	
		// Get the data from the response
		return json_decode($response->getContent());		
	}
}