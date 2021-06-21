<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personaldetail;
use Illuminate\Support\Facades\Auth;
class UserinfoController extends Controller
{

    function store(Request $req)
    {
        // dd($req);

        $validated = $req->validate([

            'father' => 'required|min:2|max:30',
            'mother' => 'required|max:30',
            'email' => 'required',
            'phone' => 'required|digits:10',
            'textarea' => 'string|max:100',
            'profile_pic'=>'sometimes|mimes:jpg,jpeg,png,bmp,tiff |max:4096',
        ]);

        if($req->profile_pic){
            $path = $req['profile_pic']->store('photo','public');

        if($path)
        User::where('id',auth()->user()->id)
        ->update((array('profile_photo_path' => $path)));
        unset($validated["profile_pic"]);
        }


        // dd($validated);
        $detail=array('id' => auth()->user()->id) + $validated;
        if(!(Personaldetail::find(auth()->user()->id))==null)
        {
                $result= Personaldetail::where('id',auth()->user()->id)
                                    ->update($detail);
        }
    else{
            $result=Personaldetail::create($detail);
        }

        if ($result){
            return redirect()->route('dashboard')->with('message', 'The user info has been saved');
        }


   }
}
//     public function createStepOne(Request $request)
//   {
//     // if($request->session()->has('user_detail.father')){
//     // }
//     $detail = $request->session()->get('user_detail');
//         return view('info.info_stepone',compact('detail'));
//     }

//     public function createStepTwo(Request $request)
//     {

//         if(!$request->session()->has('user_detail.father') )
//         {
//         if($request->has('father'))
//         {

//             $validated = $request->validate([
//                 'father' => 'required|min:2|max:30',
//                 'mother' => 'required|max:30',
//             ]);

//             $request->session()->put('user_detail', $validated);
//         }
//     }

//         $detail = $request->session()->get('user_detail');

//         return view('info.info_steptwo',compact('detail'));
//     }

//     public function createStepThree(Request $request)
//     {
//         $validated = $request->validate([
//             'mobile' => 'required|digits:10',
//             'age' => 'required|max:100',
//         ]);
//        $detail= $request->session()->get('user_detail');
//        $detail['mobile']=$request->mobile;
//        $detail['age']=$request->age;
//        $request->session()->put('user_detail',$detail);
//         $detail=$request->session()->get('user_detail');
//         return view('info.info_stepthree',compact('detail'));
//     }

//    public function postStepFinal(Request $request){

//     $validated = $request->validate([
//         'textarea' => 'string|max:100',
//     ]);
//       $detail=$request->session()->get('user_detail');
//     $detail=array('id' => auth()->user()->id) + $detail;
//     $e=auth()->user()->id;
//      $detail['textarea']=$request->textarea;
//      if(!(Personaldetail::find(auth()->user()->id))==null)
//         {
//                 $result= Personaldetail::where('id',$e)
//                                     ->update($detail);
//         }
//     else{
//             $result=Personaldetail::create($detail);
//         }

//      if ($result)
// {
//     session()->forget(['user_detail']);
// }

// return redirect()->route('dashboard')->with('message', 'The user info has been saved');

//    }

