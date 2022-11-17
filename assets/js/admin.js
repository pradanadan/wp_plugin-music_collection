function showPreview(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("imgPreview");
      var btn = document.getElementById("imageBtnLabel");
      preview.src = src;
      btn.innerHTML = "Change IMG";
    }
}

function showAudio(event){
    if(event.target.files.length > 0){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("audioSrcPreview");
      var btn = document.getElementById("fileBtnLabel");
      preview.src = src;
      document.getElementById("audioControl").load();
      btn.innerHTML = "Change MP3";
    }
}