<?php

namespace App\Observers;

use App\Models\Bitacora;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

//aqui se indica que debe de hacer cuando se realice una accion correspondienre al CRUD
class CategoriaObserver
{
    protected $usuario = null;

    public function __construct()
    {
        $user = Auth::user();
        if(is_null($user))
            $this -> usuario = 'Anonimo';
        else
            $this -> usuario = $user -> nombre;
    }
    /**
     * Handle the Categoria "created" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function created(Categoria $categoria)
    {
        $registro = Bitacora::create([
            'quien'=>$this->usuario,
            'accion'=>'Agrego categoría',
            'que'=>$categoria->toJson()
        ]);
    }

    /**
     * Handle the Categoria "updated" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function updated(Categoria $categoria)
    {
        $registro = Bitacora::create([
            'quien'=>$this->usuario,
            'accion'=>'Actualizó categoría',
            'que'=>$categoria->toJson()
        ]);
    }

    /**
     * Handle the Categoria "deleted" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function deleted(Categoria $categoria)
    {
        $registro = Bitacora::create([
            'quien' => $this->usuario,
            'accion' =>'Elimino categoría',
            'que' => $categoria->toJson()
        ]);

    }

    /**
     * Handle the Categoria "restored" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function restored(Categoria $categoria)
    {
        //
    }

    /**
     * Handle the Categoria "force deleted" event.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return void
     */
    public function forceDeleted(Categoria $categoria)
    {
        //
    }
}
