<div class="row" style="margin-top: 5%;">
	<form class="col s4 offset-s4" method="POST" action="/">
		<input type="hidden" name="action" value="create_transaction" />

		<div class="card">
			<div class="card-content">
				<div class="row">
					<span class="card-title">Formulario de pago</span>

					<!-- BANK INTERFACE -->
					<div class="row col s12">
						<p class="col s6 center-align">
							<input type="radio" value="0" name="bankInterface" id="bankInterfacePerson" class="with-gap" checked />
							<label for="bankInterfacePerson">Persona</label>
						</p>

						<p class="col s6 center-align">
							<input type="radio" value="1" name="bankInterface" id="bankInterfaceCompany" class="with-gap" />
							<label for="bankInterfaceCompany">Empresa</label>
						</p>
					</div>

					<!-- DROPDOWN BANKCODE -->
					<div class="input-field col s12">
						<i class="material-icons prefix">account_balance</i>

						<select name="bankCode" id="bankCode">
							<?php foreach( $bankList as $bank ): ?>
								<option value="<?= $bank->bankCode ?>" <?= $bank->bankName === 'Banco Union Colombiano' ? 'selected' : '' ?> class=""><?= $bank->bankName ?></option>
							<?php endforeach ?>
						</select>

						<label for="bankCode">Seleccione un banco</label>
					</div>
					
					<!-- DROPDOWN CURRENCY -->
					<div class="input-field col s12">
						<i class="material-icons prefix">attach_money</i>

						<select name="currency" id="currency">
							<?php foreach( $currencyList as $code => $value ): ?>
								<option value="<?= $code ?>" <?= $code === 'COP' ? 'selected' : '' ?>>(<?= $code ?>) - <?= $value ?><option>
							<?php endforeach ?>
						</select>

						<label for="currency">Tipo de moneda</label>
					</div>
				</div>

				<!-- PAYER INFORMATION -->
				<div class="row">
					<div class="card-title">Información personal</div>

					<!-- FIRSTNAME -->
					<div class="input-field col s6">
						<input name="payer[firstName]" id="firstName" type="text" value="<?= $payer[ 'firstName' ] ?>" class="validate">
						<label for="firstName">Nombres</label>
					</div>

					<!-- LASTNAME -->
					<div class="input-field col s6">
						<input name="payer[lastName]" id="lastName" type="text" value="<?= $payer[ 'lastName' ] ?>" class="validate">
						<label for="lastName">Apellidos</label>
					</div>

					<!-- EMAIL ADDRESS -->
					<div class="input-field col s12">
						<input name="payer[emailAddress]" id="emailAddress" type="text" value="<?= $payer[ 'emailAddress' ] ?>" class="validate">
						<label for="emailAddress">Correo</label>
					</div>

					<!-- DOCUMENT TYPE -->
					<div class="input-field col s12">
						<select name="payer[documentType]" id="documentType">
							<?php foreach( $documentTypes as $code => $value ): ?>
								<option value="<?= $code ?>" <?= $code === 'CC' ? 'selected' : '' ?>><?= $value ?></option>
							<?php endforeach ?>
						</select>

						<label for="documentType">Tipo de documento</label>
					</div>

					<!-- DOCUMENT NUMBER -->
					<div class="input-field col s6">
						<input name="payer[document]" id="document" type="text" class="validate" value="<?= $payer[ 'document' ] ?>">
						<label for="document">Identificaci&oacute;n</label>
					</div>

					<!-- COMPANY -->
					<div class="input-field col s6">
						<input name="payer[company]" id="company" type="text" class="validate" value="<?= $payer[ 'company' ] ?>">
						<label for="company">Empresa</label>
					</div>

					<!-- ADDRESS -->
					<div class="input-field col s12">
						<input name="payer[address]" id="address" type="text" class="validate" value="<?= $payer[ 'address' ] ?>">
						<label for="address">Dirección</label>
					</div>

					<!-- CITY -->
					<div class="input-field col s6">
						<input name="payer[city]" id="city" type="text" class="validate" value="<?= $payer[ 'city' ] ?>">
						<label for="city">Ciudad</label>
					</div>

					<!-- PROVINCE -->
					<div class="input-field col s6">
						<input name="payer[province]" id="province" type="text" class="validate" value="<?= $payer[ 'province' ] ?>">
						<label for="province">Estado/Departamento</label>
					</div>

					<!-- COUNTRY -->
					<div class="input-field col s12">
						<select name="payer[country]" id="country">
							<?php foreach( $countryList as $code => $value ): ?>
								<option value="<?= $code ?>" <?= $code === 'CO' ? 'selected' : '' ?>><?= $value ?></option>
							<?php endforeach ?>
						</select>

						<label for="country">Pa&iacute;s</label>
					</div>

					<!-- PHONE -->
					<div class="input-field col s6">
						<input name="payer[phone]" id="phone" type="tel" class="validate" value="<?= $payer[ 'phone' ] ?>">
						<label for="phone">Tel&eacute;fono</label>
					</div>

					<!-- MOBILE -->
					<div class="input-field col s6">
						<input name="payer[mobile]" id="mobile" type="tel" class="validate" value="<?= $payer[ 'mobile' ] ?>">
						<label for="mobile">Tel&eacute;fono celular</label>
					</div>


					<!-- ERROR -->
					<?php if( $error ): ?>
						<div class="row">
							<div class="col s12 card">
								<div class="card-content red-text">
									<?= $error ?>
								</div>
							</div>
						</div>
					<?php endif ?>

					<button type="submit" class="btn right">Pagar</button>
				</div>
			</div>
		</div>
	</form>
</div>