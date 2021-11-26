<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$art->idarticulos}}">
	{{Form::Open(array('action'=>array('ArticuloController@destroy',$art->idarticulos),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-tittle">Eliminar articulo</h4>
			</div>
			<div class="modal-body">
				<p>Confirme que desea eliminar este trabajador.</p>
				<p>Tome en cuenta que esto no eliminará al trabajador de la base de datos, solo cambiara su estado a 'inactivo'</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-primary" type="submit">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>