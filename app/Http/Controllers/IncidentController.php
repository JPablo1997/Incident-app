<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreIncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;
use App\Models\Incident;
use Illuminate\Support\Facades\Log;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [
            'status' => true,
            'incidents' => Incident::all()
        ];

        return response($response, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreIncidentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncidentRequest $request)
    {
        //Ejemplo de como validar headers en los Requests
        /*if(!$request->header('Accept')  || $request->header('Accept') != "application/json")
        {
            $response = [
                'status' => false,
                'message' => "Bad Request. The Accept header is expected to be 'application/json'."
            ];

            return response($response, 400)->header('Content-Type', 'application/json');
        }*/

        /*$validator = Validator::make($request->all(), [
            'code' => ['required', 'max:5'],
            'name' => ['required', 'max:100'],
            'description' => ['required'],
            'start_date' => ['required', 'date'],
            'finish_date' => ['required', 'date'],
            'sac_activation' => ['required', 'boolean'],
            'root_cause' => ['required'],
            'response_actions' => ['required'],
        ]);
 
        if ($validator->fails()) {
            return response()
                ->json([
                        'status' => false,
                        'message' => 'Validation errors',
                        'errors' => $validator->errors()
                    ])
                ->header('Content-Type', 'application/json');
        }*/

        $incident = Incident::create($request->all());

        $status = false;
        $message = "Hubo un error en el proceso de inserción.";

        if($incident) {
            $status = true;
            $message = "El Incidente '$incident->code' se creo correctamente.";
        }

        $response = [
            'status' => $status,
            'message' => $message
        ];

        return response($response, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function show(Incident $incident)
    {
        $response = [
            'status' => true,
            'incident' => $incident
        ];

        return response($response, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIncidentRequest  $request
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncidentRequest $request, Incident $incident)
    {
        $status = false;
        $message = "Hubo un error en el proceso de inserción.";

        if($incident->fill($request->all())->save()) {
            $status = true;
            $message = "Se actualizo el incidente '$incident->code' de forma correcta.";
        }

        $response = [
            'status' => $status,
            'message' => $message
        ];

        return response($response, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incident  $incident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Incident $incident)
    {
        $code = $incident->code;
        $incident->delete();

        $response = [
            'status' => true,
            'message' => "El Incidente '$code' se ha eliminado correctamente."
        ];

        return response($response, 200)->header('Content-Type', 'application/json');
    }
}
