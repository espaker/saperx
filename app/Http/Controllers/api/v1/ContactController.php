<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\v1\ContactsResource;
use App\Models\Contact;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    use HttpResponses;

    /**
         * @OA\Get(
         *     path="/contacts",
         *     summary="Get a list of contacts",
         *     tags={"Contacts"},
         *     @OA\Response(response=200, description="Successful operation"),
         *     @OA\Response(response=400, description="Invalid request")
         * ) 
    */
    public function index()
    {
        return ContactsResource::collection(Contact::all());
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
            'document' => 'required|cpf',
            'phones' => 'required|array|min:1',
            'phones.*' => 'phone:BR',
        ]);

        if ($validator->fails()) return $this->errorResponse($validator->errors(), 400);

        $stored = Contact::create($request->all());

        if ($stored) return $this->successResponse([], 201);
        else return $this->errorResponse('Erro ao salvar contato.', 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return new ContactsResource($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email',
            'birthday' => 'date',
            'document' => 'cpf',
            'phones' => 'array|min:1',
            'phones.*' => 'phone:BR',
        ]);

        if ($validator->fails()) return $this->errorResponse($validator->errors(), 400);

        $updated = $contact->update($request->all());

        if ($updated) return $this->successResponse([], 200);
        else return $this->errorResponse('Erro ao atualizar contato.', 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $deleted = $contact->delete();

        if ($deleted) return $this->successResponse([], 200);
        else return $this->errorResponse('Erro ao deletar contato.', 500);
    }
}
