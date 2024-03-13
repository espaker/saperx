<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ContactsResource;
use App\Models\Contacts as ModelsContacts;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Contacts extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContactsResource::collection(ModelsContacts::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'birthday' => 'required|date',
            'document' => 'required|string',
            'phones' => 'required|array|min:1',
            'phones.*' => 'string',
        ]);

        if ($validator->fails()) return $this->errorResponse($validator->errors(), 400);

        $stored = ModelsContacts::create($request->all());

        if ($stored) return $this->successResponse([], 201);
        else return $this->errorResponse('Erro ao salvar contato.', 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ContactsResource(ModelsContacts::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
