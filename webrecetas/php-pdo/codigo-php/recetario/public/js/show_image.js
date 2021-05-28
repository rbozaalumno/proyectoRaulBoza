image.onchange = evt => {
    const [file] = image.files
    if (file) {
        document.getElementById("bkimage").style.backgroundImage = "url('"+URL.createObjectURL(file)+"')" ;
    }
  }
  