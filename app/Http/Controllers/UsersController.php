<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class UserController extends Controller
{
    protected $auth;
    protected $firestore;

    public function __construct()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path('path/to/firebase_credentials.json'));

        $this->auth = $firebase->createAuth();
        $this->firestore = $firebase->createFirestore();
    }

    public function createWebmaster(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
            'username' => 'required|string',
        ]);

        try {
            // Create user in Firebase Auth
            $userProperties = [
                'email'      => $data['email'],
                'password'   => $data['password'],
                'displayName' => $data['username'],
            ];

            $createdUser = $this->auth->createUser($userProperties);

            // Set custom claims if needed
            $this->auth->setCustomUserClaims($createdUser->uid, ['role' => 'webmaster']);

            // Store user data in Firestore
            $this->firestore->database()->collection('users')->document($createdUser->uid)->set([
                'email'     => $data['email'],
                'username'  => $data['username'],
                'role'      => 'webmaster',
                'created_at' => time(),
            ]);

            return response()->json(['message' => 'Webmaster created successfully', 'user' => $createdUser], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating user: ' . $e->getMessage()], 500);
        }
    }

    public function getAllUsers()
    {
        try {
            $usersCollection = $this->firestore->database()->collection('users');
            $documents = $usersCollection->documents();

            $users = [];
            foreach ($documents as $document) {
                if ($document->exists()) {
                    $user = $document->data();
                    $user['id'] = $document->id();
                    $users[] = $user;
                }
            }

            return response()->json(['users' => $users]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching users: ' . $e->getMessage()], 500);
        }
    }

    public function getUserById($id)
    {
        try {
            $userDoc = $this->firestore->database()->collection('users')->document($id);
            $snapshot = $userDoc->snapshot();

            if ($snapshot->exists()) {
                $user = $snapshot->data();
                $user['id'] = $snapshot->id();
                return response()->json(['user' => $user]);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching user: ' . $e->getMessage()], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->all();

        try {
            $userDoc = $this->firestore->database()->collection('users')->document($id);

            // Update Firestore user data
            $updates = [];
            if (isset($data['email'])) {
                $updates[] = ['path' => 'email', 'value' => $data['email']];
            }
            if (isset($data['username'])) {
                $updates[] = ['path' => 'username', 'value' => $data['username']];
            }
            if (isset($data['role'])) {
                $updates[] = ['path' => 'role', 'value' => $data['role']];
            }

            if (!empty($updates)) {
                $userDoc->update($updates);
            }

            // Optionally update Firebase Auth user data
            $userProperties = [];
            if (isset($data['email'])) {
                $userProperties['email'] = $data['email'];
            }
            if (isset($data['password'])) {
                $userProperties['password'] = $data['password'];
            }
            if (isset($data['username'])) {
                $userProperties['displayName'] = $data['username'];
            }

            if (!empty($userProperties)) {
                $this->auth->updateUser($id, $userProperties);
            }

            return response()->json(['message' => 'User updated successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating user: ' . $e->getMessage()], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $this->auth->deleteUser($id);

            $userDoc = $this->firestore->database()->collection('users')->document($id);
            $userDoc->delete();

            return response()->json(['message' => 'User deleted successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user: ' . $e->getMessage()], 500);
        }
    }

    public function updateOnlineStatus(Request $request, $id)
    {
        $status = $request->input('status');

        try {
            $userDoc = $this->firestore->database()->collection('users')->document($id);
            $userDoc->update([
                ['path' => 'online', 'value' => $status],
            ]);

            return response()->json(['message' => 'User status updated successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }
}
