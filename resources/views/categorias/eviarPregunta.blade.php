<form action="/preguntar" method="post" enctype="multipart/form-data">
    @csrf
    <label for="">Por favor redacte su pregunta</label><br>
    Pregunta: <input type="text" name="pregunta">
    <input class="btn" type="submit" value="Enviar">
</form>