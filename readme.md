CSCI 4560: Term Project
Banner++: CS Student Admissions, Records, and Registration System1
1. Summary
The project is to implement an on-line admissions and graduation clearance system for graduate students applying to the Computer Science department. In this project you will design a system that will automate the workflow process in the admissions, registration and graduation system for Master degree students.
We can identify a number of key applications that need to be implemented:
• Online Application Process
o A graduate applicant goes to a website and enters their information into the database. Applicants can check their application status online – the status is one of three (i) application incomplete (ii) application complete and under review and (iii) decision (admit or reject).
• Admissions Process
o The graduate admissions committee reviews applications and makes a decision -- Admit, Admit with Aid, or Reject. We want this review process to be automated, wherein the faculty reviewer can enter their scores into a review form.
• Online Registration
o Admitted students enroll at university (i.e., matriculate) and are now considered Graduate students. Once the student joins the university, they will use an online registration system to register for courses and their transcript is recorded in the database (courses and grades).
• Graduation Process
o Each student fills out an online Form which lists the courses they will take to meet graduation requirements. When the student applies for graduation, the system must check to see if all graduation requirements are met. Once they are met, and the student is cleared to graduate they are then added to an alumni list. For simplicity, we will only consider graduation clearance for the Master program.
Details of the applications and on the type of data (and the forms used for review) are provided next.
1 The original project is from http://www.seas.gwu.edu/~bhagiweb/cs146/project/project-phase1.html