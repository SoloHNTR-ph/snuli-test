<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Firestore;
use Kreait\Firebase\Exception\FirestoreException;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $firestore;

    public function __construct(Firestore $firestore)
    {
        $this->firestore = $firestore;
    }

    public function storeSessionData(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'user_id' => $request->user_id,
            'created_at' => $request->created_at,
        ];

        try {
            Log::info('Storing session data', $data);
            $this->firestore->database()->collection('sessions')->document($request->user_id)->set($data);
            return response()->json(['success' => true]);
        } catch (FirestoreException $e) {
            Log::error('Error storing session data: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to store session data'], 500);
        } catch (\Exception $e) {
            Log::error('General error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'An unexpected error occurred'], 500);
        }
    }

    public function storeUserData($userId, $name, $email, $hashedPassword)
    {
        $data = [
            'user_id' => $userId,
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'created_at' => now(),
        ];

        try {
            $this->firestore->database()->collection('users')->document($userId)->set($data);
            return response()->json(['success' => true]);
        } catch (FirestoreException $e) {
            Log::error('Error storing user data: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to store user data'], 500);
        } catch (\Exception $e) {
            Log::error('General error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'An unexpected error occurred'], 500);
        }
    }

    public function testFirebaseConnection()
    {
        try {
            $testDoc = $this->firestore->database()->collection('test')->document('testDoc');
            $testDoc->set(['testField' => 'testValue']);
            $docSnapshot = $testDoc->snapshot();

            if ($docSnapshot->exists()) {
                return response()->json(['success' => true, 'data' => $docSnapshot->data()]);
            } else {
                return response()->json(['success' => false, 'error' => 'Document does not exist']);
            }
        } catch (FirestoreException $e) {
            Log::error('Error testing Firebase connection: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to connect to Firebase'], 500);
        } catch (\Exception $e) {
            Log::error('General error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'An unexpected error occurred'], 500);
        }
    }
}