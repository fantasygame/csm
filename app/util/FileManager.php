<?php

/**
 * Description of FileManager
 *
 * @author kuba
 */
class FileManager
{

	private $defaultTypes = array(
		'image/bmp',
		'image/gif',
		'image/jpeg',
		'image/png',
		'image/tiff',
		'text/plain',
		'application/excel',
		'application/msword',
		'application/mspowerpoint',
		'application/pdf',
		'application/powerpoint',
		'application/rtf',
		'application/zip',
		'application/vnd.oasis.opendocument.text',
		'application/vnd.oasis.opendocument.spreadsheet',
		'application/vnd.oasis.opendocument.presentation',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	);

	public function saveFromRequest($field, $catalog, $acceptedTypes = null)
	{
		if (is_null($acceptedTypes)) {
			$acceptedTypes = $this->defaultTypes;
		}
		$config = SimpleConfig::getInstance();
		$files = $config->request->getFiles();
		$newFiles = array();
		for ($i = 0; $i < count($files[$field]['name']); $i++) {
			if (empty($files[$field]['name'][$i])) {
				continue;
			}
			$type = $files[$field]['type'][$i];
			if (!in_array($type, $acceptedTypes)) {
				throw new Exception("Niedozwolony typ pliku ($type)");
			}
			$tempName = $files[$field]['tmp_name'][$i];
			$name = $files[$field]['name'][$i];
			$filename = uniqid().'_'.$name;
			$catalog = rtrim($catalog, '/');
			$newFiles[] = new File(null, $name, $filename, $catalog, $type);
			$destination = "$catalog".'/'."$filename";
			file_put_contents($destination, '');
			if (!move_uploaded_file($tempName, $destination)) {
				throw new Exception("Upload pliku $name się nie powiódł");
			}
		}
		return $newFiles;
	}

}

?>
