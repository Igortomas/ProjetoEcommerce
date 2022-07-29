<?php

namespace App\Http\Controllers;

use App\FunctionsGeneric\Functions;
use App\Models\usuario;
use App\Models\produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    private $cliente;

    /**
     * Abre a tela para inserir novo registro
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->usuario = new Usuario();
        return view('cadastro')->with('usuario', $this->usuario);
    }

    /**
     * Retorna dados para tela de consulta
     * @return Json com array de dados.
     */
    public function login(Request $request)
    {
        $usuario = $request->input('usuario');
        $senha = $request->input('senha');

        $usuarios = usuario::where('usuario', '=', $usuario)->where('senha', '=', $senha)->first();

        if(@$usuarios->id != null){

            @session_start();
            $_SESSION['id_usuario'] = $usuarios->id;
            $_SESSION['nome_usuario'] = $usuarios->nome;
            $_SESSION['cpf_usuario'] = $usuarios->cpf;
            $_SESSION['cep_usuario'] = $usuarios->cep;
            $_SESSION['endereco_usuario'] = $usuarios->endereco;
            $_SESSION['numero_usuario'] = $usuarios->numero;
            $_SESSION['nivel_usuario'] = $usuarios->nivel;

            if($_SESSION['nivel_usuario'] == '1'){
                $produtos = DB::table('produtos')
                    ->select('id', 'nome', 'descricao', 'preco', 'quantidade', 'imagem')
                    ->get();

                return view('painel-admin.index')->with('produtos', $produtos);
            }else if($_SESSION['nivel_usuario'] == '0'){
                $produtos = DB::table('produtos')
                    ->select('id', 'nome', 'descricao', 'preco', 'quantidade', 'imagem')
                    ->get();

                return view('painel-clientes.index')->with('produtos', $produtos);
            }
        }else{
            echo "<script language='javascript'> window.alert('Dados Incorretos!') </script>";
            return view('index');
        }
    }

    public function logout(){
        @session_start();
        @session_destroy();
        return view('index');
    }

    /**
     * Salva o registro criado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario(); //criando o produto
        $usuario->usuario = $request->input('usuario');
        $usuario->senha = $request->input('senha');
        $usuario->email = $request->input('email');
        $usuario->nome_completo = $request->input('nome_completo');
        $usuario->cpf = $request->input('cpf');
        $usuario->cep = $request->input('cep');
        $usuario->endereco = $request->input('endereco');
        $usuario->numero = $request->input('numero');
        $usuario->telefone = $request->input('telefone');

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requestImage = $request->imagem;
            $name = uniqid(date('HisYmd'));
            $extension = $requestImage->extension();
            $imageName = "{$name}.{$extension}";
            $requestImage->move(public_path('img/produtos'), $imageName);
            $produto->imagem = $imageName;
        }else{
            return redirect('/produtos/novo')->with('error', 'Imagem não encontrada!');
        }
        try {
            if ($produto->saveOrFail()) {//salvou o produto
                return redirect('/produtos')->with('success', 'Produto salvo com sucesso!');
            }
        } catch (\Throwable $e) {
            return redirect('/produtos/novo')->with('error', 'Não foi possível salvar o produto' . $e->getMessage());
        }
    }

}