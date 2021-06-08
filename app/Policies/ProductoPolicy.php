<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductoPolicy
{
    use HandlesAuthorization;

    public function cambios(Usuario $usuario, Producto $producto){
        return $producto -> concesionado != 1;
    }
    public function concesionar(Usuario $usuario){
        if($usuario->rol == "Encargado") return true;
    }
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
     * @param  \App\Models\Producto  $producto
     * @return mixed
     */
    public function view(Usuario $usuario, Producto $producto)
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
        return $usuario -> rol == "Cliente";
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Producto  $producto
     * @return mixed
     */
    public function update(Usuario $usuario, Producto $producto)
    {
        return $producto->usuario_id == $usuario->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Producto  $producto
     * @return mixed
     */
    public function delete(Usuario $usuario, Producto $producto)
    {
        if($usuario->rol == "Contador") return false;
        if($usuario->rol == "Supervisor" || $usuario->rol == "Encargado") return !$producto->concesionado;
        if($usuario->rol == "Cliente") return !$producto->concesionado && $producto->usuario_id == $usuario->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Producto  $producto
     * @return mixed
     */
    public function restore(Usuario $usuario, Producto $producto)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Usuario  $usuario
     * @param  \App\Models\Producto  $producto
     * @return mixed
     */
    public function forceDelete(Usuario $usuario, Producto $producto)
    {
        //
    }
}
