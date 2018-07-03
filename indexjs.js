var sections;

function countChars(){
  var val   = this.value,
      count = 500 - val.length,
      char  = this.nextSibling;
  char.innerHTML = count;
  if(count < 0){
    this.value = val.substring(0, 500);
  }
}

function toggleSections(){
  for(var x = sections.length - 1; x >= 0; x--){
    sections[x].className = "";
  }
  document.getElementById(location.hash.substring(1)).className = "on";
}

window.onload = function(){

  sections = document.querySelectorAll("section");
  if(location.hash){
    toggleSections();
  }else{
    document.querySelector("[href='#story']").click();
  }

  var inputs = document.querySelectorAll("form>input[type=text], textarea"),
      input,
      elChar;
  for(var x = inputs.length - 1; x >= 0; x--){
    elChar = document.createElement("P");
    elChar.className = "char";
    input = inputs[x];

    input.parentNode.insertBefore(elChar, inputs[x].nextSibling);
    input.addEventListener("keyup", countChars);
  }


}

window.onhashchange = toggleSections;

