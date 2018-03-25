<?php


namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Validator;
use phpDocumentor\Reflection\Types\Integer;


class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user();

            $success['token'] =  $user->createToken('HelloLara')->accessToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;

            return response()->json(['error'=>'False', 'message'=>'Login Successful', 'success' => $success], $this->successStatus);

        }else{

            return response()->json(['error'=>'True', 'message'=>'Login Unsucccessful'], 401);

        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',

        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['name'] =  $user->name;
        $success['email'] = $user->email;
        $success['token'] =  $user->createToken('HelloLara')->accessToken;

        return response()->json(['success'=>$success], $this->successStatus);

    }

}