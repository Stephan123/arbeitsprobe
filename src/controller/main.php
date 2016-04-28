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
    protected $params = array();
    protected $request = null;

    /**
     * main constructor.
     *
     * @param $controllerName
     * @param $actionName
     */
    public function __construct($controllerName, $actionName)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;

        // Startparameter
        $this->request = \Flight::request();
        $this->params = \Flight::get('params');
    }

	/**
	 * Übernahme der Startparameter der Action
	 * 
	 * @param array $data
	 * @return $this
	 * @throws \Exception
	 */
    public function setData(array $data)
    {
        try{
            if( (is_array($data)) and (count($data) > 0) )
                $this->data = $data;

            return $this;
        }
        catch(\Exception $e){
            throw $e;
        }
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
