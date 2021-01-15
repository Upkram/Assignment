<?php
use app\Quiz;
namespace App\Http\Controllers;
use Eastwest\Json\Facades\Json;

use Illuminate\Http\Request;
use response;
use Validator;
use DB;

class Apitask extends Controller
{
    public function create(Request $request){
            
            $validator = Validator::make($request->all(), [
			    'name' =>  'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
    			'description' => 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
    			
    		]);
   		// print_r($validator);die('k');
           if ($validator->fails()) {
            return response()->json([
                "status"=> "failure",
                "message"=> "Please Enter the value",

           ],400);
        }
        else{
            $quiz = DB::insert('insert into quizes (name, description) values (?, ?)', [$request->input('name'), $request->input('description')]);
   
            $id = DB::getPdo()->lastInsertId();
            $data =  DB::table('quizes')->latest('id')->first();
            
            return response()->json($data,200);
        }
    }
    public function getdata(Request $request,$id)
    {
        
        if (DB::table('quizes')->find($id)) {
            $view = DB::table('quizes')
            ->where('id', $id)
            ->get();
    
            return response()->json($view,200);
         }
         else
         {
            return response()->json([
                "status"=> "failure",
                "message"=> "Please Enter the correct id",

           ],400); 
         }
        

    }

    public function Postquestions(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' =>  'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'options' => 'regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/',
            'correct_option' => 'regex:/^[0-9]+$/',
            'quiz' => 'regex:/^[0-9]+$/',
             'points' => 'regex:/^[0-9]+$/',

            
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status"=> "failure",
                "reason"=> "Please Enter the correct value",

           ],400);
        }
        else{
        $questions = DB::insert('insert into questionss (name, options,correct_option,quiz,points) values (?,?,?,?,?)',
         [$request->input('name'), $request->input('options'),$request->input('correct_option'),
        $request->input('quiz'),$request->input('points')]);
            
            $data =  DB::table('questionss')->latest('id')->first();
            
            return response()->json($data,201);
        }
    }

    public function getquestions(Request $request,$id){
        // print_r($id);
        if (DB::table('questionss')->find($id)) {
            $view = DB::table('questionss')
            ->where('id', $id)
            ->get();
    
            return response()->json($view,200);
         }
         else
         {
            return response()->json([
                "status"=> "failure",
                "message"=> "Please Enter the correct id",

           ],400); 
         }
        
       

    }
    public function quizQuestion(Request $request,$id){
        // print_r($id);
       $quiz_data= DB::table('quizes')->find($id);
            $view = DB::table('quizes')
            ->where('id', $id)
            ->first(['name', 'description']);
            
        $question_data = DB::table('questionss')
        ->where('quiz', $id)
        ->get();
        if (!empty($question_data)) {
            
            $view->questions = $question_data;
       
            return response()->json($view);
            }
            else{
                return response()->json([
                    "status"=> "failure",
                    "message"=> "Please Enter the correct id",
    
               ],400); 
            }
        
    }

}
