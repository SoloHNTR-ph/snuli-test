import { initializeApp } from 'firebase/app';
import { getAuth } from 'firebase/auth';
import { getFirestore } from 'firebase/firestore';

// Firebase configuration
// const firebaseConfig = {
//   apiKey: import.meta.env.VITE_FIREBASE_API_KEY,
//   authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
//   projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID,
//   storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET,
//   messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID,
//   appId: import.meta.env.VITE_FIREBASE_APP_ID,
//   measurementId: import.meta.env.VITE_FIREBASE_MEASUREMENT_ID,
// };

const firebaseConfig = {
    apiKey: 'AIzaSyAwtJHh3C30-BQZQrmTEeaEZnqwG99tD7E', // Replace with your actual API key
    authDomain: 'snuli-hub.firebaseapp.com', // Replace with your actual Auth domain
    projectId: 'snuli-hub', // Replace with your actual Project ID
    storageBucket: 'snuli-hub.firebasestorage.app', // Replace with your actual Storage bucket
    messagingSenderId: '166781891279', // Replace with your actual Messaging sender ID
    appId: '1:166781891279:web:043883f2503ce14e823dba', // Replace with your actual App ID
    measurementId: 'G-YBV54D1FLS', // Replace with your actual Measurement ID
  };

// Log the configuration to verify it's loaded correctly
console.log('Firebase Config:', firebaseConfig);

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Firebase services
const auth = getAuth(app);
const db = getFirestore(app);

// Export the services
export { auth, db };
