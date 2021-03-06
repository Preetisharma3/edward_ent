<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Template;
use App\Models\Question;
use App\Models\Agreement;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login', 'register']]);
    // }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'role' => 'required'
        ]);

        

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if ($token = auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = User::where('email', $request->email)->firstOrFail();
            if ($user->role == $request->role) {
                $data = array(
                    'token' => $token,
                    'user' => $user
                );
                return response()->json([$data]);
            } else {
                return response()->json(['message' => trans('messages.unauthenticated')], 401);
            }
        } else {
            return response()->json(['message' => trans('messages.login_fail')], 401);
        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
//get Job folder
    public function getData()
        {
            
                 $user = Job::all();
                  return $user;
           
         }
         //get Agreement
         public function getAgreement()
        {
            
                 $user = Agreement::all();
                  return $user;
           
         }
          //get Template
           public function getTemplate()
        {
            
                 $user = Template::all();
                  return $user;
           
         }
         //get Questions
            public function getQuestions()
        {
            
                 $user = Type::all();
                  return $user;
           
         }

}
