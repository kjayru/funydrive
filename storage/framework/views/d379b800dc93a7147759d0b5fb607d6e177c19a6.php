<?php if($options['place']): ?>

	var service = new google.maps.places.PlacesService(<?php echo $options['map']; ?>);
	var request = {
		placeId: '<?php echo $options['place']; ?>'
	};

	service.getDetails(request, function(placeResult, status) {
		if (status != google.maps.places.PlacesServiceStatus.OK) {
			alert('Unable to find the Place details.');
			return;
		}

<?php endif; ?>

<?php if($options['locate'] && $options['marker']): ?>
	if (typeof navigator !== 'undefined' && navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
			marker_0.setPosition(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
		});
	}
<?php endif; ?>

var markerPosition_<?php echo $id; ?> = new google.maps.LatLng(<?php echo $options['latitude']; ?>, <?php echo $options['longitude']; ?>);

var marker_<?php echo $id; ?> = new google.maps.Marker({
	position: markerPosition_<?php echo $id; ?>,
	<?php if($options['place']): ?>
		place: {
			placeId: '<?php echo $options['place']; ?>',
			location: { lat: <?php echo $options['latitude']; ?>, lng: <?php echo $options['longitude']; ?> }
		},
		attribution: {
			source: document.title,
			webUrl: document.URL
		},
	<?php endif; ?>
		
	<?php if(isset($options['draggable']) && $options['draggable'] == true): ?>
		draggable: true,
	<?php endif; ?>
	
	title: <?php echo json_encode((string) $options['title']); ?>,
	label: <?php echo json_encode($options['label']); ?>,
	animation: <?php if(empty($options['animation']) || $options['animation'] == 'NONE'): ?> '' <?php else: ?> google.maps.Animation.<?php echo $options['animation']; ?> <?php endif; ?>,
	<?php if($options['symbol']): ?>
		icon: {
			path: google.maps.SymbolPath.<?php echo $options['symbol']; ?>,
			scale: <?php echo $options['scale']; ?>

		}
	<?php else: ?>
		icon:
		<?php if(is_array($options['icon']) && isset($options['icon']['url'])): ?>
			{
				url: <?php echo json_encode((string) $options['icon']['url']); ?>,

				<?php if(isset($options['icon']['size'])): ?>
					<?php if(is_array($options['icon']['size'])): ?>
						scaledSize: new google.maps.Size(<?php echo $options['icon']['size'][0]; ?>, <?php echo $options['icon']['size'][1]; ?>)
					<?php else: ?>
						scaledSize: new google.maps.Size(<?php echo $options['icon']['size']; ?>, <?php echo $options['icon']['size']; ?>)
					<?php endif; ?>
				<?php endif; ?>
			}
		<?php else: ?>
			<?php echo json_encode($options['icon']); ?>

		<?php endif; ?>
	<?php endif; ?>
});

bounds.extend(marker_<?php echo $id; ?>.position);

marker_<?php echo $id; ?>.setMap(<?php echo $options['map']; ?>);
markers.push(marker_<?php echo $id; ?>);

<?php if($options['place']): ?>

		marker_<?php echo $id; ?>.addListener('click', function() {
			infowindow.setContent('<a href="' + placeResult.website + '">' + placeResult.name + '</a>');
			infowindow.open(<?php echo $options['map']; ?>, this);
		});
	});

<?php else: ?>

	<?php if(!empty($options['content'])): ?>

		var infowindow_<?php echo $id; ?> = new google.maps.InfoWindow({
			content: <?php echo json_encode((string) $options['content']); ?>

		});

		<?php if(isset($options['maxWidth'])): ?>

			infowindow_<?php echo $id; ?>.setOptions({ maxWidth: <?php echo $options['maxWidth']; ?> });

		<?php endif; ?>

		<?php if(isset($options['open']) && $options['open']): ?>

			infowindow_<?php echo $id; ?>.open(<?php echo $options['map']; ?>, marker_<?php echo $id; ?>);

		<?php endif; ?>

		google.maps.event.addListener(marker_<?php echo $id; ?>, 'click', function() {

			<?php if(isset($options['autoClose']) && $options['autoClose']): ?>

				for (var i = 0; i < infowindows.length; i++) {
					infowindows[i].close();
				}

			<?php endif; ?>

			infowindow_<?php echo $id; ?>.open(<?php echo $options['map']; ?>, marker_<?php echo $id; ?>);
		});

		infowindows.push(infowindow_<?php echo $id; ?>);

	<?php endif; ?>

<?php endif; ?>

<?php $__currentLoopData = ['eventClick', 'eventDblClick', 'eventRightClick', 'eventMouseOver', 'eventMouseDown', 'eventMouseUp', 'eventMouseOut', 'eventDrag', 'eventDragStart', 'eventDragEnd', 'eventDomReady']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<?php if(isset($options[$event])): ?>

		google.maps.event.addListener(marker_<?php echo $id; ?>, '<?php echo str_replace('event', '', strtolower($event)); ?>', function (event) {
			<?php echo $options[$event]; ?>

		});

	<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
