<?php


namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Laravel\Passport\HasApiTokens;
use Validator;
use phpDocumentor\Reflection\Types\Integer;
use App\Post;
use App\Http\Resources\Post as PostResource;


class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){

        if(auth()->attempt(['email' => request('email'), 'password' => request('password')])){

            $user = auth()->user();

            $success['api_token'] =  $user->createToken('HelloLara')->accessToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;

            return response()->json(['error'=>'False', 'message'=>'Login Successful', 'user' => $success], $this->successStatus);

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
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',

        ]);


        if ($validator->fails()) {
            foreach ($validator->errors()->toArray() as $key => $value){
                $errors[] = $value[0];
            }
            return response(['errors'=>$errors]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['user_id'] = $user->id;
        $success['name'] =  $user->name;
        $success['email'] = $user->email;
        $success['api_token'] =  $user->createToken('HelloLara')->accessToken;

        // return response()->json(['user'=>$success]);
        if($user->save()){
            return response()->json(['error'=>'False', 'message'=>'Registration Successful', 'user' => $success], $this->successStatus);
        } else{
            return response()->json(['error'=>'True', 'message'=>'Registration Unsucccessful'], 401);
        }
    

    }

    public function getPostsOfUser()
    {
        $user = auth()->user();
        $userPosts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
        return PostResource::collection($userPosts);
    }

}
