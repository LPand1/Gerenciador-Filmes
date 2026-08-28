<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function index() {
        $filmes = Filme::all();

        // dd($filmes);

        return view('filme.index', [
            'filmes' => $filmes,
        ]);
    }

    public function create(Request $request) {
        if ($request->isMethod('post')) {
            $dados = $request->validate([
                'titulo' => 'required|min:1|max:255',
                'sinpopse' => 'nullable|min:1|max:1000',
                'ano' => 'required|integer',
                'categoria_id' => 'required|integer',
                'imagem_capa' => 'nullable|image',
                'link_trailer' => 'required|min:1|max|255',
            ]);

            if ($request->hasFile('imagem')) {
                $dados['imagem'] = $request->file('imagem')->store('imagens', 'public');
            }

            Filme::create($dados);

            return redirect()->route('filme.index')->with('mensagem', 'Filme salvo');
        }

        return view('filme/create');
    }

    public function delete(Filme $filme) {
        if (request()->isMethod('delete')) {
            $filme->timestamps = false;
            $filme->delete();

            return redirect()->route('filme.index')->with('mensagem', 'Filme excluído com sucesso');
        }

        return view('filme.delete', [
            'filme' => $filme,
        ]);
    }

    public function edit(Request $request, Filme $filme) {
        if ($request->isMethod('put')) {
            $dados = $request->validate([
                'titulo' => 'required|min:1|max:255',
                'sinpopse' => 'nullable|min:1|max:1000',
                'ano' => 'required|integer',
                'categoria_id' => 'required|integer',
                'imagem_capa' => 'nullable|image',
                'link_trailer' => 'required|min:1|max|255',
            ]);

            if ($request->hasFile('imagem')) {
                if ($filme->imagem) {
                    \Storage::disk('public')->delete($filme->imagem);
                }

                $dados['imagem'] = $request->file('imagem')->store('imagens', 'public'); 
            }

            $filme->update($dados); 
            return redirect()->route('filme.index')->with('mensagem', 'Filme atualizado com sucesso');
        }

        return view('item/create', [
            'filme' => $filme,
        ]);
    }

    public function trash() {
        $filmes = Filme::onlyTrashed()->get();

        return view('filme.trash', [
            'filmes' => $filmes,
        ]); 
    }

    public function restore(Filme $filme) {
        $filme->timestamps = false;
        $filme->restore();
        
        return redirect()->route('filme.index')->with('mensagem', 'Filme restaurado com sucesso');
    }

    public function deleteDefinitivo(Filme $filme) {
        if (request()->isMethod('delete')) {
            if ($filme->imagem) {
                \Storage::disk('public')->delete($filme->imagem);
            }

            $filme->forceDelete();

            return redirect()->route('filme.trash')->with('mensagem', 'Filme excluído permanentemente');
        }

        return view('filme.deleteDefinitivo', [
            'filme' => $filme,   
        ]);
    }
 }
