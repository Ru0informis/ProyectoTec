<?php

namespace App\Observers;

use App\Models\Usuario;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;
class UsuarioObserver
{
    protected $usuario = null;

    public function __construct()
    {
        $user = Auth::user();
        if(is_null($user))
            $this -> usuario = 'Anonimo';
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
        $registro = Bitacora::create([
            'quien' => $this->usuario,
            'accion' =>'Creo usuario',
            'que' => $usuario->toJson()
        ]);
    }

    /**
     * Handle the Usuario "updated" event.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return void
     */
    public function updated(Usuario $usuario)
    {
        $registro = Bitacora::create([
            'quien' => $this->usuario,
            'accion' =>'Actualizó datos usuario',
            'que' => $usuario->toJson()
        ]);
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
