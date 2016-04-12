<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/04/16
 * Time: 11:34
 */

namespace AppBundle\Model;


use AppBundle\Entity\Classe;
use AppBundle\Entity\Faculte;
use AppBundle\Entity\Filiere;

class FiltreEdudiantModel
{
    /**
     * @var int
     */
    private $annee;
    /**
     * @var Classe
     */
    private $classe;
    /**
     * @var Faculte
     */
    private $faculte;
    /**
     * @var Filiere
     */
    private $filiere;

    /**
     * @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param int $annee
     * @return FiltreEdudiantModel
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Classe
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param Classe $classe
     * @return FiltreEdudiantModel
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Faculte
     */
    public function getFaculte()
    {
        return $this->faculte;
    }

    /**
     * @param Faculte $faculte
     * @return FiltreEdudiantModel
     */
    public function setFaculte($faculte)
    {
        $this->faculte = $faculte;

        return $this;
    }

    /**
     * @return Filiere
     */
    public function getFiliere()
    {
        return $this->filiere;
    }

    /**
     * @param Filiere $filiere
     * @return FiltreEdudiantModel
     */
    public function setFiliere($filiere)
    {
        $this->filiere = $filiere;

        return $this;
    }
    
    
}