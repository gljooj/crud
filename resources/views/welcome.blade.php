<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <script>

    
        function removeAlert(id){
            if (confirm("Tem certeza que deseja excluir ?"))
              {
                document.getElementById("edit").action = "/controluser/remove/"+id;
                document.getElementById("edit").submit();
              }
        }
    
    function mostra(id) {
        some();
        document.getElementById(id).style.display = 'inline';
    }
    
    function some() {
        document.getElementById("ma").style.display = 'none';
        document.getElementById("mb").style.display = 'none';
        //document.getElementById("mc").style.display = 'none';
        
    }
    </script>
    <!-- Fonts -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .hidden{
                display: none;
            }
        
            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    O que deseja?
                </div>
                <div>
                    <input type="radio" value="cadastrar" onclick="mostra('ma')" name="type"> Cadastrar
                    <input type="radio" value="editar" onclick="mostra('mb')" name="type"/> Listar Funcionarios, editar e remover
                </div>
                    
                @if(session('message'))
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{session('message')}}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{session('error')}}
                </div>
                @endif

                @if(session('messages'))
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                @foreach(session('messages') as $message)
                {{$message}}<br>
                @endforeach

                </div>
                @endif
                      
                <div>
                    <form method="post" id="regis">
                        {{ csrf_field() }}
                    <div id="ma" class="hidden">
                        <div class="row text-left flex-center position-ref">
                            <div class="col-md-2 ">
                                    <label for="name" value="first_name">Nome</label>    
                            </div>
                            <div class="col-md-5">
                                    <input type="text" name="first_name">
                            </div>
                        </div>

                        <div class="row text-left flex-center position-ref">
                            <div class="col-md-2 ">
                                <label for="lastName" value="last_name">Sobrenome</label>  
                            </div>
                            <div class="col-md-5">
                               <input type="text" name="last_name">
                            </div>
                        </div>

                        <div class="row text-left flex-center position-ref">
                            <div class="col-md-2 ">
                                <label for="age" value="age">Idade</label>
                            </div>
                            <div class="col-md-5">
                               <input type="number" name="age">
                            </div>
                        </div>

                        <div class="row text-left flex-center position-ref">
                            <div class="col-md-2 ">
                                <label>sexo</label>
                            </div>
                            <div class="col-md-5">
                               <select name="gender">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                                <input name="register" type="hidden" value="1">

                            </div>
                        </div>
                        <button type="submit" formaction="/controluser/controlUser">Cadastrar</button>
                    </div>
                    </form>
                    
                    <form method="get" id="edit">
                        <div id="mb" class="hidden">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nome</th>
                                        <th>Sobrenome</th>
                                        <th>Genero</th>
                                        <th>Idade</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datas as $data)
                                    <tr>
                                        <td><a>{{$data->id}}</a></td>
                                        <td><a>{{$data->first_name}}</a></td>
                                        <td><a>{{$data->last_name}}</a></td>
                                        <td><a>{{$data->gender}}</a></td>
                                        <td><a>{{$data->age}}</a></td>
                                        <td><button type="submit"  formaction="/controluser/editUser/{{$data->id}}">Editar</button></td>
                                        <td><button type="button" onclick="removeAlert('{{$data->id}}')">Remover</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$datas->render()}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
