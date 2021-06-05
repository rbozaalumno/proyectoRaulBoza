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
            <ul class="navbar-nav" style="margin-left:70px">
                <li class="nav-item active">
                    <a class="nav-link navbar-element" href="/home">Indice<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link navbar-element" href="/index">Recetas<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto"style="margin-right: 145px;">
                
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
                <div class="col-10" style="font-family:Pacifico;color:#BF4D67;font-size:75px;">Crear nueva receta</div>
                <div id="bkimage" class="col-2" style="background: no-repeat;border:5px dotted;text-align:center;background-image: url(../images/add_image.png);background-size: 50%;background-origin: content-box;background-position: center;">
                    <input id="image" type="file" class="custom-file-input" style="max-height:100px" id="inputGroupFile01" name="image" required>
                </div>
                <div class="col-6 nomarpad" style="padding-left: 50px!important;margin-top:50px!important">
                    <div class="row nomarpad">
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="title" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Titulo de la receta</label>
                        <input type="text" class="form-control category-select" id="title" name="title" style="font-size: 20px!important;" required></input></div>
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Categoria</label>
                                                    <select class="form-control category-select" id="category" name="category" require>
                                                        @foreach ($categories as $category)
                                                        <option class="category-select" style="font-size: 20px!important;" value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select></div>
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="ingredients" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Ingredientes de la receta</label>
                        <input type="text" class="form-control category-select" style="font-size: 20px!important;" id="ingredients" name="ingredients" required></div>    
                        <div class="col-10 nomarpad"><button type="submit" class="btn navbar-button" style="float: left;margin-top:20px!important;margin-left:10px!important; font-size: 25px;border:3px solid #BF4D67!important">Crear</button></div>
                    </div>
                </div>
                <div class="col-6 nomarpad" style="margin-top:50px!important">
                    <div class="col-12 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                            max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Descripción</label></div>
                    <div class="col-11 nomarpad" style="max-width: none"><textarea class="form-control description" name="description" id="description" cols="100" rows="5" style="height:325px"></textarea></div>
                </div>
            </div>
        </form>
        </div>
        @else
        <form method="POST" action="../update/{{$recipe->id}}" enctype="multipart/form-data">
            @csrf
            <div class="row nomarpad">
                <div class="col-10" style="font-family:Pacifico;color:#BF4D67;font-size:75px;">Modificar receta</div>
                <div id="bkimage" class="col-2" style="background: no-repeat;border:5px dotted;text-align:center;background-image: url(../images/add_image.png);background-size: 50%;background-origin: content-box;background-position: center;">
                    <input id="image" type="file" class="custom-file-input" style="max-height:100px" id="inputGroupFile01" name="image">
                </div>
                <script>document.getElementById("bkimage").style.backgroundImage =  'url("{{$recipe->image}}")';</script>
                <div class="col-6 nomarpad" style="padding-left: 50px!important;margin-top:50px!important">
                    <div class="row nomarpad">
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="title" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Titulo de la receta</label>
                        <input type="text" class="form-control category-select" style="font-size: 20px!important;" id="title" name="title" value="{{$recipe->title}}" required></input></div>
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Categoria</label>
                                                    <select class="form-control category-select" style="font-size: 20px!important;" id="category" name="category" require>
                                                        @foreach ($categories as $category)
                                                        @if($category->id==$category_id)
                                                            <option class="category-select" selected value="{{$category->id}}">{{$category->name}}</option>
                                                            @else
                                                            <option class="category-select" value="{{$category->id}}">{{$category->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select></div>
                        <div class="col-10 nomarpad" style="margin: 10px!important;"><label for="ingredients" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Ingredientes de la receta</label>
                        <input type="text" class="form-control category-select" style="font-size: 20px!important;" id="ingredients" name="ingredients" value="{{$recipe->ingredients}}" required></div>    
                        <div class="col-5 nomarpad"><button type="submit" class="btn navbar-button" style="float: left;margin-top:20px!important;margin-left:10px!important; font-size: 25px;border:3px solid #BF4D67!important">Modificar</button></div>  
                        <form method="POST" action="../delete/{{$recipe->id}}" enctype="multipart/form-data">
                        @csrf
                            <div class="col-5 nomarpad"><button type="submit" class="btn navbar-button" style="float: right;margin-top:20px!important;margin-left:10px!important; font-size: 25px;border:3px solid #BF4D67!important">Eliminar</button></div>                       
                        </form>
                    </div>
                </div>
                <div class="col-6 nomarpad" style="margin-top:50px!important">
                    <div class="col-12 nomarpad" style="margin: 10px!important;"><label for="category" style="text-decoration:none;text-decoration:underline; font-weight:bold;font-size:25px;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 30px; /* fallback */
                                            max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;">Descripción</label></div>
                    <div class="col-11 nomarpad" style="max-width: none"><textarea class="form-control" name="description" id="description" cols="100" rows="5" style="height:325px">{{$recipe->description}}</textarea></div>
                </div>   
                </div>
            </div>
        </form>
        @endif
    </div>
</body>


<footer>
    <div class="col-12 nomarpad" style="height:150px; background-color:#63A6A6;padding-top: 0px!important;">
        <h1 style="position:absolute;right: 31%;top: 40%;font-family:Lato;color:#BF4D67;font-size:40px;">Copyright© 2021 WebRecetas</h1>
        <img class="img-fluid" src="../images/backhome.png" alt="" style="width:100%;height: 165px;object-fit: cover;object-position: 0px -1000px;"></img>
    </div>
</footer>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="{{asset('js/show_image.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/61v0r5ham9p1g0k2bqwr60bilpmotncy1mufxgayoeuvu9mr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      language : 'es',
      selector: 'textarea',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      plugins: 'image paste',
   });
  </script>
</html>