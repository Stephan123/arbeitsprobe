<?php
namespace controller;

/**
 * darstellen aller Bücher und Zeitschriften der Bücherverwaltung
 *
 * + alle Zeitschriften und Bücher
 * 		+ gemeinsame Spalten
 * 			+ Titel
 * 			+ ISBN - Nummer
 * 			+ Autoren
* 		+ unterschiedliche Spalten
 * 			+ Erscheinungsdatum ( Zeitschriften )
 * 			+ Kurzbeschreibung ( Bücher )
 *
 * @author Stephan.Krauss
 * @date 28.04.2016
 * @package Controller
 */

class library extends main
{

	public function getArtikel()
	{
		try{
			$csvPaths = \Flight::get('csvPaths');

			switch ($this->searchTyp) {
				case ($this->searchTyp == 'all' || $this->searchTyp == 'titel' || $this->searchTyp == 'name'):
					$zeitschriften = $this->parseCsv($csvPaths['zeitschriften']);
					$buecher = $this->parseCsv($csvPaths['buecher']);
					$artikel = array_merge($zeitschriften, $buecher);

					if($this->searchTyp == 'titel')
						$artikel = $this->sortTitel($artikel, $this->searchValue);

					break;
				case 'isbn':
					$zeitschriften = $this->parseCsv($csvPaths['zeitschriften'], $this->searchTyp, $this->searchValue);
					$buecher = $this->parseCsv($csvPaths['buecher'], $this->searchTyp, $this->searchValue);
					$artikel = array_merge($zeitschriften, $buecher);
					
					break;
			}

			// ergaenzen Artikel um Name, Vorname und EMail
			if(count($artikel) > 0){
				$autoren = $this->parseCsv($csvPaths['autoren']);

				if($this->searchTyp == 'name'){
					$artikel = $this->autorenAnfuegen($artikel, $autoren, $this->searchValue);

					// Artikel die nicht dem Autor zugeordnet sind, werden gelöscht
					$artikel = $this->artikelLoeschen($artikel);
				}
				else
					$artikel = $this->autorenAnfuegen($artikel, $autoren);
			}

			var_dump($artikel);
		}
		catch(\Exception $e){
			throw $e;
		}
	}

	/**
	 * Sortieren der Artikel nach der Spalte 'Titel'
	 *
	 * @param array $artikel
	 * @param $sortierReihenfolge
	 * @return array
	 */
	protected function sortTitel(array $artikel, $sortierReihenfolge)
	{
		$titel = array();

		foreach ($artikel as $key => $row) {
		    $titel[$key] = $row['Titel'];
		}

		if($sortierReihenfolge == 'asc')
			array_multisort($titel, SORT_ASC, $artikel);
		else
			array_multisort($titel, SORT_DESC, $artikel);


		return $artikel;
	}

	protected function autorenAnfuegen(array $artikel,array $autoren, $searchValue = false)
	{
		foreach($artikel as $keyArtikel => $rowArtikel){
			foreach($autoren as $keyAutor => $rowAutor){

				if( (array_key_exists('Autor', $rowArtikel)) and (strstr($rowArtikel['Autor'], $rowAutor['Emailadresse'])) ){
					if( $searchValue ){
						if(strstr($rowAutor['Nachname'], $searchValue))
							$artikel[$keyArtikel]['verfasser'][] = $rowAutor;
					}
					else
						$artikel[$keyArtikel]['verfasser'][] = $rowAutor;
				}

				if(  (array_key_exists('Autoren', $rowArtikel)) and (strstr($rowArtikel['Autoren'], $rowAutor['Emailadresse'])) ){
					if( $searchValue ){
						if(strstr($rowAutor['Nachname'], $searchValue))
							$artikel[$keyArtikel]['verfasser'][] = $rowAutor;
					}
					else
						$artikel[$keyArtikel]['verfasser'][] = $rowAutor;
				}
			}

			unset($artikel[$keyArtikel]['Autor']);
			unset($artikel[$keyArtikel]['Autoren']);
		}

		return $artikel;
	}

	protected function artikelLoeschen(array $artikel)
	{
		foreach($artikel as $key => $row){
			if(count($row) == 3)
				unset($artikel[$key]);
		}

		$artikel = array_merge($artikel);

		return $artikel;
	}
}
