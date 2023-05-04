<?php

namespace App\Http\Livewire;


//use App\Post as Post;

use App\Models\Post;
use Livewire\Component;


class Postslive extends Component
{
    public $posts, $title, $description, $selected_id, $updateMode;
    public $modal = false;
    public $is_edit = false;
    public ?Post $post;
    protected $rules = [
        "post.title" => 'required',
        "post.description"=> 'required'
    ];

    public function mount()
    {
    }

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.list')
            ->extends('layouts.app');
    }

    public function crear()
    {
        //dd(1);
        $this->limpiarCampos();
        $this->abrirModal();
    }

    public function abrirModal()
    {

        $this->modal = true;
    }

    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function limpiarCampos()
    {
        $this->post = new Post();
    }

    public function guardar()
    {
        $this->post->user_id=auth()->user()->id;
        $this->post->save();
        session()->flash(
            'message',
            $this->id ? '¡Actualización exitosa!' : '¡Alta Exitosa!'
        );

        $this->cerrarModal();
        $this->limpiarCampos();
    }


    private function resetInput()
    {
        $this->post = new Post();            
    }


    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required|body:rfc,dns'
        ]);
        $this->post->save();
        $this->resetInput();
    }

    public function edit($id)
    {
        $this->post = Post::findOrFail($id);
      
    }
   


    public function destroy($id)
    {
        if ($id) {
            $record = Post::where('id', $id);
            $record->delete();
        }
    }
}
