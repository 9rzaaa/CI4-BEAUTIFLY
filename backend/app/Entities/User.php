<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    // Automatically hash password if it's being set
    public function setPasswordHash(string $password)
    {
        $this->attributes['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    // Example getter: combine names
    public function getFullName()
    {
        return trim("{$this->attributes['first_name']} {$this->attributes['last_name']}");
    }
}
