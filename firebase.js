// firebase.js
import { initializeApp } from "https://www.gstatic.com/firebasejs/12.7.0/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/12.7.0/firebase-auth.js";
import { getFirestore } from "https://www.gstatic.com/firebasejs/12.7.0/firebase-firestore.js";
// Analytics optional
import { getAnalytics } from "https://www.gstatic.com/firebasejs/12.7.0/firebase-analytics.js";

const firebaseConfig = {
  apiKey: "AIzaSyA2h7YsSA7kncrcTmMgQo2ZUa87IGWF6II",
  authDomain: "meassapp.firebaseapp.com",
  projectId: "meassapp",
  storageBucket: "meassapp.firebasestorage.app",
  messagingSenderId: "758514590574",
  appId: "1:758514590574:web:6f24171592b41d1195d77f",
  measurementId: "G-GTS6EZ5Y6J"
};

// Initialize Firebase
export const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);
export const db = getFirestore(app);

// Analytics (optional – hosting এ কাজ করে)
export const analytics = getAnalytics(app);