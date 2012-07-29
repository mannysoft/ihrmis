// No Need to Change
function f6_OneCheckBox(){
f6_cbs=document.getElementsByTagName('INPUT');
for (f6_0=0;f6_0<f6_cbs.length;f6_0++){
if (f6_cbs[f6_0].title.substring(0,3)=='f6_'){
//f6_cbs[f6_0].onclick=function(){ f6_CheckOnlyOne(this); }
zxcAddf6_CheckOnlyOne(f6_cbs[f6_0])}
}
}

function f6_CheckOnlyOne(){
for (f6_0=0;f6_0<f6_cbs.length;f6_0++){
if (f6_cbs[f6_0].title==this.title&&f6_cbs[f6_0]!=this){
f6_cbs[f6_0].checked=false;
}
}
}

function zxcEventAdd(zxco,zxct,zxcf) {
if ( zxco.addEventListener ){ zxco.addEventListener(zxct, function(e){ zxco[zxcf](e);}, false); }
else if ( zxco.attachEvent ){ zxco.attachEvent('on'+zxct,function(e){ zxco[zxcf](e); }); }
else {
var zxcPrev=zxco["on" + zxct];
if (zxcPrev){ zxco['on'+zxct]=function(e){ zxcPrev(e); zxco[zxcf](e); }; }
else { zxco['on'+zxct]=zxco[zxcf]; }
}
}

function zxcAddf6_CheckOnlyOne(zxc){
if (zxc.addf6_CheckOnlyOne){ return; }
zxc.addf6_CheckOnlyOne=f6_CheckOnlyOne;
zxcEventAdd(zxc,'click','addf6_CheckOnlyOne');
}

function highlightRow(el, color) {
color=el.checked?color:'';
while (el.tagName.toUpperCase() != 'TR' && el != null)
el = el.parentNode;
if (el)
el.style.backgroundColor = color;
}