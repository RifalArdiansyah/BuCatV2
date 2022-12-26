<?php

namespace Models;

class User extends Model {
    public $id_user;
    public $nama_lengkap;
    public $username;
    public $email;
    public $password;
    public $no_hp;
    public $alamat;
    public $kode_pos;
    public $pekerjaan;
    public $status;
    public $saldo;

    public function __construct() {
        parent::__construct();
        $this->table = 'user';
    }

    public function save()
    {
        if ($this->id_user) {
            $sql = "UPDATE {$this->table} SET nama_lengkap = :nama_lengkap, username = :username, email = :email, password = :password, no_hp = :no_hp, alamat = :alamat, kode_pos = :kode_pos, pekerjaan = :pekerjaan, status = :status, saldo = :saldo WHERE id_user = :id_user";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_user', $this->id_user);
        } else {
            $sql = "INSERT INTO {$this->table} (nama_lengkap, username, email, password, no_hp, alamat, kode_pos, pekerjaan, status, saldo) VALUES (:nama_lengkap, :username, :email, :password, :no_hp, :alamat, :kode_pos, :pekerjaan, :status, :saldo)";
            $stmt = $this->db->prepare($sql);
        }
        $stmt->bindParam(':nama_lengkap', $this->nama_lengkap, \PDO::PARAM_STR);
        $stmt->bindParam(':username', $this->username, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, \PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->password, \PDO::PARAM_STR);
        $stmt->bindParam(':no_hp', $this->no_hp, \PDO::PARAM_STR);
        $stmt->bindParam(':alamat', $this->alamat, \PDO::PARAM_STR);
        $stmt->bindParam(':kode_pos', $this->kode_pos, \PDO::PARAM_STR);
        $stmt->bindParam(':pekerjaan', $this->pekerjaan, \PDO::PARAM_STR);
        $stmt->bindParam(':status', $this->status, \PDO::PARAM_BOOL);
        $stmt->bindParam(':saldo', $this->saldo, \PDO::PARAM_INT);
        $stmt->execute();
        if (!$this->id_user) {
            $this->id_user = $this->db->lastInsertId();
        }
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->table} WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $this->id_user);
        $stmt->execute();
    }

    public function findById($id_user)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id_user = :id_user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetch();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $stmt->fetch();
    }

    public function pengeluaran()
    {
        return (new Pengeluaran())->findByUser($this->id_user);
    }

    public function pemasukan()
    {
        return (new Pemasukan())->findByUser($this->id_user);
    }
}