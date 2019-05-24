<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\User;

class UsersController extends Controller
{
	public function welcomeView(){
    	$datas = User::paginate(5);

		return view('welcome')->with('datas', $datas);
	}
    public function controlUser(Request $request){
    	//dd($request);
    	try{
    		$datas = Users::get();
			$datas = $datas->paginate(5);
	    	$name = $request['firstName'];
	    	$lastName = $request['lastName'];
	    	$gender = $request['gender'];
			$age = $request['age'];
			$cad = $request['cadastro'];
			if($cad == 1){
				if(isset($name)||isset($lastName) || isset($age)){
					$register = new User;
					$register->first_name = $name;
					$register->last_Name = $lastName;
					$register->age = $age;
					$register->gender = $gender;
					if($register->save()){
						return back()->with('message', 'Cadastro do usuario '.$name.' feito com sucesso')->with('datas',$datas); 			
					}else{
						return back()->with('error', 'Erro ao cadastrar usuario '.$name)->with('datas',$datas); 							
					}	
				}else{
					return back()->with('error', 'Erro ao cadastrar usuario, por favor preencher todos os campos')->with('datas',$datas);
				}
			}
			else if($edit == 1){
				
			}
    	}catch(exception $e){
    			return back()->with('error', 'Erro ao cadastrar usuario '.$name)->with('datas',$datas);
    	}

    }
}
