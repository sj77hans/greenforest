<?php
    include('../include/dbconn.inc.php');

	include('./class.fileuploader.php');
    
	// mysqli connection
	$DB = $conn;
	
	$uploadDir = 'uploads/';
	$realUploadDir = '../uploads/';
	$_action = isset($_GET['type']) ? $_GET['type'] : '';
	function getRealFile($file) {
		global $uploadDir, $realUploadDir;
		
		return str_replace($uploadDir, $realUploadDir, $file);
	}

	// upload
	if ($_action == 'upload') {
		$id = false;
		$title = 'auto';

		// if after editing
		if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['_editorr'])) {
			$_id = $DB->real_escape_string($_POST['id']);
			
			$query = $DB->query("SELECT file FROM gallery WHERE id = '$_id'");
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$id = $_id;
				$pathinfo = pathinfo($row['file']);
				
				$realUploadDir = getRealFile($pathinfo['dirname'] . '/');
				$title = $pathinfo['filename'];
			} else {
				exit;
			}
		}

		// initialize FileUploader
		$FileUploader = new FileUploader('files', array(
			'limit' => 1,
			'fileMaxSize' => 20,
			'extensions' => array('image/*', 'video/*', 'audio/*'),
			'uploadDir' => $realUploadDir,

			'required' => true,
			'title' => $title,
			'replace' => $id,
			'editor' => array(
				'maxWidth' => 1980,
				'maxHeight' => 1980,
				'crop' => false,
				'quality' => 90
			)
		));

		$upload = $FileUploader->upload();
		
		if (count($upload['files']) == 1) {
			$item = $upload['files'][0];
			$title = $DB->real_escape_string($item['name']);
			$type = $DB->real_escape_string($item['type']);
			$size = $DB->real_escape_string($item['size']);
			$file = $DB->real_escape_string($uploadDir . $item['name']);
			
			if (!$id)
				$query = $DB->query("INSERT INTO gallery(`title`, `file`, `type`, `size`, `index`, `date`) VALUES('$title', '$file', '$type', '$size', 1 + (SELECT IFNULL((SELECT MAX(`index`) FROM gallery g), -1)), NOW())");
			else
				$query = $DB->query("UPDATE gallery SET `size` = '$size' WHERE id = '$id'");
			
			if ($id || $query) {
				$upload['files'][0] = array(
					'title' => $item['title'],
					'name' => $item['name'],
					'size' => $item['size'],
					'size2' => $item['size2'],
					'url' => $file,
					'id' => $id ? $id : $DB->insert_id
				);
			} else {
				if (is_file($item['file']))
					@unlink($item['file']);
				unset($upload['files'][0]);
				$upload['hasWarnings'] = true;
				$upload['warnings'][] = 'An error occured.';
			}
		}
		
		echo json_encode($upload);
		exit;
	}
	
	// preload
	if ($_action == 'preload') {
		$preloadedFiles = array();
		
		$query = $DB->query("SELECT * FROM gallery ORDER BY `index` ASC");
		if ($query && $query->num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				$preloadedFiles[] = array(
					'name' => $row['title'],
					'type' => $row['type'],
					'size' => $row['size'],
					'file' => $row['file'],
					'data' => array(
						'readerForce' => true,
						'url' => $row['file'],
						'date' => $row['date'],
						'isMain' => $row['is_main'],
						'listProps' => array(
							'id' => $row['id'],
						)
					),
				);
			}
		}

		echo json_encode($preloadedFiles);
		exit;
	}
	
	// sort
	if ($_action == 'sort') {
		if (isset($_POST['list'])) {
			$list = json_decode($_POST['list'], true);
			
			$index = 0;
			foreach($list as $val) {
				if (!isset($val['id']) || !isset($val['name']) || !isset($val['index']))
					break;
				
				$id = $DB->real_escape_string($val['id']);
				$DB->query("UPDATE gallery SET `index` = '$index' WHERE id = '$id'");
				$index++;
			}
		}
		exit;
	}

	// asmain
	if ($_action == 'asmain') {
		if (isset($_POST['id']) && isset($_POST['name'])) {
			$id = $DB->real_escape_string($_POST['id']);
			
			$query = $DB->query("UPDATE gallery SET is_main = 0");
			$query = $DB->query("UPDATE gallery SET is_main = 1 WHERE id = '$id'");
		}
		exit;
	}

	// remove
	if ($_action == 'remove') {
		if (isset($_POST['id']) && isset($_POST['name'])) {
			$id = $DB->real_escape_string($_POST['id']);
			
			$query = $DB->query("SELECT file FROM gallery WHERE id = '$id'");
			
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$file = str_replace($uploadDir, $realUploadDir, $row['file']);
				
				$DB->query("DELETE FROM gallery WHERE id = '${id}'");
				if (is_file($file))
					unlink($file);
			}
		}
		exit;
	}