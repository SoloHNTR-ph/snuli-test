<?php

namespace App\Services;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseService
{
    private $firestore;

    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'projectId' => env('VITE_FIREBASE_PROJECT_ID'),
            'keyFilePath' => base_path(env('FIREBASE_CREDENTIALS_FILE'))
        ]);
    }

    public function getFirestore()
    {
        return $this->firestore;
    }
}