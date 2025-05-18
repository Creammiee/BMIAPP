<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;
use Kreait\Firebase\Database;

class FirebaseService
{
    protected $factory;

    public function __construct()
    {
        $this->factory = (new Factory)
            ->withServiceAccount(storage_path('app/firebase/firebase_credentials.json'))
            ->withDatabaseUri('https://bmiwebapp-35324-default-rtdb.asia-southeast1.firebasedatabase.app');
    }

    public function getDatabase(): Database
    {
        return $this->factory->createDatabase();
    }

    public function getAuth(): Auth
    {
        return $this->factory->createAuth();
    }
}
