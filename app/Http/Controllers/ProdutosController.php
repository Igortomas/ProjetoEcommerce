<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produto;
use File;

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
                    ->where('status', 1) //Seleciona apenas os registro ativos (Status = 1)
                    ->get();
        return view('painel-clientes.index')->with('produtos', $produtos);
    }

    /**
     * Retorna a página principal com grid de dados.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexadmin()
    {
        $produtos = DB::table('produtos')
                    ->select('id','nome', 'descricao', 'preco', 'quantidade', 'imagem')
                    ->where('status', 1) //Seleciona apenas os registro ativos (Status = 1)
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

        //Salva a imagem na pasta
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requestImage = $request->imagem;
            $name = uniqid(date('HisYmd'));
            $extension = $requestImage->extension();
            $imageName = "{$name}.{$extension}";
            $requestImage->move(public_path('img/produtos'), $imageName);
            $produto->imagem = $imageName;
        }
        try {
            if ($produto->saveOrFail()) {//salvou o produto
                return redirect('/admin/produtos')->with('success', 'Produto salvo com sucesso!');
            }
        } catch (\Throwable $e) {
            return redirect('/admin/produtos/novo')->with('error', 'Não foi possível salvar o produto' . $e->getMessage());
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
                return redirect('/admin/produto')->with('error', 'Produto não encontrado!');
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
            if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
                //Devemos excluir o arquivo antigo e salvar a nova
                if($produto->imagem != null)
                    File::delete('img/produtos/'.$produto->imagem);
                $requestImage = $request->imagem;
                $name = uniqid(date('HisYmd'));
                $extension = $requestImage->extension();
                $imageName = "{$name}.{$extension}";
                $requestImage->move(public_path('img/produtos'), $imageName);
                $produto->imagem = $imageName;
            }
            try {
                if ($produto->saveOrFail()) {
                    return redirect('/admin/produtos')->with('success', 'Produto salvo com sucesso!');
                }
            } catch (\Throwable $e) {
                return redirect('/admin/produtos/novo')->with('error', 'Não foi possível salvar o produto' . $e->getMessage());
            }
        } else {
            return redirect('/admin/produtos')->with('error', 'Não foi possível salvar o produto.' . ' Erro: Registro não encontrado.');
        }
    }

    /**
     * Desativa o registro informado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (isset($produto)) {
            $produto->status = "0";
            try {
                if ($produto->saveOrFail()) {
                    return redirect('/admin/produtos')->with('success', 'Produto salvo com sucesso!');
                }
            } catch (\Throwable $e) {
                return redirect('/admin/produtos/novo')->with('error', 'Não foi possível salvar o produto' . $e->getMessage());
            }
        } else {
            return redirect('/admin/produtos')->with('error', 'Não foi possível salvar o produto.' . ' Erro: Registro não encontrado.');
        }
    }
}
