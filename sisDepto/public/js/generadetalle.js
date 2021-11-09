$(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });

  var cont=0;
  subtotal=[];
  total=0;
  $("#guardar").hide();

  function agregar(){
    idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_compra=$("#pprecio_compra").val();
    precio_venta=$("#pprecio_venta").val();

    if(idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!=""){
      subtotal[cont]=(cantidad*precio_compra);
      total=total+subtotal[cont];
      var fila='<tr class="selected" id="fila'+cont+'"> <td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">x</button></td> <td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td> <td><input type="number" name="cantidad[]" value="'+cantidad+'"></td> <td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td> <td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td> <td>'+subtotal[cont]+'</td> </tr>';
      cont++;
      limpiar();
      $("#total").html("$ "+total);
      evaluar();
      $('#detalles').append(fila);
    }else{
      alert("Error al ingresar el detalle de ingreso, por favor revise los datos del articulo");
    }
  }

  function limpiar(){
    $("#pcantidad").val("");
    $(#"pprecio_compra").val("");
    $(#"pprecio_venta").val("");
  }
  function evaluar(){
    if(total>0){
      $("#guardar").show();
    }else{
      $("#guardar").hide();
    }
  }
  function eliminar(index){
    total=total-subtotal[index];
    $("#total").html("$ "+total);
    $("#fila" + index).remove();
    evaluar();
  }