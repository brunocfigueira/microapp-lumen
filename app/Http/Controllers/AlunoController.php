<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AlunoService;
use App\Exceptions\BusinessException;
use App\Http\Traits\MessagesTraits as Messages;

class AlunoController extends Controller
{
    use Messages;
    private $AlunoService;
    public function __construct(AlunoService $AlunoService)
    {
        $this->AlunoService = $AlunoService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        //return response()->json(['Alunos' => $this->AlunoService->findAll()], 200);
        return responder()->success(['Alunos' => $this->AlunoService->findById(921839)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aluno  $Aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $Aluno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aluno  $Aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $Aluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aluno  $Aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $Aluno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aluno  $Aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $Aluno)
    {
        try {
            $this->service->delete($Aluno->id);
            $message = $this->service->msgSuccessDeleted(trans('menu.model'));
            return response()->json(['success' => true, 'message' => $message], 200);
        } catch (BusinessException $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()], 200);
        }
    }
}
