<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produto;

class ProdutosController extends Controller
{
    /**
     * Retorna a página principal com grid de dados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = DB::table('produtos')
                    ->select('id','nome', 'descricao', 'preco', 'quantidade', 'imagem')
                    ->get();
        return view('painel-admin.index')->with('produtos', $produtos);
    }

    /**
     * Abre a tela para inserir novo registro
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->produto = new Produto();
        return view('painel-admin.cadastro')->with('produto', $this->produto);
    }

    /**
     * Salva o registro criado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = new Produto(); //criando o produto
        $produto->nome = $request->input('nome');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        $produto->quantidade = $request->input('quantidade');

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

    /**
     * Abre um registro para edição.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        {
            $produto = Produto::find($id);
            if (isset($produto)) {
                return view('painel-admin.cadastro')->with('produto', $produto);
            } else {
                return redirect('/produto')->with('error', 'Produto não encontrado!');
            }
        }
    }

    /**
     * Salva a edição do registro
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if (isset($produto)) {
            $produto->nome = $request->input('nome');
            $produto->descricao = $request->input('descricao');
            $produto->preco = $request->input('preco');
            $produto->quantidade = $request->input('quantidade');
    
            try {
                if ($produto->saveOrFail()) {
                    return redirect('/produtos')->with('success', 'Produto salvo com sucesso!');
                }
            } catch (\Throwable $e) {
                return redirect('/produtos/novo')->with('error', 'Não foi possível salvar o produto' . $e->getMessage());
            }
        } else {
            return redirect('/produtos')->with('error', 'Não foi possível salvar o produto.' . ' Erro: Registro não encontrado.');
        }
    }
}
