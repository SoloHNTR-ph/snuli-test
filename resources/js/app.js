import './bootstrap';
import { db } from './firebase';
import { collection, addDoc, serverTimestamp, getDocs, where, getDoc, doc, setDoc, updateDoc } from 'firebase/firestore';
import { getAuth, signOut } from 'firebase/auth';
import bcrypt from 'bcryptjs';

document.addEventListener('DOMContentLoaded', async () => {
  // Function to show modal
  function showModal(message, callback) {
    const modal = document.createElement('div');
    modal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'bg-black', 'bg-opacity-50', 'z-50');
    modal.innerHTML = `
      <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
        <p class="text-gray-800">${message}</p>
        <button id="closeModal" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Close</button>
      </div>
    `;
    document.body.appendChild(modal);

    document.getElementById('closeModal').addEventListener('click', () => {
      document.body.removeChild(modal);
      if (callback) callback();
    });
  }

  // Contact form logic
  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault(); // Prevent default form submission

      // Get form data
      const name = contactForm.name.value.trim();
      const email = contactForm.email.value.trim();
      const message = contactForm.message.value.trim();

      // Basic client-side validation
      if (!name || !email || !message) {
        showModal('Please fill out all fields.');
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
        showModal('Your message has been sent successfully!');
        contactForm.reset();
      } catch (error) {
        console.error('Error adding document: ', error);
        showModal('An error occurred while sending your message.');
      }
    });
  }

  // Function to generate the next user_id
  async function generateUserId() {
    const lastUserIdDoc = doc(db, 'config', 'lastUserId');
    const lastUserIdSnapshot = await getDoc(lastUserIdDoc);

    let newUserId;
    if (lastUserIdSnapshot.exists()) {
      const lastUserId = lastUserIdSnapshot.data().value;
      const lastUserIdNumber = parseInt(lastUserId.slice(2), 10);
      const nextUserIdNumber = lastUserIdNumber + 1;
      newUserId = `te${String(nextUserIdNumber).padStart(6, '0')}`;
    } else {
      newUserId = 'te000001';
      // Create the lastUserId document with the initial value
      await setDoc(lastUserIdDoc, { value: newUserId });
    }

    // Update the lastUserId document with the new user_id
    await updateDoc(lastUserIdDoc, { value: newUserId });

    return newUserId;
  }

  // Registration form logic
  const registerForm = document.getElementById('registerForm');
  if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
      e.preventDefault(); // Prevent default form submission

      // Get form data
      const name = registerForm.name.value.trim();
      const email = registerForm.email.value.trim();
      const password = registerForm.password.value.trim();
      const passwordConfirmation = registerForm.password_confirmation.value.trim();

      // Basic client-side validation
      if (!name || !email || !password || !passwordConfirmation) {
        showModal('Please fill out all fields.');
        return;
      }

      if (password !== passwordConfirmation) {
        showModal('Passwords do not match.');
        return;
      }

      try {
        console.log('Hashing password...');
        // Hash the password
        const hashedPassword = await bcrypt.hash(password, 10);
        console.log('Password hashed successfully.');

        console.log('Generating user_id...');
        // Generate user_id
        const userId = await generateUserId();
        console.log('Generated user_id:', userId);

        console.log('Adding document to Firestore...');
        // Add a new document with a generated id
        await addDoc(collection(db, 'test'), {
          user_id: userId,
          name: name,
          email: email,
          password: hashedPassword, // Store the hashed password
          created_at: serverTimestamp(),
        });
        console.log('Document added successfully.');

        // Show success message and reset form
        showModal('Your account has been created successfully!');
        registerForm.reset();
      } catch (error) {
        console.error('Error during registration:', error);
        showModal('An error occurred while creating your account.');
      }
    });
  }

  // Login form logic
  const loginForm = document.getElementById('signinForm');
  if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault(); // Prevent default form submission

      // Get form data
      const email = loginForm.email.value.trim();
      const password = loginForm.password.value.trim();

      // Basic client-side validation
      if (!email || !password) {
        showModal('Please fill out all fields.');
        return;
      }

      try {
        // Fetch user data from Firestore
        const querySnapshot = await getDocs(collection(db, 'test'), where('email', '==', email));
        if (querySnapshot.empty) {
          showModal('Invalid email or password.');
          return;
        }

        const userDoc = querySnapshot.docs[0];
        const userData = userDoc.data();

        // Compare the password
        const isPasswordValid = await bcrypt.compare(password, userData.password);
        if (!isPasswordValid) {
          showModal('Invalid email or password.');
          return;
        }

        // Store session data
        const response = await fetch('/login/session', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: JSON.stringify({
            name: userData.name,
            email: userData.email,
            user_id: userData.user_id,
            created_at: userData.created_at
          })
        });

        if (!response.ok) {
          throw new Error('Failed to store session');
        }

        // Show success message and redirect
        showModal('You have logged in successfully!', () => {
      // Basic client-side validation
      if (!email || !password) {
        showModal('Please fill out all fields.');
        return;
      }

      try {
        // Fetch user data from Firestore
        const querySnapshot = await getDocs(collection(db, 'test'), where('email', '==', email));
        if (querySnapshot.empty) {
          showModal('Invalid email or password.');
          return;
        }

        const userDoc = querySnapshot.docs[0];
        const userData = userDoc.data();

        // Compare the password
        const isPasswordValid = await bcrypt.compare(password, userData.password);
        if (!isPasswordValid) {
          showModal('Invalid email or password.');
          return;
        }

        // Show success message and redirect
        showModal('You have logged in successfully!', () => {
          window.location.href = '/dashboard'; // Redirect to dashboard or desired page
        });
      } catch (error) {
        console.error('Error logging in: ', error);
        showModal('An error occurred while logging in.');
      }
    });
  }

  // Fetch and display the name of the logged-in user
  const userId = document.body.dataset.userId; // Assuming user ID is stored in a data attribute
  if (userId) {
    try {
      const userDoc = await getDoc(doc(db, 'users', userId));
      if (userDoc.exists()) {
        const userData = userDoc.data();
        document.getElementById('welcomeMessage').textContent = `Welcome, ${userData.name}`;
      }
    } catch (error) {
      console.error('Error fetching user data:', error);
    }
  }

  // Logout functionality
  const logoutForm = document.getElementById('logoutForm');
  if (logoutForm) {
    logoutForm.addEventListener('submit', function(event) {
      event.preventDefault();
      const auth = getAuth();
      signOut(auth).then(() => {
        showModal('You have logged out successfully!', () => {
          window.location.href = '/login'; // Redirect to login page
        });
      }).catch((error) => {
        console.error('Error logging out:', error);
      });
    });
  }
});
