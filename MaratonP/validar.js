<!-- Archivo que valida las formas -->
window.onload = initForm;

function initForm() {
		document.forms[0].onsubmit = function() {return ValidarForma();}
}

function ValidarForma(){
var valido = true;
mailRE=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
nameRE=/[a-zA-Z\.\'\-_\s]{1,40}/;
var allInputs = document.getElementsByTagName("input");
var allSelects = document.getElementsByTagName("select");
var allTextArea = document.getElementsByTagName("textarea");
var value="";
for (var i=0; i<allInputs.length;i++){
clase=allInputs[i].className;
if ((clase=="req"||clase=="invalid") && allInputs[i].value=="") {
			valido = false;
                  allInputs[i].className="invalid"
		}
else if((clase=="invalid"||clase=="req") && allInputs[i].value!=""){
if(allInputs[i].id=="Email"){
  value=allInputs[i].value;
with(value){
    if(value.match(mailRE)){
         allInputs[i].className="req"
     }
     else{
         allInputs[i].className="invalid"
         valido = false;
     }
     
 }
}
else if(allInputs[i].id=="Nombre"){
  value=allInputs[i].value;
with(value){
    if(value.match(nameRE)){
         allInputs[i].className="req"
     }
     else{
         allInputs[i].className="invalid"
         valido = false;
     }
     
 }
}
else{allInputs[i].className="req";}
}
}
for (var i=0; i<allSelects.length;i++){
clase=allSelects[i].className;
if((clase=="req"||clase=="invalid")&&allSelects[i].selectedIndex==0){
valido = false;
 allSelects[i].className="invalid"
}
else if(clase=="invalid"&&allSelects[i].selectedIndex!=0){
allSelects[i].className="req"
}
}

for (var i=0; i<allTextArea.length;i++){
clase=allTextArea[i].className;
if((clase=="req"||clase=="invalid")&&allTextArea[i].value==""){
valido = false;
 allTextArea[i].className="invalid"
}
else if(clase=="invalid"&&allTextArea[i].value!=""){
allSelects[i].className="req"
}
}

return valido;
}

function resetForm() {
	var allInputs = document.getElementsByTagName("input");

	for (var i=0; i<allInputs.length; i++) {
            clase=allInputs[i].className;
		if (clase=="invalid") {
                  allInputs[i].className="req"
                  document.getElementById("label"+[i]).className="req"
		}
	}
         document.getElementById("label1").className="req"
         document.getElementById("label2").className="req"
         document.getElementById("Edad").className="req"
}