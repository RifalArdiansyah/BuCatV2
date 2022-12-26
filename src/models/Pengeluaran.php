<?php

namespace Models;

class Pengeluaran extends Model {
    public $id_pengeluaran;
    public $id_user;
    public $tgl_pengeluaran;
    public $jumlah;
    public $id_jenis;

    public function __construct() {
        parent::__construct();
        $this->table = 'pengeluaran';
    }

    public function save()
    {
        if ($this->id_pengeluaran) {
            $sql = "UPDATE {$this->table} SET id_user = :id_user, tgl_pengeluaran = :tgl_pengeluaran, jumlah = :jumlah, id_jenis = :id_jenis WHERE id_pengeluaran = :id_pengeluaran";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_pengeluaran', $this->id_pengeluaran);
        } else {
            $sql = "INSERT INTO {$this->table} (id_user, tgl_pengeluaran, jumlah, id_jenis) VALUES (:id_user, :tgl_pengeluaran, :jumlah, :id_jenis)";
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->bindParam(':tgl_pengeluaran', $this->tgl_pengeluaran);
        $stmt->bindParam(':jumlah', $this->jumlah);
        $stmt->bindParam(':id_jenis', $this->id_jenis);
        $stmt->execute();
        if (!$this->id_pengeluaran) {
            $this->id_pengeluaran = $this->db->lastInsertId();
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->table} WHERE id_pengeluaran = :id_pengeluaran";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pengeluaran', $this->id_pengeluaran);
        $stmt->execute();
    }

    public function findById($id_pengeluaran)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_pengeluaran = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_pengeluaran);
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
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }

    public function findByUserDate($id_user, $tgl_pengeluaran)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user AND tgl_pengeluaran = $tgl_pengeluaran";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }

    public function findByUserJenis($id_user, $id_jenis)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user AND id_jenis = :id_jenis";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_jenis', $id_jenis);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetchAll();
    }

    public function totalByUser($id_user)
    {
        $sql = "SELECT SUM(jumlah) AS total FROM {$this->table} WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_user);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalByUserDate($id_user, $tgl_pengeluaran)
    {
        $sql = "SELECT SUM(jumlah) AS total FROM {$this->table} WHERE id_user = :id_user AND tgl_pengeluaran $tgl_pengeluaran";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function totalByUserJenis($id_user, $id_jenis)
    {
        $sql = "SELECT SUM(jumlah) AS total FROM {$this->table} WHERE id_user = :id_user AND id_jenis = :id_jenis";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->bindParam(':id_jenis', $id_jenis);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function jenis() {
        return (new JenisPengeluaran)->findById($this->id_jenis);
    }

    public function user() {
        return (new User)->findById($this->id_user);
    }
}