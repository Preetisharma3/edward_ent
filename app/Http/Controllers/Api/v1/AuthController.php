<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Template;
use App\Models\Question;
use App\Models\Agreement;
use App\Models\Type;
use App\Models\Technician;
use App\Models\Assign;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

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
          //  'name' => 'required|string|between:2,100',
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

    //add user

public function postUser(Request $request){
       
    	$validator = Validator::make($request->all(), [
           'first_name'=>'required',
           'last_name'=>'required',
           'phone_no'    =>'required',
           'email'    =>'required',
           'username' =>'required',
           'password'  =>'required',
        //    'user_type'   =>'required',
           'status' =>'required',
           'address'=>'required'
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= User::create([
                          'first_name'=>$request->first_name,
                           'last_name'=>$request->last_name,
                            'phone_no'=>$request->phone_no,
                             'email'   =>$request->email,
                            'username' =>$request->username,
                          'password'    =>Hash::make($request->password),
                            'role'   =>$request->role,
                             'status' =>$request->status,
                              'address' =>$request->address,
                            
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);

       
    }
//get user
 public function getUser()
        {
            
                 $user = User::all();
                  return $user;
           
         }

         //delete user
         public function deleteUser($id)
      {
          $idFind = User::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }

      //edit user

         public function editUser(Request $request,$id) {
          $data = User::where('id',$id)->first();
          return $data;

      }
      //update User
                    public function updateUser(Request $req){
                       $data = User::find($req->id);
                        $data->id=$req->id;
                        $data->first_name   =$req->first_name;
                        $data->last_name    =$req->last_name;
                        $data->phone_no        =$req->phone_no;
                        $data->email        =$req->email;
                        $data->username     =$req->username;
                        $data->role    =$req->role;
                        $data->status       =$req->status;
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
}
//search API
public function searchUser(Request $request){
       
        $search = $request->input('search');
  
        $posts = User::query()
                    ->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('phone_no', 'LIKE', "%{$search}%")
                    ->get();
        
        return response()->json([$posts]);
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


         public function addTechnician(Request $request)
         {
             $validator = Validator::make($request->all(), [
           'start_date'=>'required',
           'end_date'=>'required',
           'reason'    =>'required'
         
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= Technician::create([
                          'start_date'=>$request->start_date,
                           'end_date'=>$request->end_date,
                            'reason'=>$request->reason,
                        
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);
         }
 public function getTech()
        {
            
                 $user = Technician::all();
                  return $user;
           
         }




           public function deleteTech($id)
      {
          $idFind = Technician::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }
      
         public function editTech(Request $request,$id) {
          $data = Technician::where('id',$id)->first();
          return $data;

      }



                            public function updateTech(Request $req ){
                              
                       $data = Technician::find($req->id);
                        $data->id=$req->id;
                        $data->start_date   =$req->start_date;
                        $data->end_date    =$req->end_date;
                        $data->reason        =$req->reason;
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
                     }






                     public function postTemplate(Request $request){
       
    	$validator = Validator::make($request->all(), [
           'template_name'=>'required',
            'question_name'=>'required',
            'answer'    =>   'required',
            'typeQ'=>'required',
            'status'=>'required'
    
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= Template::create([
                          'template_name'=>$request->template_name,
                           'question_name'=>$request->question_name,
                           'answer'=>$request->answer,
                           'typeQ'=>$request->type,
                           'status'=>$request->status,
                            
                            
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);

       
    }

      public function editTemplate(Request $request,$id) {
          $data = Template::where('id',$id)->first();
          return $data;

      }


           public function updateTemplate(Request $req,$id){
                       $data = Template::find($req->id);
                        $data->template_name  =$req->template_name;
                        // $data->question_name    =$req->question_name;
                        // $data->answer        =$req->answer;
                        $data->status        =$req->status;
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
}


      public function deleteTemplate($id)
      {
          $idFind = Template::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }



      public function assignTemplate(Request $request){
       
    	$validator = Validator::make($request->all(), [
           'choose_template'=>'required',
           'choose_technician'=>'required',
           
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= Assign::create([
                          'choose_template'=>$request->choose_template,
                           'choose_technician'=>$request->choose_technician,
                            
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);

       
    }




     public function getAssign()
        {
            
                 $user = Assign::all();
                  return $user;
           
         }

         public function editAssign(Request $request,$id) {
          $data = Assign::where('id',$id)->first();
          return $data;

      }

       public function updateAssign(Request $req,$id){
                       $data = Assign::find($req->id);
                        $data->choose_template  =$req->choose_template;
                         $data->choose_technician   =$req->choose_technician;
                
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
}



 public function deleteAssign($id)
      {
          $idFind = Assign::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }


public function postCategory(Request $request){
       
    	$validator = Validator::make($request->all(), [
           'category'=>'required',
            'status' =>'required',
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= Category::create([
                          'category'=>$request->category,
                          'status' =>$request->status,
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);

       
    }


public function getCategory()
        {
            
                 $user = Category::all();
                  return $user;
           
         }

         public function deleteCategory($id)
      {
          $idFind = Category::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }

public function postSubcategory(Request $request){
       
    	$validator = Validator::make($request->all(), [
           'sub_category_name'=>'required',
            'first_hour' =>'required',
             'additional_hour' =>'required',
             'category_id' =>'required',
             'category_name'=>'required'
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= Subcategory::create([
                          'sub_category_name'=>$request->sub_category_name,
                          'first_hour' =>$request->first_hour,
                          'additional_hour' =>$request->additional_hour,
                          'category_id'=>$request->category_id,
                           'category_name'=>$request->category_name,
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);

       
    }




    public function getSubCategory()
        {
            
                 $user = Subcategory::all();
                  return $user;
           
         }



         public function editSubcategory(Request $request,$id) {
          $data = Subcategory::where('id',$id)->first();
          return $data;

      }


       public function updateSubcategory(Request $req,$id){
                       $data = Subcategory::find($req->id);
                        $data->sub_category_name  =$req->sub_category_name;
                         $data->first_hour   =$req->first_hour;
                           $data->additional_hour   =$req->additional_hour;
                
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
}


  public function deleteSubcategory($id)
      {
          $idFind = Subcategory::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }


public function addAgreement(Request $request){
       
    	$validator = Validator::make($request->all(), [
           'Agreement'=>'required',
            'status'=>'required'
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= Agreement::create([
                          'Agreement'=>$request->Agreement,
                          'status' =>$request->status,
                          
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);

       
    }

        public function editAgreement(Request $request,$id) {
          $data = Agreement::where('id',$id)->first();
          return $data;

      }



         public function updateAgreement(Request $req,$id){
                       $data = Agreement::find($req->id);
                        $data->Agreement  =$req->Agreement;
                         $data->status   =$req->status;
                
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
}


public function deleteAgreement($id)
      {
          $idFind = Agreement::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }

public function addSupplier(Request $request){
       
    	$validator = Validator::make($request->all(), [
           'first_name'=>'required',
            'last_name'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'state'=>'required',
            'city'=>'required',
            'zipcode'=>'required',
            'company_name'=>'required',
            'category'=>'required',
         ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
  
    $lead= Supplier::create([
                          'first_name'=>$request->first_name,
                          'last_name' =>$request->last_name,
                           'phone' =>$request->phone,
                            'address' =>$request->address,
                            'state' =>$request->state,
                            'city' =>$request->city,
                            'zipcode' =>$request->zipcode,
                            'company_name' =>$request->company_name,
                             'category' =>$request->category,
                          
                       
               
            ]);
            
           return response()->json(['success' => 'Created successfuly'], 401);

       
    }

public function getSupplier()
        {
            
                 $user = Supplier::all();
                  return $user;
           
         }

       public function editSupplier(Request $request,$id) {
          $data = Supplier::where('id',$id)->first();
          return $data;

      }



      
         public function updateSupplier(Request $req,$id){
                       $data = Supplier::find($req->id);
                        $data->first_name  =$req->first_name;
                         $data->last_name  =$req->last_name;
                          $data->phone  =$req->phone;
                           $data->category  =$req->category;
                           $data->company_name  =$req->company_name;
                           $data->address  =$req->address;
                         
                
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
}


public function deleteSupplier($id)
      {
          $idFind = Supplier::find($id);
          $result = $idFind->delete();
          if($result)
          {
              return["result"=>"record has been deleted"];
          }
         else{
              return["result"=>"record has not been deleted"];
         }
      }


  public function editCategory(Request $request,$id) {
          $data = Category::where('id',$id)->first();
          return $data;

      }

      
          public function updateCategory(Request $req,$id){
                       $data = Category::find($req->id);
                        $data->category  =$req->category;
                         $data->status  =$req->status;
                         
                         
                
                          $result               =$data->save();
                      if($result)
                      {
                         return response()->json(['message'=>'updated']);
                      }  
}
//  public function index()
//  {
//      $cat = SubCategory::all();
//      $cat = $cat->getCategory;
//      dd($cat); 
    
//  }

 
}