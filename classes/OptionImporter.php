<?php


/**
 * polls extension for Contao Open Source CMS
 *
 * Copyright (C) 2013 Codefog
 *
 * @package polls
 * @link    http://codefog.pl
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license LGPL
 */

namespace Polls;

/**
 * Class OptionImporter
 *
 * Provide methods to import options
 * @copyright  Martin Kozianka 2013
 * @author     Martin Kozianka <http://kozianka.de/>
 * @package    Controller
 */

class OptionImporter extends \Backend {
    private $key;
    private $now;
	private $tmpl;
	
	public function __construct() {
		parent::__construct();

		$this->loadLanguageFile('tl_poll');
		
		$this->import('String');
		$this->import('Files');

        $this->now     = time();
        $this->sortVal = 0;
		$this->key     = $this->Input->get('key');
		$this->tmpl    = new \BackendTemplate('be_poll_option_importer');
		
		if (in_array($this->key, array('import'))) {

			$this->tmpl->key    = $this->key;
			$this->tmpl->title  = $GLOBALS['TL_LANG']['tl_poll_option'][$this->key][0];
			$this->tmpl->action = ampersand($this->Environment->request, true);
			$this->tmpl->formId = 'tl_poll_'.$this->key;
			
			$this->tmpl->back   = (Object) array(
					'href'   => ampersand(str_replace('&key='.$this->key, '', $this->Environment->request)),
					'label'  => $GLOBALS['TL_LANG']['MSC']['backBT']
			);

			$this->tmpl->btn_submit  = $GLOBALS['TL_LANG']['tl_poll_option'][$this->key][0];
			$this->tmpl->btn_cancel  = $GLOBALS['TL_LANG']['MSC']['cancelBT'];
			$this->tmpl->messages    = \Message::generate();
			
			// cancel
			if ($this->tmpl->btn_cancel === $this->Input->post('save')) {
				$this->redirect($this->tmpl->back->href);
			}
				
		}
	}

	public function importOptions() {
		if ($this->key != 'import') {
			return '';
		}
		
		if ($this->Input->post('FORM_SUBMIT') == $this->tmpl->formId) {
			$this->doImport();
			$this->redirect($this->Environment->request);
		}
		return $this->tmpl->parse();
	}

	private function doImport() {
		$pollId     = intval($this->Input->get('id'));
		$options    = $this->Input->post('options');

		$values = $this->getValues($pollId);
		$arr    = array_map("trim", explode("\n", $options));

		foreach($arr as $value) {
            if (!in_array($value, $values) && strlen($value) > 0) {
				$values[]  = $this->insertEntry($pollId, $value);
			}
		}

        \Message::add($GLOBALS['TL_LANG']['tl_poll_option']['imported'], 'TL_INFO');
		$this->redirect($this->tmpl->back->href);
	}

	private function insertEntry($pollId, $value) {
        $this->sortVal++;
		$result    = $this->Database->prepare(
                "INSERT INTO tl_poll_option (pid, tstamp, title, published, sorting) VALUES (?,?,?,?,?)")
				->execute($pollId, $this->now, $value, '1', $this->sortVal);
		return $value;
	}
	
	private function getValues($id) {
        $this->sortVal = 0;
		$values          = array();
		$result          = $this->Database->prepare("SELECT * FROM tl_poll_option WHERE pid = ?")->execute($id);
		while($result->next()) {
            $this->sortVal = ($result->sorting > $this->sortVal) ? $result->sorting : $this->sortVal;
			$values[]      = $result->title;
		}
		return $values;
	}
}
