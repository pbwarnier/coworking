<div class="p-customized w-100 h-100">
		<div class="mt-3 w-100 d-flex">
			<ul class="nav nav-pills mx-auto" id="pills-tab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="pills-calendar-tab" data-toggle="pill" href="#calendar" role="tab"
						aria-controls="pills-calendar" aria-selected="true">Agenda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-files-tab" data-toggle="pill" href="#cloud" role="tab"
						aria-controls="pills-cloud" aria-selected="false">Stockage</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="pills-transmissions-tab" data-toggle="pill" href="#transmissions" role="tab"
						aria-controls="pills-transmissions" aria-selected="false">Démarches</a>
				</li>
			</ul>
		</div>
		<!-- navigation JS -->
		<div class="tab-content" id="pills-tabContent">
			<!-- agenda -->
			<div class="tab-pane fade show active" id="calendar" role="tabpanel" aria-labelledby="pills-calendar-tab">
				<div class="p-3 w-100 calendar calendar-weeks-<?= $calendar->getWeeks(); ?>">
					<div class="w-100">
						<div class="w-100 d-flex">
							<div class="mr-auto h4 text-dark"><?= $calendar -> toString(); ?></div>
							<a href="dashboard-<?= $calendar->prevMonth()->month ?>-<?= $calendar->prevMonth()->year; ?>"
								class="ml-auto my-1 btn btn-sm btn-outline-light border-0 text-dark" name="next"><i
									class="far fa-chevron-down"></i></a>
							<a href="dashboard-<?= $calendar->nextMonth()->month; ?>-<?= $calendar->nextMonth()->year; ?>"
								class="my-1 btn btn-sm btn-outline-light border-0 text-dark" name="prev"><i
									class="far fa-chevron-up"></i></a>
						</div>
						<div class="w-100 bg-dark d-flex">
							<?php foreach ($calendar->days as $day) { ?>
							<div class="p-2 w-100 text-light text-center">
								<span class="d-md-block d-none"><?= $day ?></span>
								<span class="d-md-none d-sm-block d-none"><?= substr($day, 0, 3); ?>.</span>
								<span class="d-sm-none d-block"><?= substr($day, 0, 1); ?></span>
							</div>
							<?php } ?>
						</div>
						<div class="w-100 calendar-container">
							<?php for ($i = 0; $i < $calendar->getWeeks(); $i ++) { ?>
							<div class="w-100 calendar-line d-flex">
								<?php
										foreach ($calendar->days as $key => $day) {
											$date = (clone $dayInFirstCase)->modify('+'.($key - 1)+($i * 7).' days');
									?>
								<div class="p-sm-2 p-1 border w-100 h-100 calendar-case <?= $calendar->inMonth($date) ? 'text-dark' : 'text-secondary'; ?>"
									data-calendar="<?= $date->format('Y-m-d'); ?>">
									<?= $date->format('d'); ?>
								</div>
								<?php } ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="bg-light border border-bottom-0 rounded-top event-view">
						<div class="px-1 w-100 d-flex">
							<button class="ml-auto my-1 px-2 py-1 btn-light rounded text-dark border-0" type="button"
								name="close-event"><i class="fal fa-times"></i></button>
						</div>
						<div class="w-100">
							<div id="event-date" class="mx-3 mb-3 p-2 rounded-lg bg-primary text-light text-center">
								<!-- date chargé en JS -->
							</div>
							<div class="px-3 py-2 w-100 event-line">
								<div class="small text-secondary line-height">10:30</div>
								<div class="font-weight-bold line-height">Réunion formateurs</div>
							</div>
							<div class="px-3 py-2 w-100 event-line">
								<div class="small text-secondary line-height">11:30</div>
								<div class="font-weight-bold line-height">Entretien</div>
							</div>
							<div class="p-3 w-100 d-flex">
								<button id="add-event" class="ml-auto btn btn-primary rounded-circle" type="button"><i
										class="fal fa-plus"></i></button>
							</div>
						</div>
					</div>
					<div class="bg-white border border-bottom-0 rounded-top event-details overflow-hidden">
						<div class="px-1 w-100 d-flex">
							<button class="ml-auto my-1 px-2 py-1 btn-light rounded text-dark border-0" type="button"
								name="close-details"><i class="fal fa-times"></i></button>
						</div>
						<div class="px-3 pb-3 w-100">
							<div class="h5">Réunion formateurs</div>
							<div>Le <i>afficher la date</i></div>
							<div>A <i>afficher l'heure</i></div>
							<hr>
							<div class="font-weight-bold">Lieu</div>
							<div><i>Afficher le lieu</i></div>
							<hr>
							<div class="font-weight-bold">Note</div>
							<div><i>Afficher la note</i></div>
						</div>
						<div class="p-3 w-100 d-flex justify-content-end">
							<button class="btn btn-sm btn-outline-danger rounded-pill">Supprimer</button>
						</div>
					</div>
					<div class="bg-white border border-bottom-0 rounded-top add-event overflow-hidden">
						<div class="p-3 w-100">
							<input class="w-100 input-title" type="text" name="name-event"
								placeholder="Ajouter un titre" autocomplete="off">
							<hr>
							<input type="hidden" name="timeEvent">
							<div class="w-100 display-flex">
								<div class='mx-auto' id='clock'></div>
							</div>
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="everyDay" name="everyDay"
									value="1">
								<label class="custom-control-label" for="everyDay">Toute la journée</label>
							</div>
							<hr>
							<input class="border-0 w-100" type="text" name="location" placeholder="Ajouter un lieu">
							<hr>
							<textarea class="w-100 border-0" rows="2" name="notes" placeholder="Ajouter une note"
								style="resize: none;"></textarea>
							<div class="px-1 w-100 d-flex">
								<button class="mx-auto my-1 px-2 py-1 btn-light rounded text-dark border-0"
									type="button" name="close-newEvent">Annuler</button>
								<button class="mx-auto my-1 px-2 py-1 btn-light rounded text-dark border-0"
									type="button" name="save-event">Enregistrer</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- cloud -->
			<div class="tab-pane fade" id="cloud" role="tabpanel" aria-labelledby="pills-files-tab">
				<div class="p-3 w-100 cloud">
					<div style="width: 300px;">
						<div class="text-dark d-flex justify-content-between">
							<div class="small">Espace utilisé</div>
							<div class="small"><?= $fullsize; ?> / 5 Go</div>
						</div>
						<div class="fileSize-progress w-100 rounded-pill">
							<div class="p-bar bg-primary mw-100" role="progressbar" aria-valuenow="1" aria-valuemin="0"
								aria-valuemax="100" style="width: <?= $pourcentData; ?>%;"></div>
						</div>
					</div>
					<button class="btn btn-primary rounded-circle" role="button" name="options"><i
							class="fal fa-plus"></i></button>
				</div>
			</div>
			<!-- administratif -->
			<div class="tab-pane fade" id="transmissions" role="tabpanel" aria-labelledby="pills-transmissions-tab">
				<div class="p-3 w-100">
					<div class="w-100 d-md-flex">
						<div class="mr-md-2 p-3 w-100 bg-light border rounded-lg">
							<div class="h5 mb-3 text-dark">Mes fiches de paies</div>
							<?php
  									if (!empty($list_pay_file)) {
  										foreach ($list_pay_file as $pay_file) {
  								?>
							<div class="mb-1">
								<a href="users/1/fiches_de_paie/<?= $pay_file; ?>" download><?= $pay_file; ?></a>
							</div>
							<?php 
 										} 
 									}
 									else {
 										?><div class="text-secondary">Auncune fiche de paie n'est publié</div><?php
 									}
 								?>
						</div>
						<div class="ml-md-2 mt-md-0 mt-3 p-3 w-100 bg-light border rounded-lg">
							<div class="h5 mb-3 text-dark">Mes plannings</div>
							<?php
  									if (!empty($list_schedule_file)) {
  										foreach ($list_schedule_file as $schedule_file) {
  								?>
							<div class="mb-1">
								<a href="users/1/planning/<?= $schedule_file; ?>" download><?= $schedule_file; ?></a>
							</div>
							<?php 
 										} 
 									}
 									else {
 										?><div class="text-secondary">Auncun planning n'est publié</div><?php
 									}
 								?>
						</div>
					</div>
					<div class="mt-3 w-100 d-md-flex">
						<div class="mr-md-2 p-3 w-100 bg-light border rounded-lg">
							<div class="h5 mb-3 text-dark">Mes demandes de congés</div>
							<div id="daysOff_list" class="w-100">
								<div class="mb-2 px-2 py-1 w-100 bg-blue d-flex justify-content-between">
									<a class="text-dark" href="#">Demande du ... au ...</a>
									<div class="text-danger d-lg-block d-md-none d-sm-block d-none">Refusé</div>
									<div
										class="my-auto led rounded-circle bg-danger d-lg-none d-md-block d-sm-none s-block">
									</div>
								</div>
								<div class="mb-2 px-2 py-1 w-100 bg-blue d-flex justify-content-between">
									<a class="text-dark" href="#">Demande du ... au ...</a>
									<div class="text-warning d-lg-block d-md-none d-sm-block d-none">En traitement</div>
									<div
										class="my-auto led rounded-circle bg-warning d-lg-none d-md-block d-sm-none s-block">
									</div>
								</div>
								<div class="mb-2 px-2 py-1 w-100 bg-blue d-flex justify-content-between">
									<a class="text-dark" href="#">Demande du ... au ...</a>
									<div class="text-success d-lg-block d-md-none d-sm-block d-none">Accepté</div>
									<div
										class="my-auto led rounded-circle bg-success d-lg-none d-md-block d-sm-none s-block">
									</div>
								</div>
							</div>
							<div class="mt-3 w-100">
								<div class="h5 mb-3">Saisir ma demande</div>
								<div class="w-100">
									<form>
										<div class="form-group">
											<div class="w-100 d-lg-flex d-md-block d-sm-flex d-block">
												<div class="w-100">
													Nom : <strong>Nom d'utilisateur</strong>
												</div>
												<div class="w-100">
													Prénom : <strong>Prénom d'utilisateur</strong>
												</div>
											</div>
											<div class="w-100">Section : <strong>Nom de section</strong></div>
										</div>
										<div class="form-group d-flex">
											<div class="w-100 mr-2">
												<label for="statingDate">Date de début</label>
												<input id="startingDate" class="form-control" type="text"
													name="startingDate">
											</div>
											<div class="w-100 ml-2">
												<label for="endingDate">Date de retour</label>
												<input id="endingDate" class="form-control" type="text"
													name="endingDate" disabled="disabled">
											</div>
										</div>
										<div class="form-group">
											<div class="w-100">
												<label for="statingDate">Nombre de jours</label>
												<input class="form-control w-50" min="1" max="35" type="number"
													name="nbDay">
											</div>
										</div>
										<div class="form-group d-lg-flex d-md-block d-sm-flex d-block">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="signature">
												<label class="custom-control-label" for="signature">Signature de
													l'interessé(e)</label>
											</div>
											<div class="ml-auto">
												Fait le <?= date('d/m/Y'); ?>
											</div>
										</div>
										<div class="w-100 d-flex">
											<button id="send-request"
												class="mx-auto px-3 py-1 btn-customized-alternativ rounded-pill"
												type="button" name="send-request">Envoyer</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="ml-md-2 mt-md-0 mt-3 p-3 w-100 bg-light border rounded-lg">
							<div class="h5 mb-3 text-dark">Transmettre un arrêt maladie</div>
							<div class="w-100 h-100 d-flex">
								<div class="m-auto">
									<form action="dashboard.php" method="POST">
										<div class="form-group">
											<input type="file" name="stoppage">
										</div>
										<div class="w-100 d-flex">
											<button class="mx-auto px-3 py-1 btn-customized-alternativ rounded-pill"
												type="submit">Envoyer</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>