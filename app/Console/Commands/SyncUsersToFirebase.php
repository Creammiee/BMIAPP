<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\FirebaseService;

class SyncUsersToFirebase extends Command
{
    protected $signature = 'sync:users-firebase';
    protected $description = 'Sync users from MySQL to Firebase Realtime Database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(FirebaseService $firebase)
    {
        $users = User::all();
        $db = $firebase->getDatabase();

        foreach ($users as $user) {
            $db->getReference("users/{$user->id}")
               ->set([
                   'name' => $user->name,
                   'email' => $user->email,
                   'bmi' => $user->bmi,
               ]);
        }

        $this->info('Users synced to Firebase!');
    }
}
