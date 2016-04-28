<?php

namespace controller;

/**
 * Master Controller mit allgemeinen Methoden für die Parent Controller
 *
 * @author Stephan.Krauss
 * @date 28.04.2016
 * @package Controller
 */
class main
{
    protected $controllerName = null;
    protected $actionName = null;
    protected $request = null;
	protected $searchTyp = 'all';
	protected $searchValue = false;

	protected $artikel = array();

	/**
	 * übernahme Steuerungs Parameter
	 *
	 * @param $controllerName
	 * @param $actionName
	 * @param $searchTyp
	 * @param $searchValue
	 */
    public function __construct($controllerName, $actionName, $searchTyp = false, $searchValue = false)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;

		if($searchValue)
			$this->searchTyp = $searchTyp;

		if($searchValue)
			$this->searchValue = $searchValue;

        // Startparameter
        $this->request = \Flight::request();
        $this->params = \Flight::get('params');
    }

	/**
	 * parsen Inhalt der CSV Datei
	 *
	 * @param $csvPath
	 * @return array
	 */
	protected function parseCsv($csvPath)
	{
		$article = array();

		$i = 0;
		foreach($csvParser = new \DavidBadura\SimpleCsv\CsvParser($csvPath, ';') as $row){
			foreach($row as $key => $value){
				$article[$i][$key] = $value;
			}

			$i++;
		}

		return $article;
	}
}
