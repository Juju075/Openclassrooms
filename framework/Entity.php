<?php

namespace Entity;

abstract class Entity 
{
    public function __construct(array $data)
    {
    	$this->hydrate($data);
    }

    public function hydrate(array $data)
    {
		foreach ($data as $key => $value)
		{

		    $key = lcfirst(str_replace('_', '', ucwords($key, '_')));
			$method = 'set'.ucfirst($key);

			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
    }

    public function getFormattedDateTime($date)
    {
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8','fra');
        $date = new \DateTime($date);
        $date = strftime("%d %B %Y à %Hh%M", $date->getTimeStamp());
        
        return $date;
    }
}
