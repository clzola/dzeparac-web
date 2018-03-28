<?php

namespace Dzeparac\Http\Controllers\Api;

use Dzeparac\Http\Requests\Api\LoginRequest;
use Dzeparac\User;
use Dzeparac\Http\Controllers\Controller;


class AuthController extends Controller
{
	/**
	 * Create a new AuthController instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:api', ['except' => ['login', 'refresh']]);
	}

	/**
	 * Get a JWT via given credentials.
	 *
	 * @param LoginRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(LoginRequest $request)
	{
		$entity = $request->get('entity', null);

		if($entity === "parent")
			return $this->parentLogin($request);

		else if ($entity === "child")
			return $this->childLogin($request);

		return response('Bad request', 400);
	}

	/**
	 * Get the authenticated User.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function me()
	{
		$user = auth()->user();

		return response()->json([
			'id' => $user->id,
			'username' => $user->username,
			'email' => $user->email
		]);
	}

	/**
	 * Log the user out (Invalidate the token).
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		auth()->logout();

		return response()->json(['message' => 'Successfully logged out']);
	}

	/**
	 * Refresh a token.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function refresh()
	{
		return $this->respondWithToken(auth('api')->refresh());
	}

	/**
	 * Get the token array structure.
	 *
	 * @param  string $token
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function respondWithToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' => auth('api')->factory()->getTTL() * 60
		]);
	}

	/**
	 * @param LoginRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function parentLogin(LoginRequest $request)
	{
		$parent = User::whereUsername($request->get('username'))->first();

		if(is_null($parent))
			return response()->json(['error' => 'Unauthorized/1'], 401);

		$isPasswordCorrect = \Hash::check($request->get('password'), $parent->password);

		if(!$isPasswordCorrect || !$token = \JWTAuth::fromSubject($parent))
			return response()->json(['error' => 'Unauthorized/2'], 401);

		return $this->respondWithToken($token);
	}

	/**
	 * @param LoginRequest $request
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function childLogin(LoginRequest $request)
	{
		$child = User::whereCode($request->get('code'))->first();

		if(is_null($child) || !$token = \JWTAuth::fromSubject($child))
			return response()->json(['error' => 'Unauthorized/3'], 401);

		$child->code = strtoupper(str_random(6));
		$child->save();

		return $this->respondWithToken($token);
	}
}
