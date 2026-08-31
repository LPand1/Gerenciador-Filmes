<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index() {
        $categorias = Categoria::all();

        return view('categoria.index', [
            'categorias' => $categorias,
        ]);
    }

    public function create(Request $request) {
        if ($request->isMethod('post')) {
            $dados = $request->validate([
                'nome' => 'required|min:1|max:255',
            ]);

            Categoria::create($dados);

            return redirect()->route('categoria.index')->with('mensagem', 'Categoria salva');
        }

        return view('categoria.create');
    }

    public function delete(Categoria $categoria) {
        if (request()->isMethod('delete')) {
            $categoria->timestamps = false;
            $categoria->delete();

            return redirect()->route('categoria.index')->with('mensagem', 'Categoria excluída com sucesso');
        }

        return view('categoria.delete', [
            'categoria' => $categoria,
        ])
    }
    
    public function edit(Request $request, Categoria $categoria) {
        if ($request->isMethod('put')) {
            $dados = $request->validate([
                'nome' => 'required|min:1|max:255',
            ]);

            $categoria->update($dados);
            return redirect()->route('categoria.index')->with('mensagem', 'Categoria atualizada com sucesso');
        }

        return view('categoria.edit', [
            'categoria' => $categoria,
        ]);
    }

    public function trash() {
        $categorias = Categoria::onlyTrashed()->get();

        return view('categoria.trash', [
            'categorias' => $categorias,
        ]);
    }

    public function restore(Categoria $categoria) {
        $categoria->timestamps = false;
        $categoria->restore();

        return redirect()->route('categoria.index')->with('mensagem', 'Categoria restaurada com sucesso');
    }

    public function deleteDefinitivo(Categoria $categoria) {
        if (request()->isMethod('delete')) {
            if ($categoria->filmes()->withTrashed()->exists()) {
                return redirect()->route('categoria.trash')->with('erro',
                    'Não é possível excluir: existem filmes vinculados a essa categoria');
            }

            $categoria->forceDelete();
            
            return redirect()->route('categoria.trash')->with('mensagem', 'Categoria excluída permanentemente');
        }

        return view('categoria.deleteDefinitivo', [
            'categoria' => $categoria,
        ]);
    }
}