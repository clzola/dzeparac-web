<?php

namespace Dzeparac\Support;

use Dzeparac\Child;
use Dzeparac\Parentt;
use Illuminate\Http\Request;

class UserProvider
{
	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Parentt
	 */
	public static function parentt(Request $request)
	{
		return Parentt::findOrFail(self::getUserId($request));
	}

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|Child
	 */
	public static function child(Request $request)
	{
		return Child::findOrFail(self::getUserId($request));
	}

	/**
	 * @param Request $request
	 *
	 * @return int
	 */
	public static function getUserId(Request $request)
	{
		$header = $request->header('X-User', null);
		return intval(explode(':', $header)[1]);
	}
}