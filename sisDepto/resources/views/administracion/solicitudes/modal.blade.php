<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$soli->idsolicitud}}">
	{{Form::Open(array('action'=>array('SolicitudController@destroy',$soli->idsolicitud),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-tittle">Eliminar solicitud</h4>
			</div>
			<div class="modal-body">
				<p>Confirme que desea eliminar esta solicitud.</p>
				<p>Tome en cuenta que esto no eliminará la solicitud de la base de datos, solo cambiara su estado a 'No procede'</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-primary" type="submit">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>