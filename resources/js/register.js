// resources/js/register.js

import { auth, db } from '@/firebase';
import { createUserWithEmailAndPassword, updateProfile } from 'firebase/auth';
import { doc, setDoc, serverTimestamp } from 'firebase/firestore';

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const name = document.getElementById('name').value.trim();
    const confirmPassword = document.getElementById('password_confirmation').value;

    if (password !== confirmPassword) {
      alert("Passwords don't match!");
      return;
    }

    try {
      // Create user with Firebase Auth
      const userCredential = await createUserWithEmailAndPassword(auth, email, password);
      const user = userCredential.user;

      // Update user's display name
      await updateProfile(user, { displayName: name });

      // Save user data in Firestore
      await setDoc(doc(db, 'users', user.uid), {
        email: email,
        username: name,
        role: 'user', // or 'webmaster' if appropriate
        created_at: serverTimestamp(),
      });

      // Show success message
      alert('Registration successful! Redirecting to home page...');

      // Redirect to home or dashboard after successful registration
      window.location.href = '/';
    } catch (error) {
      console.error('Registration error:', error);
      let errorMessage = "An error occurred during registration.";

      switch (error.code) {
        case 'auth/email-already-in-use':
          errorMessage = "Email is already in use.";
          break;
        case 'auth/invalid-email':
          errorMessage = "Invalid email address.";
          break;
        case 'auth/weak-password':
          errorMessage = "Password should be at least 6 characters.";
          break;
        default:
          errorMessage = error.message;
      }

      alert(errorMessage);
    }
  });
});
