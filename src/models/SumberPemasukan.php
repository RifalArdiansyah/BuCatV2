<?php

namespace Models;

class SumberPemasukan extends Model {
    public $id_sumber;
    public $nama;

    public function __construct() {
        parent::__construct();
        $this->table = 'sumber_pemasukan';
    }

    public function save()
    {
        if ($this->id_sumber) {
            $sql = "UPDATE {$this->table} SET nama = :nama WHERE id_sumber = :id_sumber";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_sumber', $this->id_sumber);
        } else {
            $sql = "INSERT INTO {$this->table} (nama) VALUES (:nama)";
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindParam(':nama', $this->nama);
        $stmt->execute();
        if (!$this->id_sumber) {
            $this->id_sumber = $this->db->lastInsertId();
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->table} WHERE id_sumber = :id_sumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_sumber', $this->id_sumber);
        $stmt->execute();
    }

    public function findById($id_sumber)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_sumber = :id_sumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_sumber', $id_sumber);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetch();
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }
}