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
	public $datas;
	public function __construct(){
		$this->datas = User::paginate(5);
	}
	
	public function welcomeView($log = null){
		
    	$datas = $this->datas;
    	if(isset($log)){
			return redirect('/')->with('datas', $datas)->with('messages', $log);
    	}else{
			return view('welcome')->with('datas', $datas);
    	}
  
	}
	public function verifyData($request){
		$name = $request['first_name'];
		$lastName = $request['first_name'];
		$age = $request['age'];
		if(!ctype_alpha($name) || !ctype_alpha($lastName) || $age <= 0)
		{
			return true;
		}
		return false;

	}
	public function createUserReturn($request){
		if(User::create($request->all())){
			return back()->with('message', 'Cadastro do usuario '.$request['first_name'].' feito com sucesso')->with('datas',$this->datas); 			
		}else{
			return back()->with('error', 'Erro ao cadastrar usuario '.$request['first_name'])->with('datas',$this->datas);	
		}
	}

	public function registerUser($request){
		$has_data_fail = $this->verifyData($request);
		$has_empty_key = false;
		foreach ($request->all() as $key => $value) {
			if($request[$key] != '_token') continue;
			if( isset( $request[$key] ) ) {
				$has_empty_key = true;
				break;
			}
		}
		if($has_empty_key == false && $has_data_fail == false)
		{
			return $this->createUserReturn($request);
		}	
		
		return back()->with('error', 'Erro ao cadastrar usuario, por favor preencher todos os campos')->with('datas',$this->datas);
			
	
	}

    public function controlUser(Request $request, $edit = null){
    	try{
			$cad = $request['register'];
			if($cad == 1){
				return $this->registerUser($request);
			}
    	}catch(exception $e){
			return back()->with('error', 'Erro ao cadastrar usuario '.$name)->with('datas',$this->datas);
    	}

    }

    public function editUser($id){
    	$find = User::where('id', $id)->first();
    	return view('editing')->with('find',$find);
    }

	public function verifyDatasToEdit($data, $request){
		$log = [];
		foreach ($request as $key => $value) {
			if ($key != '_token'){
				if ($request[$key] == $data[$key]){
					continue;
				}
				$data[$key] = $value;
				$log[] = ucfirst($key)." alterado para $value";
			}
		}
		$log = empty($log) ? ['Nenhum dado atualizado'] : $log; 
		$data->save();
		return $log;
		
	}

    public function dataEdited(Request $request){
    	try {
	    	$data = User::where('id', $request['id'])->first();

	    	$response = $this->verifyDatasToEdit($data, $request->all());
	    	
	    	$data = User::paginate(5);
	    	
	    	return redirect('controluser')->with('data', $data)->with('messages',$response);

    	} catch (Exception $e) {
    		$log[] = 'Erro ao Editar usuario, erro '.$e;
	    	return view('editing')->with('find', $data)->with('messages',$log);
    	}
    }

    public function remove($id){
    	try {
	    	$log = [];
	    	$data = User::where('id', $id)->first();
	    	$data->delete();
	    	$data = User::paginate(5);
	    	return back()->with('message', 'Usuario removido com sucesso')->with('datas',$this->datas);
    		
    	} catch (Exception $e) {
    		return back()->with('error', 'Erro ao remover usuario '.$name)->with('datas',$this->datas);
    	}
    }

}
