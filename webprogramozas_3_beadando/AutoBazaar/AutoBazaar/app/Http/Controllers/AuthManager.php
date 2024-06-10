<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Brand;
use App\Models\Condition;
use App\Models\Fuel;
use App\Models\Modell;
use App\Models\Transmission;
use App\Models\Car;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AuthManager extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect(route('main'));
        }
        return view('login');
    }

    function registration(){
        if(Auth::check()){
            return redirect(route('main'));
        }
        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('main'))->with("success");
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }

    function registrationPost(Request $request){
        $request->validate([
            'username' => ['required', Rule::unique('users')],
            'phonenumber' => 'required|min:7|max:15',
            'password' => 'required'
        ]);

        $data['username'] = $request->username;
        $data['phonenumber'] = $request->phonenumber;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error", "Registration details are not valid");
        }
        return redirect(route('login'))->with("success", "Registration successful!"); 
    }

    function logout(){
        Session:flush();
        Auth::logout();
        return redirect(route('login')); 
    }

    function sellcar(){
        if(Auth::check()){
            $brand = Brand::all();
            $condition = Condition::all();
            $fuel = Fuel::all();
            $model = Modell::all();
            $transmission = Transmission::all();
            $extras = Extra::all();
            return view('sellcar',['brand'=>$brand,'model'=>$model,'condition'=>$condition,'fuel'=>$fuel,'transmission'=>$transmission,'extras'=>$extras]);
        }
        return view('login');
    }

    public function sellcarPost(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'model' => 'required',
            'condition' => 'required',
            'year' => 'required',
            'odometer' => 'required',
            'engine' => 'required',
            'fuel' => 'required',
            'cylindercapacity' => 'required',
            'horsepower' => 'required',
            'transmission' => 'required',
            'picture' => 'required'
        ]);

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $data['brand_id'] = $request->brand;
        $data['type'] = $request->type;
        $data['model_id'] = $request->model;
        $data['condition_id'] = $request->condition;
        $data['year'] = $request->year;
        $data['odometer'] = $request->odometer;
        $data['engine'] = $request->engine;
        $data['fuel_id'] = $request->fuel;
        $data['cylindercapacity'] = $request->cylindercapacity;
        $data['horsepower'] = $request->horsepower;
        $data['transmission_id'] = $request->transmission;
        $data['picture'] = $request->picture;

        $user = Auth::user();
        $data['user_id'] = $user->id;

        if(request()->has('picture')){
            $picturePath = request()->file('picture')->store('cars','public');
            $data['picture'] = $picturePath;
        }

        $car = Car::create($data);

        $car->extras()->sync($request->extras);

        return redirect(route('main'))->with("success", "Advertisement posted!"); 
    }

    function myprofile(){
        if(Auth::check()){
            return view('myprofile');
        }
        return view('login');
    }

    function myprofileUpdate(Request $request){
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'phonenumber' => 'required|string|max:20',
        ]);
        try {
            DB::beginTransaction();
            $user = auth()->user();
            $user->update([
                'username' => $validatedData['username'],
                'phonenumber' => $validatedData['phonenumber'],
            ]);
            DB::commit();
            return view('myprofile');
        } catch (\Exception $e) {
            DB::rollBack();
            return view('myprofile');
        }
    }

    function viewAdvertisement($id){
        $car = Car::with('brand', 'condition', 'fuel', 'modell', 'transmission')
           ->where('id', $id)
           ->first();

        $extras = Extra::find($id);

        return view('advertisement', ['car'=>$car, 'extras'=>$extras]);
    }

    function deleteAdvertisement($id){
        $user = Auth::user();
        $car = Car::with('brand', 'condition', 'fuel', 'modell', 'transmission')
           ->where('id', $id)
           ->first();

        if($car->user_id == $user->id){
            unlink('storage/'.$car->picture);
            $car->delete();
            return redirect()->intended(route('main'))->with("success");
        }
        return view('advertisement', ['car'=>$car]);
    }

    public function myprofileDelete()
    {
        $user = Auth::user();
        
        $cars = $user->cars;
        foreach ($cars as $car) {
            if ($car->picture) {
                unlink('storage/'.$car->picture);
            }
        }
        $user->cars()->delete();
        $user->delete();

        return redirect()->route('login')->with('success', 'Your account and associated cars have been deleted.');
    }
} 