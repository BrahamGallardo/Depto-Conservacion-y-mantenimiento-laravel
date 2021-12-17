<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-activar-{{$ing->idingreso}}">
	<form action="/activar" method="GET">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
					<h4 class="modal-tittle">Activar ingresos</h4>
				</div>
				<div class="modal-body">
					<p>Confirme que desea activar este ingreso.</p>
					<p>Esto se debe realizar una vez se haya aprobado la remisión de la solicitud, se ingresarán los articulos a la base de datos y cambiará su estado a 'Realizado'</p>
				</div>
				<div class="modal-footer">
					<button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
					<button class="btn btn-primary" type="submit">Confirmar</button>
				</div>
			</div>
		</div>
	</form>
</div>