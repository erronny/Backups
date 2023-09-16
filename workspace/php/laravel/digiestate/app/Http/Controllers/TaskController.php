<?php

namespace App\Http\Controllers;

use JWTAuth;
//use App\Task;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    /**
     * TaskController constructor.
     */
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

	public function index()
	{
	    $users = $this->user->get()->toArray();

	    return response()->json([
            'success' => true,
            'results' => $users,
        ]);
	    //return $tasks;
	}

}
