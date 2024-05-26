const pass = document.getElementById("password"),
      icon = document.querySelector(".bx");

icon.addEventListener("click", e=>{
    if(pass.type === "password"){
        pass.type = "text";
    }else{
        pass.type  = "password";
    }
})