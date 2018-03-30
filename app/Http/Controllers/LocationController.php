<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::nested()->get();

        if(!$locations){
            return response()->json(['code' => 204, 'message' => 'No hay Locaciones'], 204);
        }
        return response()->json(['data'=> $locations], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $existe = Location::where("slug","=", $request->slug)->first();

        if($existe){
            return response()->json(['code' => 409, 'message' => 'Ya existe la Locación'], 409);
        }
        else{
                $locations = Location::create($request->all());

                return response()->json(['data' => $locations, 'message' => 'Locación Creada con exito', 'code' => 200], 200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getChilds($id)
    {
        $existe = Location::where("id","=", $id)->first();

        if($existe){        
                 $childs = Location::parent($id)->renderAsArray();
                    if(!sizeof($childs)){
                        return response()->json(['code' => 409, 'message' => 'Esta Locación no tiene hijos'], 409);
                    }else{
                         return response()->json(['data'=> $childs], 200);
                    }
        }else{
             return response()->json(['code' => 409, 'message' => 'No hay Locaciones'], 409);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($slug)
    {
       
        $result = Location::like('slug', $slug)->get();
        
        if(sizeof($result))
            return response()->json(['data'=> $result], 200);
        else
            return response()->json(['code' => 409, 'message' => 'Sin coincidencias'], 409);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existe = Location::where("id","=", $id)->first();

        if($existe){

            $ids = Location::parent($id)->renderAsArray();

            foreach($ids as $key=>$value) {
                Location::destroy($ids[$key]['id']); //delete childs
            }
            Location::destroy($id); //delete parent

            return response()->json(['message' => 'Locación Borrada con exito', 'code' => 200], 200);

        }else{
            return response()->json(['code' => 409, 'message' => 'Locacion no existe'], 409);
        }
    }
}
