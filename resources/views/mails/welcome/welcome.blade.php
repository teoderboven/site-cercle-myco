@extends('mails.layout')

@section('mainContent')
	<p>
		Bonjour,
	</p>
	<p>
		Votre inscription aux notifications d'activités du Cercle de Mycologie de Bruxelles est confirmée. Nous sommes ravis de votre intérêt&nbsp;!
	</p>
	<p>
		Vous recevrez désormais directement dans votre boîte mail les notifications concernant les activités auxquelles vous vous êtes inscrit(e).
	</p>
	<p>
		Pour être sûr(e) de bien recevoir nos messages, vous pouvez ajouter notre adresse à votre carnet de contacts.
	</p>
	<p>
		Concernant les e-mails envoyés par le Cercle, celui-ci ne vous demandera JAMAIS de mot de passe, de coordonnées bancaires ou de paiement direct par e-mail.<br>
		En cas de doute sur un message suspect, contactez-nous via l'adresse <a href="mailto:support@cercle-myco-bruxelles.be">support@cercle-myco-bruxelles.be</a>.
	</p>
	<p class="c_space_before">
		Vous recevez cet e-mail suite à une demande effectuée sur notre site internet.
	</p>
	<p>
		Si <b>vous n'êtes pas à l'origine de cette demande</b> ou si <b>vous avez reçu ce message par erreur</b>,
		vous pouvez vous désinscrire ou annuler cette demande immédiatement en
		<a href="{{ $subscriber->getUnsubscribeLink() }}" target="_blank">cliquant ici pour vous désinscrire</a>.
	</p>
	<p>
		À bientôt&nbsp;!
	</p>
@endsection

@section('receiveExplanation')
	Vous recevez cet e-mail suite à une demande d'inscription aux notifications du Cercle de Mycologie de Bruxelles.
@endsection

@section('unsubscribeText')
	<a href="{{ $subscriber->getUnsubscribeLink() }}" target="_blank">Se désabonner des e-mails envoyés par le cercle de mycologie</a>
@endsection