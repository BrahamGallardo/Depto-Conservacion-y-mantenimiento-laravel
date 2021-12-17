<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ing->idingreso}}">
	{{Form::Open(array('action'=>array('IngresosController@destroy',$ing->idingreso),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">x</span>
				</button>
				<h4 class="modal-tittle">Cancelar ingresos</h4>
			</div>
			<div class="modal-body">
				<p>Confirme que desea cancelar este ingreso.</p>
				<p>Tome en cuenta que esto no eliminará el ingreso de la base de datos, solo cambiara su estado a 'cancelado'</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-primary" type="submit">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>