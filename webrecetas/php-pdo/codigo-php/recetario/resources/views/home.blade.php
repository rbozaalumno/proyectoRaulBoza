<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebRecetas - Inicio</title>
    <link rel="shortcut icon" href="{{ asset('images/tortilla-de-patatas-porcion-cortada.jpg') }}"> 
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
    <div class="col-12 nomarpad">
        <div class="row nomarpad">
            <div class="col-6 nomarpad">
                <img src="../images/cooking1.jpg" alt="" style="width: 100%;height: 500px;object-fit: cover;object-position: 0px -70px;background-color: #D88E8E;">
            </div>
            <div class="col-6 nomarpad" style="background-color:#D88E8E;text-align: center;">
                <h1 style="font-family:Pacifico;color:black;font-size:75px;padding-top: 50px">Aprende</h1>
                <p style="font-family:Lato;color:black;font-size:25px;padding-top: 45px">Encuentra recetas inspiradoras que realizar<br>siguiendo las intrucciones del creador...<br>¡O dale tu toque especial!</p>
                <p style="font-family:Lato;color:black;font-size:25px;padding-top: 25px"><a href="/index" class="newa">¡Comienza a explorar nuestro gran recetario!</a></p>
                <div class="row nomarpad"><a href="/index" style="width: -webkit-fill-available;"><div class="col-2 offset-5 recipebookicon"></div></a></div>
            </div>
        </div>
    </div>
    <div class="col-12 nomarpad">
        <div class="row nomarpad">
            <div class="col-6 nomarpad" style="background-color:#AEE5D8;text-align: center;">
                <h1 style="font-family:Pacifico;color:black;font-size:75px;padding-top: 50px">Únete</h1>
                <p style="font-family:Lato;color:black;font-size:25px;padding-top: 45px">¡Aporta tu grano de arroz a la olla!<br>Pertenece a esta comunidad de chefs para comentar,<br>compartir tus recetas y poder guardar tus favoritas.</p>
                <p style="font-family:Lato;color:black;font-size:25px;padding-top: 25px"><a href="/register" class="newa">¡Ponte creativo con nosotros!</a></p>
                <div class="row nomarpad"><a href="/register" style="width: -webkit-fill-available;"><div class="col-2 offset-5 saltbaegif"></div></a></div>
            </div>
            <div class="col-6 nomarpad">
                <img src="../images/cooking2.png" alt="" style="width: 100%;height: 500px;object-fit: cover;object-position: 0px -55px;background-color: #AEE5D8;">
            </div>
        </div>
    </div>
    <div class="content">
        <div class="row nomarpad">
            <div class="row nomarpad" style="justify-content: space-evenly">
            @foreach($recipes as $recipe)
                <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 nomarpad mb-3 mr-1" style="border:5px solid #63A6A6;border-radius:5px;min-height: 200px;background-color:#AEE5D8">
                    <div class="row nomarpad">
                        <a href="{{url('recipe/'.$recipe->id)}}" style="text-decoration:none;color:#000000">
                            <div class="row nomarpad">                        
                                <div class="col-12 nomarpad"><img src="{{$recipe->image}}" alt="" style="width:100%; height:auto; max-height:300px;border-bottom:5px solid #63A6A6"></div>
                                <div class="col-10 nomarpad" style="padding:10px!important">
                                    <p style="text-decoration:none;text-decoration:underline; font-weight:bold;word-break: break-word;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;line-height: 16px; /* fallback */
                                        max-height: 32px; /* fallback */-webkit-line-clamp: 2; /* number of lines to show */-webkit-box-orient: vertical;; font-family:Lato">{{$recipe->title}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="col-12 mt-5">{{$recipes->links("pagination::bootstrap-4")}}</div>
        </div>  
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
</html>