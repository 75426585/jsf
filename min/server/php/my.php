<?php
	$data['files'][0]['name'] = $_FILES['files']['name'];
	$data['files'][0]['type'] = $_FILES['files']['type'];
	header('Content-Type:application/json');
	echo json_encode($data);
