function validar(){
    var producto, cantidad_venta, descripcion, cantidad, precio;
    producto = document.getElementById("producto").value;
    cantidad_venta = document.getElementById("cantidad_venta").value;
    descripcion = document.getElementById("descripcion").value;
    cantidad = document.getElementById("cantidad").value;
    precio = document.getElementById("precio").value;

    if(producto == null || cantidad_venta == null){
        if (descripcion === "" || cantidad === "" || precio === ""){
            alert ("Todos los campos deben estar llenos");
            return false;
        }
        else if(isNaN(cantidad)){
            alert ("No escribio un numero en cantidad");
            return false;
        }
        else if(cantidad.lenght>11){
            alert ("La cantidad es muy grande");
            return false;
        }
        else if(isNaN(precio)){
            alert("El precio no es valido");
            return false;
        }
    }
    else if(descripcion==null || cantidad==null || precio==null){
        if (producto === "" || cantidad_venta === ""){
            alert ("Todos los campos deben estar llenos");
            return false;
        }
        else if(isNaN(cantidad_venta)){
            alert ("No escribio un numero en cantidad");
            return false;
        }
        else if(cantidad_venta.lenght>11){
            alert ("La cantidad es muy grande");
            return false;
        }
    }
}