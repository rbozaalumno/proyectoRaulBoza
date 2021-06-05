<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebRecetas - Inicio</title>
    <link rel="icon" href="{{ asset('images/tortilla-de-patatas-porcion-cortada.jpg') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('../css/stylesRecipe.css') }}" />
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
    <nav class="navbar navbar-expand-lg navbar-light" style=" background-color:#AEE5D8;padding: .5rem 6rem .5rem 12rem;border: 4px solid #63A6A6">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav" style="margin-left:50px">
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
    <div class="content" style="font-family: Lato;">
        <div class="row nomarpad">                        
            <div class="col-4 nomarpad"><img src="{{$recipe->image}}" alt="" style="width:100%; height:auto;border:5px solid #63A6A6; border-radius:5px;"></div>
            <div class="col-8">
                <div class="row nomarpad">
                    <div class="col-12" style="font-family:Pacifico;color:#BF4D67;font-size:75px;margin-bottom:25px;text-decoration:underline">{{$recipe->title}}</div>
                    @if($isFavourite)
                    <div class="col-1"><form method="POST" action="../unfavourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/full_star.svg" type="image" name="submit" class="star" style="width:100%" alt="Submit"/></form></div>
                    @else
                    <div class="col-1"><form method="POST" action="../favourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/empty_star.svg" type="image" name="submit" class="star" style="width:100%" alt="Submit"/></form></div>
                    @endif
                    <div class="col-1"><a href="https://api.whatsapp.com/send?text={{Request::url()}}"><img src="../images/waicon.png" class="waicon" style="width:100%"/></a></div>
                    @if(Auth::id()==1)
                    <div class="col-12"><form method="POST" action="../delete/{{$recipe->id}}" enctype="multipart/form-data">@csrf<button type="submit" class="btn btn-danger" style="margin: 10px;">Eliminar Post</button></form></div>
                    @endif
                </div>
            </div>
            <div class="col-6" style="background: #AEE5D8;border-radius:5px;border-color: #63A6A6;border-style: solid;margin-top:10px">
                    <div class="col-12 nomarpad recipe_subtitle"><p>Ingredientes</p></div>
                    <div class="col-12 nomarpad recipe_ingredients"><p>{{$recipe->ingredients}}</p></div>
            </div>
            <div class="col-12" style="margin-top:30px!important">
                <div class="col-12 nomarpad recipe_subtitle"><p>Receta</p></div>
                <div class="col-12 nomarpad" style="margin-top:40px!important;margin-bottom:50px!important">{!!$recipe->description!!}</div>
            </div>
            <div class="col-12" style="font-family:Pacifico;color:#BF4D67;font-size:50px;margin-bottom:25px;;margin-top:25px;">Comentarios - {{count($comments)}}</div>
            @if(!Auth::guest())
            <div class="col-12" style="font-family:Pacifico;color:#BF4D67;font-size:30px;margin-bottom:10px;;margin-top:25px;text-decoration:underline">Deja tu comentario</div>
            <div class="col-12">
                <div class="row nomarpad">
                    <form method="POST" action="../comment/{{$recipe->id}}">
                    @csrf
                        <textarea class="form-control category-select" name="comment" id="comment" cols="75" rows="3" style="margin:0px; width:auto!important" required></textarea>
                        
                        <button type="submit" class="btn navbar-button" style="float:right;margin: 10px;">Enviar</button>
                    </form>
                </div>
            </div>
            @else
            <div class="col-12" style="font-family:Pacifico;color:#BF4D67;font-size:30px;margin-bottom:10px;;margin-top:25px"><a href="/login" class="newa" style="color:#BF4D67">¡Únete para dejar tus comentarios!</a></div>
            @endif
            <div class="col-12 nomarpad">
                <div class="row nomarpad">
                    @php 
                        $i=0;
                    @endphp
                    @foreach($comments as $comment)
                    <div class="col-1 nomarpad" style="align-self:center"><img src="{{$images[$i]}}" alt="" style="width:100%;">
                    </div>
                    <div class="col-5 nomarpad">
                        <div class="row nomarpad">
                            <div class="col-12" style="font-family:Pacifico;color:#BF4D67;font-size:25px;margin-bottom:10px;;margin-top:25px">{{$names[$i]}}</div>
                        @if(Auth::id()==1)
                            <div class="col-9"><p style="margin-top: 10px;padding: 10px;background: #e4d4d4;border-radius: 10px;">{{$comment->text}}</p></div>
                            <div class="col-3"><form method="POST" action="../deleteComment/{{$comment->id}}/{{$recipe->id}}" enctype="multipart/form-data">@csrf<button type="submit" class="btn navbar-button" style="float:right;margin: 10px;">Eliminar</button></form></div>
                        @else
                            <div class="col-12 nomarpad"><p style="margin-top: 10px;padding: 10px;background: #e4d4d4;border-radius: 10px;">{{$comment->text}}</p></div>
                        @endif
                        </div>
                    </div>    
                    @php 
                        $i++;
                    @endphp 
                    @endforeach
                    <div class="col-12">{{$comments->links("pagination::bootstrap-4")}}</div>
                </div>
            </div>
        </div>
        <!--<div class="row nomarpad">                        
            <div class="col-3 nomarpad"><img src="{{$recipe->image}}" alt="" style="width:100%; height:auto;border:5px solid #63A6A6; border-radius:5px;"></div>
            <div class="col-9 nomarpad" style="padding:10px!important;">
                <div class="row nomarpad">
                    <div class="col-8 nomarpad recipe_title"><p>{{$recipe->title}}</p> 
                    </div>
                    @if(Auth::id()==1)
                    <div class="col-1"><form method="POST" action="../delete/{{$recipe->id}}" enctype="multipart/form-data">@csrf<button type="submit" class="btn btn-danger" style="float:right;margin: 10px;">Eliminar Post</button></form></div>
                    @if($isFavourite)
                    <div class="col-1"><form method="POST" action="../unfavourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/full_star.svg" type="image" name="submit" class="star" style="width:100%" alt="Submit"/></form></div>
                    @else
                    <div class="col-1"><form method="POST" action="../favourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/empty_star.svg" type="image" name="submit" class="star" style="width:100%" alt="Submit"/></form></div>
                    @endif
                    @else
                    @if($isFavourite)
                    <div class="col-1"><form method="POST" action="../unfavourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/full_star.svg" type="image" name="submit" class="star" style="width:100%" alt="Submit"/></form></div>
                    @else
                    <div class="col-1"><form method="POST" action="../favourite/{{$recipe->id}}" enctype="multipart/form-data">@csrf<input src="../images/empty_star.svg" type="image" name="submit" class="star" style="width:100%" alt="Submit"/></form></div>
                    @endif
                    @endif
                    <div class="col-1"><a href="https://api.whatsapp.com/send?text={{Request::url()}}"><img src="../images/waicon.png" class="waicon" style="width:100%"/></a></div>
                    <div class="col-12" style="background: #AEE5D8;border-radius:5px;border-color: #63A6A6;border-style: solid;">
                    <div class="col-12 nomarpad recipe_subtitle"><p>Ingredientes</p></div>
                    <div class="col-12 nomarpad recipe_ingredients"><p>{{$recipe->ingredients}}</p></div></div>
                </div>
            </div>
            <div class="col-12" style="background: #AEE5D8;  margin-top:25px!important;border-radius:5px;border-color: #63A6A6;border-style: solid;">
            <div class="col-12 nomarpad recipe_subtitle"><p>Descripcion</p></div>
            <div class="col-12"><div class="col-12 nomarpad" style="margin-top:40px!important">{!!$recipe->description!!}</div></div></div>
        </div>
        @if(!Auth::guest())
            <div class="row nomarpad">
                <form method="POST" action="../comment/{{$recipe->id}}">
                @csrf
                    <textarea class="form-control" name="comment" id="comment" cols="100" rows="5" style="margin:10px; width:auto!important" required></textarea>
                    
                    <button type="submit" class="btn btn-primary" style="float:right;margin: 10px;">Enviar</button>
                </form>
            </div>
        @endif
        <div class="row nomarpad">
            @foreach($comments as $comment)
                @if(Auth::id()==1)
                    <div class="col-5 nomarpad"><p style="margin: 10px;padding: 10px;background: #e4d4d4;border-radius: 10px;">{{$comment->text}}</p></div>
                    <div class="col-1"><form method="POST" action="../deleteComment/{{$comment->id}}/{{$recipe->id}}" enctype="multipart/form-data">@csrf<button type="submit" class="btn btn-danger" style="float:right;margin: 10px;">Eliminar Comentario</button></form></div>
                @else
                    <div class="col-6 nomarpad"><p style="margin: 10px;padding: 10px;background: #e4d4d4;border-radius: 10px;">{{$comment->text}}</p></div>
                @endif
            @endforeach
            <div class="col-12">{{$comments->links("pagination::bootstrap-4")}}</div>
        </div>-->
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
<script src="https://cdn.tiny.cloud/1/61v0r5ham9p1g0k2bqwr60bilpmotncy1mufxgayoeuvu9mr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
      selector: '#description',
   });
  </script>
</html>