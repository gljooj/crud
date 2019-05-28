<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

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

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }


            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                        Editando
                </div>
                <div>
                    @if(isset($messages))
                    <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach($messages as $message)
                    {{$message}}<br>
                    @endforeach
                    </div>
                    @endif
                </div>
                       
                       <div>
                            <form method="post" id="edit">
                                {{ csrf_field() }}
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a>{{$find->id}}</a></td><input type="text" name="id" value="{{$find->id}}" hidden>
                                                <td><a><input type="text" name="first_name" value="{{$find->first_name}}"></a></td>
                                                <td><a><input type="text" name="last_name" value="{{$find->last_name}}"></a></td>
                                                <td><select name="gender" >
                                                        <option value="Feminino"  @if($find->gender == "Feminino") selected @endif>Feminino</option>
                                                        <option value="Masculino" @if($find->gender == "Masculino") selected @endif>Masculino</option>
                                                    </select></input></a></td>
                                                <td><a><input type="number" name="age" value="{{$find->age}}"></a></td>

                                                <td><button type="button" onclick="editAlert();">Confirmar</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                       <div class="position-ref" style="right: 30px"><button type="button" onclick="voltarAlert();">Voltar</button></div> 
                       </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function editAlert(){
        if (confirm("Tem certeza que deseja salvar ?"))
          {
            document.getElementById("edit").action = "/controluser/datasEdited";
            document.getElementById("edit").submit();
          }
    }
    function voltarAlert(){
        if (confirm("Tem certeza que deseja voltar ?"))
          {
                     javascript:history.back();
          }
    }
</script>