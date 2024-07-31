@extends('layouts.default')

@section('title', 'Devenir Membre')

@section('description', 'Découvrez comment devenir membre du Cercle de Mycologie de Bruxelles')

@section('stylesheets')
	<link rel="stylesheet" href="/assets/membre/member.css">
	<link rel="stylesheet" href="/assets/common/css/tip.css">
@endsection

@section('main-content')
	<header>
		<h2 class="title">Envie de devenir membre du Cercle de Mycologie de Bruxelles?</h2>
	</header>
	<div id="main-container">
		<div id="cards-container">
			<section class="card">
				<header>
					<div class="icon alone">?</div>
					<h3 class="title">Pourquoi rejoindre le Cercle?</h3>
				</header>
				<div>
					<p>
						Partagez le plaisir de la découverte de ces êtres mystérieux que sont les champignons en compagnie d'une équipe de passionnés souhaitant partager leurs connaissances.
					</p>
					<p>
						L'affiliation permet de participer à toutes les activités du Cercle.
					</p>
					<p>
						Nos membres ont également accès à toutes les activités de l'association <a href="http://naturalistesbelges.be/" target="_blank">Les&nbsp;Naturalistes Belges</a>.
					</p>
					<p>
						Les membres en règle de cotisation peuvent s'inscrire sur le forum du CMB, lieu d'échange d'informations et de (vos) questions.
						Les demandes d'inscriptions se font auprès de Sabyne Lippens (<a href="mailto:sabyne.lippens&#64;&#103;&#109;&#97;&#105;&#108;&#46;com" class="email">sabyne.lippens&#64;&#103;&#109;&#97;&#105;&#108;&#46;com</a>).
					</p>
					<div class="tip">
						<img src="/assets/common/img/svg/idea.svg" alt="" class="idea" draggable="false">
						<p>
							Il n'est pas nécessaire d'avoir des connaissances mycologiques pour s'inscrire au Cercle. Le désir de mieux connaître le monde des champignons est suffisant. La participation aux activités donne l'occasion aux débutants de s'initier progressivement à la mycologie.
						</p>
					</div>
				</div>
			</section>
			<section class="card">
				<header>
					<div class="icon">-26</div>
					<h3 class="title">Vous êtes un étudiant de moins de 26 ans?</h3>
				</header>
				<div>
					<p>
						Les étudiants, âgés de 26 ans maximum, peuvent participer gratuitement aux activités sur le terrain en faisant parvenir une copie de leur carte d'étudiant par courriel à l'adresse suivante:
						<a href="mailto:cjmathieu&#64;&#111;&#117;&#116;&#108;&#111;&#111;&#107;&#46;fr" class="email">cjmathieu&#64;&#111;&#117;&#116;&#108;&#111;&#111;&#107;&#46;fr</a>
					</p>
				</div>
			</section>
			<section class="card">
				<header>
					<img src="/assets/common/img/svg/check.svg" alt="" class="icon" draggable="false">
					<h3 class="title">Devenez membre</h3>
				</header>
				<div>
					<p>
						Pour devenir membre, il suffit de verser le montant de la cotisation annuelle de <b>10&nbsp;&#8364;</b>, sur le compte
						<span class="value"><b>BE23 3631 7479 9191</b></span>.
					</p>
					<div class="transfer">
						<fieldset>
							<legend>Informations du virement</legend>
							<table>
								<tbody>
									<tr>
										<td>
											<span class="label">Nom du bénéficiaire</span>
										</td>
										<td>
											<span class="value">Cercle de Mycologie de Bruxelles</span>
										</td>
									</tr>
									<tr>
										<td>
											<span class="label">IBAN</span>
										</td>
										<td>
											<span class="value">BE23 3631 7479 9191</span>
										</td>
									</tr>
									<tr>
										<td>
											<span class="label">BIC</span>
										</td>
										<td>
											<span class="value">BBRUBEBB</span>
										</td>
									</tr>
									<tr>
										<td>
											<span class="label">Montant</span>
										</td>
										<td>
											<span class="value">10&nbsp;&#8364;</span>
										</td>
									</tr>
									<tr>
										<td>
											<span class="label">Communication</span>
										</td>
										<td>
											<textarea disabled>*Renseignez votre nom, adresse postale et adresse e-mail*</textarea>
										</td>
									</tr>
								</tbody>
							</table>	
						</fieldset>
						<div class="tip">
							<div class="icon alone">!</div>
							<p>
								N'oubliez pas de spécifier votre nom et adresse e-mail dans la communication du virement!
							</p>
						</div>
					</div>
				</div>
			</section>
			<div id="contact">
				<h2>Informations de contact</h2>
				<fieldset>
					<legend>Secrétariat</legend>
					<p>Claude Mathieu : <a href="tel:+3227620839">tél. 02/762.08.39</a></p>
					<p>courriel : <a href="mailto:cjmathieu&#64;&#111;&#117;&#116;&#108;&#111;&#111;&#107;&#46;fr" class="email">cjmathieu&#64;&#111;&#117;&#116;&#108;&#111;&#111;&#107;&#46;fr</a>
					</p>
				</fieldset>
			</div>
		</div>
		<div id="images-container">
			<img src="/images/groupe/cmbgr10.jpg" alt="">
			<img src="/images/groupe/gr1.jpg" alt="">
			<img src="/images/groupe/2-3ccc.jpg" alt="">
		</div>
	</div>
@endsection