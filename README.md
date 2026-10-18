# Student Management System

A role-based school management web application built with **Laravel 12** and **MySQL**. It lets an admin manage students and teachers, lets teachers enter exam marks, and gives every student a personal dashboard.

**Live Demo:** https://student-management-system-o8jt.onrender.com/

Admin login
Email Id : sunrisepublicschool01@gmail.com
Password : 12345678

> Note: the app is hosted on a free Render instance, so the first load may take 30-60 seconds to wake up.

---

## Features

### Admin
- Dashboard with total students, active students, new admissions this month, total fees paid and total teachers
- Add, view, edit and delete students (personal details, class, parent details, fees and payment status)
- Add, view, edit and delete teachers
- Create login accounts for teachers (teacher logins are admin-created only)

### Teacher
- Login with admin-created account
- View the student list with class filter and name search (fee details are hidden)
- Enter and update marks per student, per exam and per subject
- Exams: Unit Test, Half Yearly, Annual
- Automatic grade calculation (A+ to F) based on percentage

### Student
- Personal dashboard
- View and edit own personal details

---

## Tech Stack

| Layer      | Technology                         |
|------------|------------------------------------|
| Backend    | PHP 8.3, Laravel 12                |
| Frontend   | Blade templates, HTML, CSS, JS     |
| Database   | MySQL (Aiven in production)        |
| Hosting    | Render                             |
| Auth       | Laravel auth + custom role middleware (`admin`, `teacher`) |

---

## Author

**Rohit Kapoor**
GitHub: [RohitKapoorCode](https://github.com/RohitKapoorCode)
