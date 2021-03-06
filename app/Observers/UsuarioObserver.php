<?php

namespace App\Observers;

use App\Models\Usuario;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UsuarioObserver
{
    protected $usuario = null;
    protected $anonimo =null;
    public function __construct(Request $request)
    {
        $user = Auth::user();
        //$anonimo = $request['nombre'];
        if(is_null($user))
            $this -> anonimo = $request['nombre'];
        else
            $this -> usuario= $user -> nombre;
    }

    /**
     * Handle the Usuario "created" event.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return void
     */
    public function created(Usuario $usuario)
    {
        $user = Auth::user();
        
        if(is_null($user)){
            $registroA = Bitacora::create([
                'quien' => $this->anonimo,
                'usuario_id'=>$usuario->id,
                'accion' =>'Se registro',    
                'que' => $usuario->toJson()
            ]);
        }else{
            $registro = Bitacora::create([
                'quien' => $this->usuario,
                'usuario_id'=>$usuario->id,
                'accion' =>'Creo usuario',
                'que' => $usuario->toJson()
            ]);
        }
    }

    /**
     * Handle the Usuario "updated" event.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return void
     */
    public function updated(Usuario $usuario)
    {
        
        $user = Auth::user();
        if(is_null($user)){
            
        }else{
            $registro = Bitacora::create([
                'quien' => $this->usuario,
                'usuario_id'=>$usuario->id,
                'accion' =>'Actualizó datos',
                'que' => $usuario->toJson()
            ]);
        }
        
    }

    /**
     * Handle the Usuario "deleted" event.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return void
     */
    public function deleted(Usuario $usuario)
    {
        $registro = Bitacora::create([
            'quien' => $this->usuario,
            'usuario_id'=>$usuario->id,
            'accion' =>'Eliminó datos usuario',
            'que' => $usuario->toJson()
        ]);
    }

    /**
     * Handle the Usuario "restored" event.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return void
     */
    public function restored(Usuario $usuario)
    {
        //
    }

    /**
     * Handle the Usuario "force deleted" event.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return void
     */
    public function forceDeleted(Usuario $usuario)
    {
        //
    }
}
