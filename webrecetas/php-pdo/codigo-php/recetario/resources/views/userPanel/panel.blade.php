<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebRecetas - Inicio</title>
    <link rel="icon" href="{{ asset('images/tortilla-de-patatas-porcion-cortada.jpg') }}"> 
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('../css/styles.css') }}" />
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
            <ul class="navbar-nav ml-auto"style="margin-right: 235px;">
                <select class="form-control navbar-focus category-select" id="category" name="category"style="min-width:200px;margin-right: 60px;border: 2px solid #63A6A6;" onchange="location = this.value;">
                    <option class="category-selected" value="">Seleciona categoria</option>
                    @foreach($categoriesSelect as $category)
                        <option class="category-selected" value="?category_id={{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <form class="form-inline my-2 my-lg-0" style="min-width:300px;" method="POST" action="../index">@csrf
                    <input name="search" id="search" class="form-control mr-sm-2 navbar-focus input" type="search" placeholder="" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0 navbar-button" type="submit">Buscar</button>
                </form>
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
        <div class="row">
            <div class="col-12">
                <div class="row nomarpad">
                    <div class="col-12 nomarpad" style="font-family:Pacifico;color:#BF4D67;font-size:75px;margin-bottom:25px">Panel de Usuario</div>
                </div>
                <form method="POST" action="../update_user/{{$user[0]->id}}" enctype="multipart/form-data">@csrf
                <div class="row nomarpad ml-4 mt-5">
                    <div id="bkimage" class="col-2 " style="background: no-repeat;border:5px dotted;text-align:center;background-image: url(../images/add_image.png);background-size: 60%;background-origin: content-box;background-position: center;">
                        <input id="image" type="file" class="custom-file-input" id="inputGroupFile01" name="image">
                    </div>
                    <script>
                        if('{{$user[0]->image}}' != 'null'){
                            document.getElementById("bkimage").style.backgroundImage =  'url("{{$user[0]->image}}")';
                        };
                    </script>
                    <div class="col-5">
                        <div class="row nomarpad">
                            <div class="col-12"><label style="font-weight:bold;text-decoration:underline;font-size:17px">Nombre</label></div>
                            <div class="col-12"><p style="font-size:17px">{{$user[0]->name}}</p></div>
                            <div class="col-12"><label style="font-weight:bold;text-decoration:underline;font-size:17px">Email</label></div>
                            <div class="col-12" style="font-size:17px"><p>{{$user[0]->email}}</p></div>
                        </div>
                    </div>
                    <div class="col-12 nomarpad">
                        <div class="col-5 nomarpad"><button type="submit" class="btn navbar-button" style="float: left;margin-top:20px!important; font-size: 15px;border:3px solid #BF4D67!important">Cambiar imagen</button></div>   
                    </div>
                </div>
                </form>
            </div>
        </div>        
        <div class="row nomarpad mt-5">
            <div class="col-1"><img src="../images/recipes_icon.png" style="max-width: -webkit-fill-available;" alt=""></div>
            <div class="col-11" style="font-family:Pacifico;color:#BF4D67;font-size:50px;margin-bottom:25px;text-decoration:underline">Mis recetas</div>
        </div>
        <div class="row nomarpad" style="">
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 nomarpad mb-3 mr-1" style="align-self: center; text-align-last: center;border:5px dotted;min-height: 200px;display: flex;align-items: center;
            place-content: center;margin-right:8%!important">
                <a href="{{url('creation')}}" style="text-decoration:none;">
                    <div class="row nomarpad" style="justify-content: center;">                        
                    <div class="col-6 nomarpad"><button type="submit" class="btn navbar-button" style="">+</button></div>
                    </div>
                </a>
            </div>
            @foreach($myRecipes as $recipe)
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 nomarpad mb-3 mr-1" style="border:5px solid #63A6A6;border-radius:5px;min-height: 200px;background-color:#AEE5D8;margin-right:8%!important">
                <form method="POST" action="../myrecipe/{{$recipe->id}}">
                    <div class="row nomarpad">
                        @csrf
                            <a href="{{url('recipe/'.$recipe->id)}}" style="text-decoration:none;color:#000000;width:100%">
                                <div class="row nomarpad">                        
                                    <div class="col-12 nomarpad"><img src="{{$recipe->image}}" alt="{{$recipe->title}}" style="width:100%; height:auto;border-bottom:5px solid #63A6A6"></div>
                                    <div class="col-10 nomarpad" style="padding:15px!important;padding-top:25px!important">
                                        <p  style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                            max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;; font-family:Lato">{{$recipe->title}}</p>
                                    </div>
                                    <div class="col-2 nomarpad" style="padding:10px!important;text-align-last: right;">
                                        <button class="btn icon-button" data-toggle="modal" data-target="#exampleModal" ></button>
                                    </div>
                                </div>
                            </a>
                        </form>
                    </div>
                </div> 
            @endforeach
                
            </div>
            <div class="col-12">{{$myRecipes->links("pagination::bootstrap-4")}}</div>  
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
<script type="text/javascript">
image.onchange = evt => {
    const [file] = image.files
    if (file) {
        document.getElementById("bkimage").style.backgroundImage = "url('"+URL.createObjectURL(file)+"')" ;
    }
  }
</script>
</html>