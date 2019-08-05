<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Validator;

class AuthController extends Controller
{
        public $successStatus = 200;
        public function register(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
                    'address'=>'required',
                    'phone'=>'required',
                    'user_type'=>'required',
                    'gender' =>'required',
                    'national_id'=>'required'

          ]);
        if ($validator->fails()) {
             return response()->json(['error'=>$validator->errors()], 401);                        }
        $input = $request->all();
        $user_data=[

           'name'          => $input['name'],
           'phone'         => $input['phone'],
           'email'         => $input['email'],
           'password'      => bcrypt($input['password']),
           'address'       => $input['address'],
           'phone'         => $input['phone'],
           'user_type'     => $input['user_type']
         ];


        $user = User::create($user_data);
        if ($request->user_type == 'teacher') {
          if($request->has('photo')){

          move_uploaded_file($_FILES['photo']['tmp_name'],'uploaded/teachers/'.$_FILES['photo']['name']);
          $image_name = 'foods/'.$_FILES['photo']['name'];
          $photo="/public/uploaded/". $image_name;
        }
          $teacher_data=[
            'user_id'          =>$user->id,
            'NationalID'       =>$input['national_id'],
            'photo'            =>$request->has('photo') ? $photo : null,
            'gender'           =>$input['gender'],
            'country'          =>$input['country'],
            'gov'              =>$input['gov'],
            'university'       =>$input['university'],
            'faculty'          =>$input['faculty_of_graduation'],
            'graduation_year'  =>$input['graduation_year'],
            'acc_grade'        =>$input['acc_grade'],
            'school_name'      =>$request->has('school_name') ? $input['school_name'] : null,
            'field_of_teaching'=>$request->has('field_of_teaching') ? $input['field_of_teaching'] : null,
            'educational_zone' =>$request->has('educational_zone') ? $input['educational_zone'] : null,
            'position'         =>$request->has('position') ? $input['position'] : null,
            'experience'       =>$request->has('experience') ? $input['experience'] : null
          ];
           $teacher=Teacher::create($teacher_data);
            $success['token'] =  $user->createToken('TUTOB')->accessToken;
            return response()->json(['success'=>$success], $this->successStatus,'data'=>[$user_data,$teacher_data]);
          }else if($request->user_type == 'school_adminstration'){

            $school_data=[
              'user_id'          =>$user->id,
              'photo'            =>$request->has('photo') ? $photo : null,
              'departments'      =>$input['departments'],
              'soo'              =>$input['soo'],
              'expected_salary'  =>$input['expected_salary'],
              'capacity_of_students'  =>$input['capacity_of_students'],
              'capacity_of_staffs'  =>$input['capacity_of_staffs'],    
            ];

          }

       }

       public function login(Request $request)
       {
           $credentials = [
               'email' => $request->email,
               'password' => $request->password
           ];

           if (auth()->attempt($credentials)) {
               $token = auth()->user()->createToken('TUTOB')->accessToken;
               return response()->json(['token' => $token], 200);
           } else {
               return response()->json(['error' => 'UnAuthorised'], 401);
           }
       }

    }
