<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoriaPolicy
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
     * @param  \App\Models\Categoria  $categoria
     * @return mixed
     */
    public function view(Usuario $usuario, Categoria $categoria)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return mixed
     */
    public function create(Usuario $usuario)
    {
        if($usuario->rol == "Cliente") return false;
        if($usuario->rol == "Supervisor") return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Categoria  $categoria
     * @return mixed
     */
    public function update(Usuario $usuario, Categoria $categoria)
    {
        if($usuario->rol == "Cliente") return false;
        if($usuario->rol == "Supervisor") return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Categoria  $categoria
     * @return mixed
     */
    public function delete(Usuario $usuario, Categoria $categoria)
    {
        if($usuario->rol == "Cliente") return false;
        if($usuario->rol == "Supervisor") return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Categoria  $categoria
     * @return mixed
     */
    public function restore(Usuario $usuario, Categoria $categoria)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Categoria  $categoria
     * @return mixed
     */
    public function forceDelete(Usuario $usuario, Categoria $categoria)
    {
        //
    }
    
}
