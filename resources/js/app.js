import './bootstrap';
// import 'flowbite';

// resources/js/app.js

import './bootstrap';
import { db } from './firebase';
import { collection, addDoc, serverTimestamp } from 'firebase/firestore';

document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('contact-form');

  form.addEventListener('submit', async (e) => {
    e.preventDefault(); // Prevent default form submission

    // Get form data
    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const message = form.message.value.trim();

    // Basic client-side validation
    if (!name || !email || !message) {
      alert('Please fill out all fields.');
      return;
    }

    try {
      // Add a new document with a generated id
      await addDoc(collection(db, 'form'), {
        name: name,
        email: email,
        message: message,
        created_at: serverTimestamp(),
      });

      // Show success message and reset form
      alert('Your message has been sent successfully!');
      form.reset();
    } catch (error) {
      console.error('Error adding document: ', error);
      alert('An error occurred while sending your message.');
    }
  });
});
