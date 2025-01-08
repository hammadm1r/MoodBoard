# MoodBoard - Semester Project

## Overview
MoodBoard is a web application developed as part of a semester project. It allows users to register and input their mood, which is sent as a request to an external AI that generates a poem based on that mood. The generated poetry is then visualized on the user interface. Users can add their favorite poetry quotes to a favorite list and revisit them later.

## Features
- **User Registration:** Users can register with a username, email, and password.
- **Mood Input:** Once logged in, users can input their current mood.
- **AI-generated Poetry:** Upon submitting the mood, a request is sent to an external AI service that returns a poem tailored to the user's mood.
- **Favorite List:** Users can save their favorite quotes and visit them at any time.
- **User Interface:** A simple and responsive UI built using Bootstrap, HTML, and JavaScript.

## Technologies Used
- **Backend:** PHP
- **Frontend:** HTML, Bootstrap, JavaScript
- **Database:** MySQL (XAMPP environment)
- **External AI Service:** Used for generating poetry based on user mood

## Database Structure
- **users Table:** Stores information about the users.
  - `id`: Primary key
  - `username`: The username of the user
  - `email`: The email address of the user
  - `password`: The hashed password of the user
  - `created_at`: The date and time when the user registered
  
- **quotes Table:** Stores the poetry quotes generated for the users.
  - `id`: Primary key
  - `user_id`: Foreign key referencing the user from the `users` table
  - `quote`: The generated poetry quote
  - `mood`: The mood provided by the user
  - `saved_at`: The date and time when the quote was saved to the favorite list

## Setup Instructions
1. **Clone the repository**: 
   ```bash
   git clone https://github.com/hammadm1r/moodboard.git
