function validar_registro_inventario_venta(){
    var producto, cantidad_venta;
    producto = document.getElementById("producto").value;
    cantidad_venta = document.getElementById("cantidad_venta").value;
    if (producto === "" || cantidad_venta === ""){
        alert ("Todos los campos deben estar llenos");
        return false;
    }
    else if(isNaN(cantidad_venta)){
        alert ("No escribio un numero en cantidad");
        return false;
    }
    else if(cantidad_ventat.lenght>11){
        alert ("La cantidad es muy grande");
        return false;
    }
    else if(cantidad_venta<1){
        alert ("Por favor ingresar un nunmero mayor");
        return false;
    }
}


function validar_registro_inventario(){
    var producto, cantidad_venta, descripcion, cantidad, precio;
    producto = document.getElementById("producto").value;
    cantidad_venta = document.getElementById("cantidad_venta").value;
    descripcion = document.getElementById("descripcion").value;
    cantidad = document.getElementById("cantidad").value;
    precio = document.getElementById("precio").value;
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
   
