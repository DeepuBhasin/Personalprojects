<div class="row">
	<div class="col-12">
		<ol>
			<?php if($faces){
				foreach($faces as $key=>$value){?>
				?>
				<li>
					<strong> Face <?= $key + 1?> </strong>
					<hr>
					<div class="row">
						<div class="col-6">
							 <strong>Joy</strong>

						</div>
						<div class="col-6">
							 <strong><?= $face->info()['joyLikelihood'];?></strong>

						</div>
					</div>
					<div class="row">
						<div class="col-6">
							 <strong>Sorrow</strong>

						</div>
						<div class="col-6">
							 <strong><?= $face->info()['sorrowLikelihood'];?></strong>

						</div>
					</div>
					<div class="row">
						<div class="col-6">
							 <strong>Surprised</strong>

						</div>
						<div class="col-6">
							 <strong><?= $face->info()['surpriseLikelihood'];?></strong>

						</div>
					</div>
					<div class="row">
						<div class="col-6">
							 <strong>Blurred</strong>

						</div>
						<div class="col-6">
							 <strong><?= $face->info()['blurredLikelihood'];?></strong>

						</div>
					</div>
					<div class="row">
						<div class="col-6">
							 <strong>Headwear</strong>

						</div>
						<div class="col-6">
							 <strong><?= $face->info()['headwearLikelihood'];?></strong>

						</div>
					</div>
				</li>
			<?php }}?>
		</ol>
	</div>
</div>