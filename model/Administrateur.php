<?php

class Administrateur extends Utilisateur
{
    private $idAdmin, $idUtil;

    /**
     * @return mixed
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * @param mixed $idAdmin
     */
    public function setIdAdmin($idAdmin): void
    {
        $this->idAdmin = $idAdmin;
    }

    /**
     * @return mixed
     */
    public function getIdUtil()
    {
        return $this->idUtil;
    }

    /**
     * @param mixed $idUtil
     */
    public function setIdUtil($idUtil): void
    {
        $this->idUtil = $idUtil;
    }

}