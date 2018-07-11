@csrf
<div class="form-group">
	<label>Compte :</label>
	<input type="number" name="account_invoice" class="form-control" @if(isset($ticket)) value="{{ $ticket->account_invoice }}" @endif>
</div>

<div class="form-group">
	<label>Facture n° :</label>
	<input type="number" name="invoice_id" class="form-control" @if(isset($ticket)) value="{{ $ticket->invoice_id }}" @endif>
</div>

<div class="form-group">
	<label>Identifiant du client :</label>
	<input type="number" name="customer_id" class="form-control" @if(isset($ticket)) value="{{ $ticket->customer_id }}" @endif>
</div>

<div class="form-group">
	<label>Date :</label>
	<input name="date" class="datepicker form-control" @if(isset($ticket)) value="{{ \Carbon\Carbon::parse($ticket->date)->format('d/m/y') }}" @endif>
</div>

<div class="form-group">
	<label>Heure :</label>
	<input name="time" class="form-control" @if(isset($ticket)) value="{{ $ticket->time }}" @endif>
</div>


<div class="form-group">
	<label>Duree réel :</label>
	<input name="duration" class="form-control" @if(isset($ticket)) value="{{ $ticket->duration }}" @endif>
</div>

<div class="form-group">
	<label>Duree facture:</label>
	<input name="duration_invoice" class="form-control" @if(isset($ticket)) value="{{ $ticket->duration }}" @endif>
</div>

<div class="form-group">
	<label>Type :</label>
	<select name="type" class="form-control">
		<option value="connexion 3G">connexion 3G</option>
		<option value="appel vers SFR">appel vers SFR</option>
		<option value="envoi de sms depuis le mobile">envoi de sms depuis le mobile</option>
		<option value="connexion 3G/3G+">connexion 3G/3G+</option>
		<option value="rappel de votre correspondant">rappel de votre correspondant</option>
		<option value="appel émis vers GSM Suisse">appel émis vers GSM Suisse</option>
		<option value="appels internes">appels internes</option>
	</select>
</div>