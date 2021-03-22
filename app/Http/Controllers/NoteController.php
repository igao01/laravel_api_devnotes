<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function read ($id) {
        $array = ['error'=>''];

        $note = Note::find($id);

        if($note) {
            $array['data'] = $note;
        } else {
            $array['error'] = "A anotação não existe no banco de dados";
        }
        return $array;
    }
}
