<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebRecetas - Inicio</title>
    <link rel="icon" href="{{asset('images/tortilla-de-patatas-porcion-cortada.jpg')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/styles.css') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    
</head>
<body>
<div class="col-12 nomarpad" style="height:250px; background-color:#63A6A6">
        <h1 style="position:absolute;right: 36%;top: 30%;font-family:Pacifico;color:#BF4D67;font-size:100px;">WebRecetas</h1>
        <img class="img-fluid" src="../images/backhome.png" alt="" style="width:100%;height: 250px;object-fit: cover;object-position: 0px -410px;"></img>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light" style=" background-color:#AEE5D8;padding: .5rem 6rem .5rem 12rem;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link navbar-element" href="/home">Indice<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link navbar-element" href="/index">Recetas<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto"style="margin-right: 88px;">
                
                <li class="nav-item dropdown" >
                    @if (Auth::guest())
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Usuario
                    </a>
                    @else
                    <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->name}}
                    </a>
                    @endif
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    @if (Auth::guest())
                    <a class="dropdown-item" href="/login">Log-in</a>
                    @else
                    <a class="dropdown-item" href="/panel/">Panel</a>
                    <a class="dropdown-item" href="/panelf/">Favoritos</a>
                    <a class="dropdown-item" href="/logout">Log-out</a>
                    @endif
                    </div>
                </li>
             </ul>
        </div>
    </nav>
    <div class="content">
        @if($mode==1)
        <form method="POST" action="../create" enctype="multipart/form-data">
            @csrf
            <div class="row nomarpad">                        
                <div class="col-3 nomarpad"><input id="image" type="file" name="image" required></div>
                <div class="col-6 nomarpad" style="padding-left: 50px!important;">
                    <div class="row nomarpad">
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="title" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Titulo de la receta</label>
                        <input type="text" class="form-control" id="title" name="title" required></input></div>
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="ingredients" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Ingredientes de la receta</label>
                        <input type="text" class="form-control" id="ingredients" name="ingredients" required></div>    
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Categoria</label>
                                                    <select class="form-control" id="category" name="category" require>
                                                        @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select></div>
                    </div>
                </div>
                <div class="col-12 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Descripción</label></div>
                <div class="col-11 nomarpad" style="margin: 10px!important;"><textarea class="form-control" name="description" id="description" cols="100" rows="5" required></textarea></div>
                <div class="col-12"><div class="col-12 nomarpad"><button type="submit" class="btn btn-primary">Enviar</button></div>
            </div>
        </form>
        </div>
        @else
        <form method="POST" action="../update/{{$recipe->id}}" enctype="multipart/form-data">
            @csrf
            <div class="row nomarpad">                        
                <div class="col-3 nomarpad" style="align-self:center"><input id="image" type="file" name="image" required></div>
                <div class="col-6 nomarpad" style="padding-left: 50px!important;">
                    <div class="row nomarpad">
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="title" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Titulo de la receta</label>
                        <input type="text" class="form-control" id="title" placeholder="{{$recipe->title}}" value="{{$recipe->title}}" name="title" required></input></div>
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="ingredients" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Ingredientes de la receta</label>
                        <input type="text" class="form-control" id="ingredients" placeholder="{{$recipe->ingredients}}" value="{{$recipe->ingredients}}" name="ingredients" required></div>    
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Categoria</label>
                                                    <select class="form-control" id="category" name="category" require>
                                                        @foreach ($categories as $category)
                                                            @if($category->id==$category_id)
                                                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                                                            @else
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select></div>
                    </div>
                </div>
                <div class="col-12 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Descripción</label></div>
                <div class="col-11 nomarpad" style="margin: 10px!important;"><textarea class="form-control" name="description" id="description" cols="100" rows="5" required>{{$recipe->description}}</textarea></div>
                <div class="col-6 nomarpad" style="padding: 10px!important;"><button type="submit" class="btn btn-primary">Actualizar</button></div></form>
                <div class="col-6 nomarpad" style="padding: 10px!important;"><form method="POST" action="../delete/{{$recipe->id}}" enctype="multipart/form-data">@csrf<button type="submit" class="btn btn-danger">Borrar</button></form></div>
            </div>
        </form>
        @endif
    </div>
</body>


<footer>
    <div class="col-12 nomarpad" style="height:150px; background-color:#63A6A6;padding-top: 0px!important;">
        <h1 style="position:absolute;right: 31%;top: 40%;font-family:Lato;color:#BF4D67;font-size:50px;">Copyright© 2021 WebRecetas</h1>
        <img class="img-fluid" src="../images/backhome.png" alt="" style="width:100%;height: 165px;object-fit: cover;object-position: 0px -1000px;"></img>
    </div>
</footer>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</html>