<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Exports\UsersExport;

// users login  control,admin controls for additon of users
class UserController extends Controller
{

    //fetching the all the users
    public function changeuser(){
        $t = auth()->user()->id;
        $q = DB::table('users')->select('id','name','email')
                         ->where('id','!=',$t)
        ->whereNull('deleted_at')
        ->get();
        $onlySoftDeleted = User::onlyTrashed()->get();
        if(sizeof($q)>0 || sizeof($onlySoftDeleted)>0 ){
            return view('try',['data'=>$q,'deleted'=>$onlySoftDeleted]);
        }
        else{
            return view('emptyview');
        }
        return view('try',['data'=>$q,'deleted'=>$onlySoftDeleted]);
    }

// fucntion for enabling and soft deleting user
    public function ajaxactionUser(Request $req)
    {
       if( $req->dat[2]=="disable"){
        $deletedRows = User::where('id', $req->dat[0]);
        $r           = $deletedRows->delete();
       }
        else
        {
            $r = User::withTrashed()->find($req->dat[0])->restore();
        }
        if($r)
        {
            return 1;
        }
        else
        {
            return 0;
        }

    }
//  function to add new  users
    public function  addUser(Request $req){
        $rules = [
			'name'     => 'required|string|min:3|max:255',
			'password' => 'required|min:3|required_with:password_confirmation|confirmed',
			'email'    => 'required|string|email|max:255'
		];
		$validator = Validator::make($req->all(),$rules);

        if($validator->fails()) {
            return Redirect:: back()->withErrors($validator);
		}
        else{
            if((User::where('email', $req->email)->first())==null)
            {
                $user           = new User();
                $user->name     = $req->name;
                $user->email    = $req->email;
                $user->password = Hash::make($req->password);
            $user->save();
            return Redirect:: back()->with('success','user added  successfully!');
            }
            else{
                return Redirect:: back()->withErrors("USER ALREADY EXIST");
            }
        }


    }


    function userImport(Request $req){

  $import = new UsersImport();
  $import->import($req->file);

  if(count($import->failures())>0)
  {

         $failures = $import->failures();
         [$set,$data] = array(array(),array());

            foreach ($import->failures() as $failure)
            {
                if(!in_array($failure->row(), $set)){
                    array_push($set,$failure->row());
                    array_push($data,$failure->values());
                }
            }
            array_push($data, $import->failures());
            $export = new UsersExport($data);
            return Excel::download($export, 'errors.xlsx');
        }
   return Redirect:: back()->with('success', 'The users were successfully inserted');

}
}
