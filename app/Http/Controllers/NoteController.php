<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Note;

class NoteController extends Controller
{
    //EXIBE TODAS AS NOTAS
    public function list() {
        $array = ['error' => '', 'data' => []];

        $notes = Note::select()->get();

        if(count($notes) > 0) {
            $array['data'] = $notes;
        } else {
            $array['error'] = "Não há anotações ainda";
        }
        return $array;
    }

    //EXIBE DETALHES DE UMA ANOTACAO
    public function read($id) {
        $array = ['error'=>''];

        $note = Note::find($id);

        if($note) {
            $array['data'] = $note;
        } else {
            $array['error'] = "A anotação não existe no banco de dados";
        }
        return $array;
    }

    //CRIA UMA NOVA ANOTAÇÃO
    public function create(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        if(!$validator->fails()) {
            $title = $request->input('title');
            $body = $request->input('body');

            $newNote = new Note();
            $newNote->title = $title;
            $newNote->body = $body;
            $newNote->save();
            $array['created'] = true;

        } else {
            $array['created'] = false;
            $array['error'] = "Por Favor preencha todos os campos";
        }
        return $array;
    }

    //ATUALIZA UMA ANOTAÇÃO
    public function update(Request $request, $id) {
        $array = ['error' => ''];

        $rules = [
            'title' => 'required',
            'body' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $array['updated'] = false;
            $array['error'] = "Por favor preencha todos os campos";
            return $array;
        }
        $title = $request->input('title');
        $body = $request->input('body');

        $note = Note::find($id);

        if(!$note) {
            $array['updated'] = false;
            $array['error'] = "A anotação não foi encontrada no banco de dados";
            return $array;
        }

        if($title) {
            $note->title = $title;
        }

        if($body) {
            $note->body = $body;
        }
        
        $note->save();
        $array['updated'] = true;
        return $array;
    }

    //DELETA UMA ANOTAÇÃO
    public function del($id) {
        $array = ['error' => ''];

        $note = Note::find($id);

        if($note) {
            $note->delete();
            $array['deleted'] = true;

        } else {
            $array['error'] = "Esta anotação não existe";
            $array['deleted'] = false;
        }
        return $array;
    }
}
