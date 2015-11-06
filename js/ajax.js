var querify = function(obj) {
  var str = [];
  for(var p in obj)
    if (obj.hasOwnProperty(p)) {
      str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
    }
  return str.join("&");
}

var objAjax = function() {
    if (typeof XMLHttpRequest !== 'undefined') {
        return new XMLHttpRequest();  
    }
    var versions = [
        "MSXML2.XmlHttp.6.0",
        "MSXML2.XmlHttp.5.0",   
        "MSXML2.XmlHttp.4.0",  
        "MSXML2.XmlHttp.3.0",   
        "MSXML2.XmlHttp.2.0",  
        "Microsoft.XmlHttp"
    ];

    var xhr;
    for(var i = 0; i < versions.length; i++) {  
        try {  
            xhr = new ActiveXObject(versions[i]);  
            break;  
        } catch (e) {
        }  
    }
    return xhr;
};

var enviarPost = function(ruta,datos,accion){
    var datos = datos || {};
    var r = objAjax();
    r.open("POST", ruta, true);
    r.onreadystatechange = function () {
      if (r.readyState != 4 || r.status != 200) return;
      accion(r.responseText);
    };
    r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    r.send(querify(datos));
}


var enviarGet = function(ruta,datos,accion){
    var datos = datos || {};
    var r = objAjax();
    var dat = querify(datos);
    r.open("GET", ruta+"?"+dat, true);
    r.onreadystatechange = function () {
      if (r.readyState != 4 || r.status != 200) return;
      accion(r.responseText);
    };
    r.send();
}