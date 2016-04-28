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
		// Request
		$this->request = \Flight::request();

        $this->controllerName = $controllerName;
        $this->actionName = $actionName;

		if($searchTyp)
			$this->searchTyp = $searchTyp;

		if($searchValue)
			$this->searchValue = $searchValue;
    }

	/**
	 * parsen Inhalt der CSV Datei
	 *
	 * @param $csvPath
	 * @return array
	 */
	protected function parseCsv($csvPath, $filter = false, $filterValue = false)
	{
		$artikel = array();

		$i = 0;
		foreach($csvParser = new \DavidBadura\SimpleCsv\CsvParser($csvPath, ';') as $row){

			// Filter 'ISBN-Nummer'
			if($filter == 'isbn'){
				if( $row['ISBN-Nummer'] != $filterValue )
					continue;
			}

			foreach($row as $key => $value){
				$artikel[$i][$key] = $value;
			}

			$i++;
		}

		return $artikel;
	}
}
