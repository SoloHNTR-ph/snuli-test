// resources/js/testRegister.js

import { auth, db } from './firebase';
import { createUserWithEmailAndPassword, updateProfile } from 'firebase/auth';
import { doc, setDoc, serverTimestamp } from 'firebase/firestore';

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('register-form');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Get form data
    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const password = form.password.value;
    const confirmPassword = form['confirm-password'].value;

    // Basic validation
    if (!name || !email || !password || !confirmPassword) {
      alert('Please fill out all fields.');
      return;
    }

    if (password !== confirmPassword) {
      alert('Passwords do not match.');
      return;
    }

    try {
      // Create user with Firebase Auth
      const userCredential = await createUserWithEmailAndPassword(auth, email, password);
      const user = userCredential.user;

      // Update user profile with display name
      await updateProfile(user, { displayName: name });

      // Save user data in Firestore
      await setDoc(doc(db, 'test', user.uid), {
        name: name,
        email: email,
        created_at: serverTimestamp(),
      });

      // Show success message
      alert('Registration successful!');

      // Redirect to home or dashboard
      // window.location.href = '/dashboard';

    } catch (error) {
      console.error('Error during registration:', error);
      alert(error.message);
    }
  });
  // Add console log to check `auth`
console.log('Auth Object:', auth);
});
