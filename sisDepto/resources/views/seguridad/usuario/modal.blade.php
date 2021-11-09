<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$usu->id}}">
	{{Form::Open(array('action'=>array('UsuarioController@destroy',$usu->id),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-tittle">Eliminar usuario</h4>
			</div>
			<div class="modal-body">
				<p>Confirme que desea eliminar este usuario.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-primary" type="submit">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>