<?php

namespace Models;

class JenisPengeluaran extends Model {
    public $id_jenis;
    public $nama;

    public function __construct() {
        parent::__construct();
        $this->table = 'jenis_pengeluaran';
    }

    public function save()
    {
        if ($this->id_jenis) {
            $sql = "UPDATE {$this->table} SET nama = :nama WHERE id_jenis = :id_jenis";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_jenis', $this->id_jenis);
        } else {
            $sql = "INSERT INTO {$this->table} (nama) VALUES (:nama)";
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindParam(':nama', $this->nama);
        $stmt->execute();
        if (!$this->id_jenis) {
            $this->id_jenis = $this->db->lastInsertId();
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->table} WHERE id_jenis = :id_jenis";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_jenis', $this->id_jenis);
        $stmt->execute();
    }

    public function findById($id_jenis)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_jenis = :id_jenis";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_jenis', $id_jenis);
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