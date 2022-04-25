<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $cadastrados = [
        [
            'id' => 1,
            'name' => 'Emilio',
            'email' => 'emilio@gmail.com',
            'password' => '123456',
            'userName' => 'emilio12',
        ],
        [
            'id' => 2,
            'name' => 'Roberta',
            'email' => 'roberta@gmail.com',
            'password' => '123456',
            'userName' => 'roberta152',
        ],
        [
            'id' => 3,
            'name' => 'Roseli',
            'email' => 'roseli@gmail.com',
            'password' => '123456',
            'userName' => 'roseli2109',
        ],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            $this->cadastrados
        ]);
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
        if($request->name && $request->userName && $request->email && $request->password){

            if(!in_array($request->userName, $this->cadastrados) || in_array($request->email, $this->cadastrados)){
                return response()->json([
                    'success' => false,
                    'error' => 'Usuário já cadastrado com esse nome de usuário ou email',
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Usuário cadastrado com sucesso',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cadastrados = (object) $this->cadastrados;

        $item = $cadastrados->where('id', $id);
        unset($item->password);
        return response()->json([
            'success' => true,
            $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cadastrados = (object) $this->cadastrados;

        $item = $cadastrados->where('id', $id);
        if(!in_array($request->userName, $this->cadastrados)){
            $item = $request->all();
        }

        return response()->json([
            'success' => true,
            $item
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (($key = array_search($id, $this->cadastrados)) !== false) {
            unset($this->cadastrados[$key]);

            return response()->json([
                'success' => true,
                'message' => 'Usuário removido com sucesso.'
            ]);
        }
    }
}
