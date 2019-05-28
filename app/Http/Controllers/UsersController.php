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
	public function welcomeView($log = null){
		//dd($log);
		$datas = User::get();
    	$datas = User::paginate(5);
    	//dd($log);
    	if(isset($log)){
			return redirect('/')->with('datas', $datas)->with('messages', $log);
    	}else{
			return view('welcome')->with('datas', $datas);
    	}
  
	}
    public function controlUser(Request $request, $edit = null){
    	//dd('a');
    	try{
    		$datas = User::paginate(5);
	    	$name = $request['firstName'];
	    	$lastName = $request['lastName'];
	    	$gender = $request['gender'];
			$age = $request['age'];
			$cad = $request['register'];
			$edit = $request['edit'];
			if($cad == 1){
				if(isset($name) && isset($lastName) && isset($age)){
					if(ctype_alpha($name) || ctype_alpha($lastName) || $age >= 0){
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
							return back()->with('error', 'Erro ao cadastrar usuario '.$name.' por favor inserir apenas letras alfabeticas e idade valida')->with('datas',$datas);	
						}	
				}else{
					return back()->with('error', 'Erro ao cadastrar usuario, por favor preencher todos os campos')->with('datas',$datas);
				}
			}
    	}catch(exception $e){
    			return back()->with('error', 'Erro ao cadastrar usuario '.$name)->with('datas',$datas);
    	}

    }

    public function editUser($id){
    	$find = User::where('id', $id)->first();
    	return view('editing')->with('find',$find);
    }

    public function datasEdited(Request$request){
    	try {
	    	$id = $request['id'];
	    	$editedName = $request['first_name'];
	    	$editedLastName = $request['last_name'];
	    	$editedGender = $request['gender'];
			$editedAge = $request['age'];
	    	$datas = User::where('id', $id)->first();
	    	$find = User::where('id', $id)->first();
	    	$log = [];
	    	if(ctype_alpha($editedName) && ctype_alpha($editedLastName)){
		    	if($editedName != $datas->first_name){
		    		$datas->first_name = $editedName;
		    		$log[] ='Nome alterado para '.$editedName;
		    	}else{
		    		$log[] = 'O nome não foi alterado';
		    	}
		    	if($editedLastName != $datas->last_name){
		    		$datas->last_name = $editedLastName;
		    		$log[] ='Sobrenome alterado para '.$editedLastName;
		    	}else{
		    		$log[] = 'O sobrenome não foi alterado';
		    	}
		    	if($editedGender != $datas->gender){
		    		$datas->gender = $editedGender;
		    		$log[] ='Genero alterado para '.$editedGender;
		    	}else{
		    		$log[] = 'Genero não foi alterado';
		    	}
		    	if($editedAge != $datas->age){
		    		$datas->age = $editedAge;
		    		$log[] ='Idade alterada para '.$editedAge;
		    	}else{
		    		$log[] = 'A Idade não foi alterada';
		    	}	    		
	    	}else{
	    		$log[] = 'Nome e Sobrenome deve conter apenas letras';
	    		$datas = User::paginate(5);
	    		return view('editing')->with('find', $find)->with('messages',$log);
	    	}

	    	$datas->save();
	    	$datas = User::paginate(5);
	    	
	    	return redirect('controluser')->with('data', $datas)->with('messages',$log);
	    	// return redirect('/')->with('messages',$log)->with('datas',$datas);
	    	
    		
    	} catch (Exception $e) {
    		$log[] = 'Erro ao Editar usuario, erro '.$e;
	    	return view('editing')->with('find', $find)->with('messages',$log);
    	}
    }

    public function remove($id){
    	try {
	    	$log = [];
	    	$datas = User::where('id', $id)->first();
	    	$datas->delete();
	    	$datas = User::paginate(5);
	    	return back()->with('message', 'Usuario removido com sucesso')->with('datas',$datas);
    		
    	} catch (Exception $e) {
    		return back()->with('error', 'Erro ao remover usuario '.$name)->with('datas',$datas);
    	}
    }

    public function QuestaoDois()
    {	
    	$s = 'aeiaaioooau';
    	$words = str_split($s);
    	//dd($words);
    	$i = 0;
    	$ret = 0;
    	$has = false;

    	foreach ($words as $w) {
    		if($w == $s[$i]){
    			$ret++;
    		}else if($w == $s[$i +1]){
    			$ret++;
    			$i++;
    		}
    	}
    	if($has){
        return $ret;	
		}else{
			return 0;
		}
    }
}
