<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html><html lang='pt-br'>
    <head>
        <title>Teste CEA</title>

        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'><script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
        <style class="cp-pen-styles">

        </style>
    </head>
    <body>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
        <div class="container">
            <div class="row col-md-6 col-md-offset-2 custyle">
            <table class="table table-striped custab">
                <thead>
                    <a href="/admin/produtos/novo" class="btn btn-primary btn-xs pull-right"><b>+</b> Adicionar novo produto</a>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Imagem</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td><img src="{{asset("img/produtos/{$produto->imagem}")}}" height="50" width="50"></td>
                        <td class="text-center">
                            <a href="/admin/produtos/edit/{{ $produto->id }}" class='btn btn-info btn-xs'>
                            <span class="glyphicon glyphicon-edit"></span> Editar</a>
                            <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" data-original-title="Excluir" class="action-icon-Left" onclick="confirmaRota('Deseja mesmo apagar o produto {{ $produto->nome }}?','/admin/produtos/apagar/{{ $produto->id }}','Ao confirmar irá apagar o produto.')"> 
                            <span class="glyphicon glyphicon-remove"></span> Deletar</a>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
            </div>
        </div>
        @component('components.alert_confirmation_route')
        @endcomponent
        <script >

        </script>
    </body>
</html>