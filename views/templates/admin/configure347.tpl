{**                                                                                       
*
*  ██████  ██  ██████  ██████  ██████   ██████  ██   ██ 
*  ██   ██ ██ ██    ██ ██   ██ ██   ██ ██    ██  ██ ██  
*  ██████  ██ ██    ██ ██████  ██████  ██    ██   ███   
*  ██   ██ ██ ██    ██ ██      ██   ██ ██    ██  ██ ██  
*  ██████  ██  ██████  ██      ██   ██  ██████  ██   ██ 
*
*}
<div class="panel">
    <div class="panel-heading">
        <i class="material-icons" style="vertical-align: middle;margin-top: -.083em;font-size: 1.4em;">business_center</i> {l s='EXTRACTO MODELO' mod='modelo347'} <i class="material-icons" style="vertical-align: middle;margin-top: -.083em;font-size: 1.4em;">filter_3filter_4filter_7</i>   
    </div>
    <div class="panel-body">
        
        <form class="form-inline" action="" method="post">           
            <div class="form-group">
              <label for="annio"> {l s='Year' mod='modelo347'}:</label>
                <input type="annio" class="form-control" id="annio" value="{$smarty.now|date_format:'%Y'}" name="annio">
            </div>
            
            <button type="submit" class="btn btn-primary" name="modelo347_form">
                {l s='OBTENER MODELO 347' mod='modelo347'}
            </button>
        </form>
        
        <br>

    {if isset($ventas) }
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#id_cliente</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellidos</th>
              <th scope="col">direccion facturacion</th>
              <th scope="col">num. pedidos</th>
              <th scope="col">Ventas anuales 347</th>
              <th scope="col"> </th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$ventas item=unafila}  
            <tr>
              <td>{$unafila.id_customer}</td>
              <td>{$unafila.firstname}</td>
              <td>{$unafila.lastname}</td>
              <td>{$unafila.id_address_invoice}</td>
              <td>{$unafila.num_pedidos}</td>
              <td>{$unafila.total_347}</td>
              <td><form class="form-inline" action="" method="post"></td>
            </tr>
            {/foreach}
          </tbody>
        </table>

        <p id="showTrimestres"></p>

    </div>
    {else}
        
    <div class="panel-footer">
        {if isset($annio)}
            <div class="alert alert-warning" role="alert">No hay modelo 347 para el ejercicio anual {$annio} seleccionado</div>
        {/if}
    </div>

    {/if}

</div>

{**************************************************
 *                   J S
 ***************************************************
<script>
//let elements = document.querySelectorAll(".chart");
//alert(element[2].innerHTML)
function myFunction() {
    //document.getElementById("showTrimestres").innerHTML = "Hello World";
    alert('hola')
}
</script>*}