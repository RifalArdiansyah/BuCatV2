<?php

namespace Models;

class Pemasukan extends Model {
    public $id_pemasukan;
    public $id_user;
    public $tgl_pemasukan;
    public $jumlah;
    public $id_sumber;

    public function __construct() {
        parent::__construct();
        $this->table = 'pemasukan';
    }

    public function save()
    {
        if ($this->id_pemasukan) {
            $sql = "UPDATE {$this->table} SET id_user = :id_user, tgl_pemasukan = :tgl_pemasukan, jumlah = :jumlah, id_sumber = :id_sumber WHERE id_pemasukan = :id_pemasukan";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_pemasukan', $this->id_pemasukan);
        } else {
            $sql = "INSERT INTO {$this->table} (id_user, tgl_pemasukan, jumlah, id_sumber) VALUES (:id_user, :tgl_pemasukan, :jumlah, :id_sumber)";
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':tgl_pemasukan', $this->tgl_pemasukan);
        $stmt->bindParam(':jumlah', $this->jumlah);
        $stmt->bindParam(':id_sumber', $this->id_sumber);
        $stmt->execute();
        if (!$this->id_pemasukan) {
            $this->id_pemasukan = $this->db->lastInsertId();
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->table} WHERE id_pemasukan = :id_pemasukan";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pemasukan', $this->id_pemasukan);
        $stmt->execute();
    }

    public function findById($id_pemasukan)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_pemasukan = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_pemasukan);
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

    public function findByUser($id_user)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }

    public function findByUserDate($id_user, $tgl_pemasukan)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user AND tgl_pemasukan = $tgl_pemasukan";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }

    public function findByUserSumber($id_user, $id_sumber)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user AND id_sumber = :id_sumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_sumber', $id_sumber);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }

    public function totalByUser($id_user)
    {
        $sql = "SELECT SUM(jumlah) AS total FROM {$this->table} WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalByUserDate($id_user, $tgl_pemasukan)
    {
        $sql = "SELECT SUM(jumlah) AS total FROM {$this->table} WHERE id_user = :id_user AND tgl_pemasukan $tgl_pemasukan";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalByUserSumber($id_user, $id_sumber)
    {
        $sql = "SELECT SUM(jumlah) AS total FROM {$this->table} WHERE id_user = :id_user AND id_sumber = :id_sumber";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_sumber', $id_sumber);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function sumber()
    {
        return (new SumberPemasukan)->findById($this->id_sumber);
    }

    public function user()
    {
        return (new User)->findById($this->id_user);
    }
}