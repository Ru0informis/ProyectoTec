<?php

namespace App\Policies;

use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UsuariosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function viewAny(Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function view(Usuario $usuario)
    {
    
    }
    public function show(Usuario $usuario)
    {
        if($usuario->rol == "Cliente" || $usuario->rol == "Contador"  ) return false;
        if($usuario->rol == "Supervisor" || $usuario->rol == "Encargado") return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function create(Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function update(Usuario $usuario1, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function delete(Usuario $usuario1, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function restore(Usuario $usuario1, Usuario $usuario)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function forceDelete(Usuario $usuario1, Usuario $usuario)
    {
        //
    }
}
