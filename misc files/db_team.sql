
--
-- Database: ` `
--

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS USERS (
  userId		int(11) 	PRIMARY KEY NOT NULL AUTO_INCREMENT	,
  mNumber		varchar(9)	, --only necessary if prev undergrad at MTSU
  Ssn			varchar(9)	, --alt to studentID/password
  Password		varchar(20)	, --set by sys after user submits appl
  BDate			date		,
  Sex			char		CHECK (Sex in ('M','F')),
  Fname			varchar(50)	,
  Minit			char		,
  Lname			varchar(50)	,
  Address		varchar(255),
  Phone_Home	varchar(13)	,
  Phone_Cell	varchar(13)	,
  Email			varchar(50) ,
  username		varchar(20)
) 

INSERT INTO USERS (userId, mNumber, Ssn, Password, BDate, Sex, Fname, Minit, Lname, Address, Phone_Home, Phone_Cell, Email, username ) VALUES
(0,'012345678','012345678','default','1900-01-01','M','John','J','Doe','1600 Pennsylvania Avenue Northwest  Washington, DC 20500','202-456-7041','202-456-7041','jjk2v@mtsu.edu','cpettey'),
(1,'123456789','123456789','cpettey','2012-12-01','F','Chrisila','C','Pettey','1500 Greenland Dr  Murfreesboro, TN 37130','615-898-2397','615-898-2397','cscbp@mtsu.edu','cpettey'),
(2,'112223333','112223333','rbutler','2012-12-01','M','Ralph','M','Butler','1500 Greenland Dr  Murfreesboro, TN 37130','615-898-5948','615-898-2397',' rbutler@mtsu.edu','rbutler'),
(3,'112224444','112224444','zdong','2012-12-01','M','Zhijiang','','Dong','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-904-8428','615-898-2397','zdong@mtsu.edu','zdong'),
(4,'112225555','112225555','cli','2012-12-01','F','Cen','','Li','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-904-8168','615-898-2397','cli@mtsu.edu','cli'),
(5,'112226666','112226666','runtch','2012-12-01','M','Roland','H','Untch','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-898-5047','615-898-2397','untch@mtsu.edu','runtch'),
(6,'112227777','112227777','mhigdon','2012-12-01','F','Michelle','','Hidgon','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-898-2397','615-898-2397','mhigdon@mtsu.edu','mhigdon'),
(7,'112228888','112228888','david','2012-12-01','M','David','N','Goliath','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-898-2397','615-898-2397','david@mtsu.edu','david'),
(8,'112229999','112229999','david2','2012-12-01','M','David','O','Goliath','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-898-2397','615-898-2397','david2@mtsu.edu','david2'),
(9,'113331111','113331111','david3','2012-12-01','M','David','P','Goliath','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-898-2397','615-898-2397','david3@mtsu.edu','david3'),
(10,'113332222','113332222','david4','2012-12-01','M','David','Q','Goliath','1301 E. Main Street, PO Box 48 Murfreesboro, TN 37132','615-898-2397','615-898-2397','david4@mtsu.edu','david4')--,

CREATE TABLE IF NOT EXISTS FACULTY (
	facultyID	int(11) ,
	fRank		varchar(50), --assistant professor, associate professor, professor
	fOffice		varchar(50),
	fPhone		varchar(13),
	website		varchar(255)
	
	FOREIGN KEY(facultyID) REFERENCES USERS(userID)
)

INSERT INTO FACULTY (facultyID, fRank, fOffice, fPhone, website) VALUES 
(1,'Professor','KOM 306','615-898-2397','http://www.cs.mtsu.edu/~pettey/'),
(2,'Professor','KOM 303-C','615-898-5948','http://www.cs.mtsu.edu/~rbutler/'),
(3,'Associate Professor','KOM 354','615-904-8428','http://www.cs.mtsu.edu/~zdong/'),
(4,'Professor','KOM 355','615-904-8168','http://www.cs.mtsu.edu/~cen/'),
(5,'Professor','KOM 353','615-898-5047','http://www.cs.mtsu.edu/~untch/')


CREATE TABLE IF NOT EXISTS GRAD_SECT (
	gsID		int(11) 	
	
	FOREIGN KEY(gsID) REFERENCES USERS(userID)
)
INSERT INTO GRAD_SECT (gsID) VALUES (6)


CREATE TABLE IF NOT EXISTS SYS_ADMIN (
	adminID		int(11)		
	
	FOREIGN KEY(adminID) REFERENCES USERS(userID)
)
INSERT INTO SYS_ADMIN (adminID) VALUES (6)


CREATE TABLE IF NOT EXISTS APPLICANT (
	applicantID			int(11)		,
	applicationID		int(11)		,
	matriculated		boolean		,
	accepted			boolean
	
	FOREIGN KEY(applicationID) REFERENCES APPLICATION(applicationID),
	FOREIGN KEY(applicantID) REFERENCES USERS(userID)
)


CREATE TABLE IF NOT EXISTS CHAIR (
	chairID		int(11)
	
	FOREIGN KEY(chairID) REFERENCES FACULTY(facultyID)
)
INSERT INTO CHAIR (chairID) VALUES (1)


CREATE TABLE IF NOT EXISTS REVIEW (
	recommendation		int(1)	CHECK (decision in (0,1,2,3,4))	,
	reason				char	CHECK (reason in (A,B,C,D,E,F))	,
	comments			varchar(255)	,
	recd_advisor1		varchar(20) ,
	recd_advisor2		varchar(20) ,
	applicantID			int(11) 	
	
	FOREIGN KEY(applicantID) REFERENCES USERS(userID)
)


CREATE TABLE IF NOT EXISTS ADVISOR (
	advisorID	int(11)

	FOREIGN KEY(advisorID) REFERENCES FACULTY(facultyID)
)
INSERT INTO ADVISOR (advisorID) VALUES 
(1), (2), (3), (4), (5)


CREATE TABLE IF NOT EXISTS APPLICATION (
	applicationID			int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT	,
	Date_Received			DATETIME , 
	Prior_Degree			varchar(255) ,
	Degree_Year				year(4) , 
	Degree_GPA				decimal(3,2) CHECK (Degree_GPA between 0.00 AND 4.01),  --(Degree_GPA >= 0.00 AND Degree_GPA <= 4.00),
	Degree_College			varchar(255) ,
	Total_GRE				decimal(4,1) ,
	Verbal_GRE				decimal(3,0) CHECK (Verbal_GRE between 129 and 801), -- 200–800, in 10-point increments ,old||new, 130–170, in 1 point increments
	Analytical_GRE			decimal(2,1) CHECK (Analytical_GRE between 0.0 and 6.1), -- 0-6 in half pt increments
	Quantitative_GRE		decimal(3,0) CHECK (Quantitative_GRE between 129 and 801), -- 200–800, in 10-point increments
	Subject_GRE				decimal(3,0) CHECK (Subject_GRE between 199 and 991), -- 200–990, in 10-point increments
	Review_Status			boolean	,
	letters_rcvd			int(1)	CHECK (letters_rcvd in (0,1,2,3)),
	transcript_rcvd			boolean

	FOREIGN KEY(applicantID) REFERENCES APPLICANT(applicantID)
)


CREATE TABLE IF NOT EXISTS ACCEPTED (
	userID		int(11) 
	
	FOREIGN KEY(applicantID) REFERENCES APPLICANT(applicantID)
)
INSERT INTO ACCEPTED (userID) VALUES
(7),
(8),
(9),
(10)

CREATE TABLE IF NOT EXISTS STUDENT (
	userID			int(11) 		,
	mNumber			varchar(9)		,--assigned once matriculated
	gpa				decimal(2,1)	CHECK (gpa between 0.0 and 4.1),
	admission_year	year(4)			,
	admission_sem	varchar(20)		,
	graduated		boolean			,
	applied_gradn	boolean			,
	cleared_gradn	boolean			,
	advisorID		int(11)
	
	FOREIGN KEY(advisorID) REFERENCES ADVISOR(advisorID),
	FOREIGN KEY(userID) REFERENCES USERS(userID)
)

INSERT INTO STUDENT (userID, mNumber, gpa, admission_year, admission_sem, graduated, applied_gradn, cleared_gradn, advisorID) VALUES
(7,'112228888',3.0,'2009','Spring','false','false','false',1),
(8,'112229999',3.0,'2010','Spring','false','false','false',2),
(9,'113331111',3.0,'2011','Spring','false','false','false',3),
(10,'113332222',3.0,'2012','Spring','false','false','false',4)

CREATE TABLE IF NOT EXISTS ALUMNI (
	alumniID 	int(11)		,--m number
	mNumber		varchar(9)	,
	grad_year	date		,
	gpa			decimal(2,1)
	
	FOREIGN KEY(mNumber) REFERENCES ENROLL(mNumber),
	FOREIGN KEY(alumniID) REFERENCES USERS(userID)
)

CREATE TABLE IF NOT EXISTS LETTER (
	received		boolean	,
	name			varchar(50),
	affiliation		varchar(255),	--college
	title			varchar(255),
	email			varchar(100),
	rating			int(1)	CHECK (rating in (1,2,3,4,5))	,
	status			char 	CHECK (status in ('G','C'))	, --generic, credible
	applicantID		int(11) 
	
	FOREIGN KEY(applicantID) REFERENCES APPLICANT(applicantID)	
)

CREATE TABLE IF NOT EXISTS SECTIONS (
	sectID			int(11) 	PRIMARY KEY NOT NULL AUTO_INCREMENT,
	sectNumber		int(11)		CHECK (sectID > 0 and sectID < 1000),
	courseNumber	varchar(10)	,
	year_offered	year(4)	,
	semester		varchar(10)	CHECK (semester in ('Spring','Summer','Fall')) ,
	time_offered  	varchar(20)	,
	day_offered		varchar(3)	CHECK (day_offered in ('M','T','W','R','MW','MWF','TR')) ,
	
	FOREIGN KEY(courseNumber) REFERENCES COURSE(courseNumber)
)

INSERT INTO SECTIONS (sectID, sectNumber, courseNumber, year_offered, semester,time_offered, day_offered) VALUES
(0,999,'CSCI 5130','2099', 'Fall','MW','2-3:30PM'),
(1,001,'CSCI 5130','2012', 'Fall','MW','4-5:30PM'),
(2,001,'CSCI 5160','2012', 'Fall','MW','6-7:30PM'),
(3,001,'CSCI 5250','2012', 'Fall','MWF','8-9AM'),
(4,001,'CSCI 5300','2012', 'Fall','MWF','10-11AM'),
(5,001,'CSCI 5350','2012', 'Fall','TR','10-11:30AM'),
(6,001,'CSCI 5360','2012', 'Fall','TR','12-1:30PM'),
(7,001,'CSCI 5410','2012', 'Fall','TR','2-3:30PM'),
(8,001,'CSCI 5560','2012', 'Fall','TR','4-5:30PM'),
(9,001,'CSCI 5600','2012', 'Fall','TR','6-7:30PM'),
(10,001,'CSCI 5700','2012', 'Fall','M','6-9PM'),
(11,001,'CSCI 5900','2012', 'Fall','W','6-9PM'),
(12,001,'CSCI 6020','2012', 'Fall','T','6-9PM'),
(13,001,'CSCI 6050','2012', 'Fall','R','6-9PM'),
(14,001,'CSCI 6100','2012', 'Fall','MW','10-11:30AM'),
(15,001,'CSCI 6180','2012', 'Fall','MW','12-1:30PM'),
(16,001,'CSCI 6190','2012', 'Fall','MW','2-3:30PM'),
(17,001,'CSCI 6250','2012', 'Fall','MW','4-5:30PM'),
(18,001,'CSCI 6260','2012', 'Fall','MW','6-7:30PM'),
(19,001,'CSCI 6300','2012', 'Fall','MWF','8-9AM'),
(20,001,'CSCI 6330','2012', 'Fall','MWF','10-11AM'),
(21,001,'CSCI 6350','2012', 'Fall','TR','10-11:30AM'),
(22,001,'CSCI 6430','2012', 'Fall','TR','12-1:30PM'),
(23,001,'CSCI 6450','2012', 'Fall','TR','2-3:30PM'),
(24,001,'CSCI 6560','2012', 'Fall','TR','4-5:30PM'),
(25,001,'CSCI 6600','2012', 'Fall','TR','6-7:30PM'),
(26,001,'CSCI 6620','2012', 'Fall','M','6-9PM'),
(27,001,'CSCI 6640','2012', 'Fall','T','6-9PM'),
(28,001,'CSCI 6700','2012', 'Fall','W','6-9PM'),
(29,001,'CSCI 5130','2013', 'Spring','MW','4-5:30PM'),
(30,001,'CSCI 5160','2013', 'Spring','MW','6-7:30PM'),
(31,001,'CSCI 5250','2013', 'Spring','MWF','8-9AM'),
(32,001,'CSCI 5300','2013', 'Spring','MWF','10-11AM'),
(33,001,'CSCI 5350','2013', 'Spring','TR','10-11:30AM'),
(34,001,'CSCI 5360','2013', 'Spring','TR','12-1:30PM'),
(35,001,'CSCI 5410','2013', 'Spring','TR','2-3:30PM'),
(36,001,'CSCI 5560','2013', 'Spring','TR','4-5:30PM'),
(37,001,'CSCI 5600','2013', 'Spring','TR','6-7:30PM'),
(38,001,'CSCI 5700','2013', 'Spring','M','6-9PM'),
(39,001,'CSCI 5900','2013', 'Spring','T','6-9PM'),
(40,001,'CSCI 6020','2013', 'Spring','W','6-9PM'),
(41,001,'CSCI 6050','2013', 'Spring','R','6-9PM'),
(42,001,'CSCI 6100','2013', 'Spring','MW','10-11:30AM'),
(43,001,'CSCI 6180','2013', 'Spring','MW','12-1:30PM'),
(44,001,'CSCI 6190','2013', 'Spring','MW','2-3:30PM'),
(45,001,'CSCI 6250','2013', 'Spring','MW','4-5:30PM'),
(46,001,'CSCI 6260','2013', 'Spring','MW','6-7:30PM'),
(47,001,'CSCI 6300','2013', 'Spring','MWF','8-9AM'),
(48,001,'CSCI 6330','2013', 'Spring','MWF','10-11AM'),
(49,001,'CSCI 6350','2013', 'Spring','TR','10-11:30AM'),
(50,001,'CSCI 6430','2013', 'Spring','TR','12-1:30PM'),
(51,001,'CSCI 6450','2013', 'Spring','TR','2-3:30PM'),
(52,001,'CSCI 6560','2013', 'Spring','TR','4-5:30PM'),
(53,001,'CSCI 6600','2013', 'Spring','TR','6-7:30PM'),
(54,001,'CSCI 6620','2013', 'Spring','M','6-9PM'),
(55,001,'CSCI 6640','2013', 'Spring','T','6-9PM'),
(56,001,'CSCI 6700','2013', 'Spring','W','6-9PM')


CREATE TABLE IF NOT EXISTS COURSE (
	courseNumber		varchar(10) PRIMARY KEY,			
	courseName			varchar(255),
	courseDescr			varchar(255),
	courseInstrID		int(11) 	,
	primaryPreReq		varchar(10)	,
	secondaryPreReq		varchar(10)	,
	creditHours			int(1)	CHECK (creditHours between 0 and 4) --max credits 3
	
	FOREIGN KEY(courseInstrID) REFERENCES FACULTY(userID),
	FOREIGN KEY(primaryPreReq) REFERENCES COURSE(courseNumber),
	FOREIGN KEY(secondaryPreReq) REFERENCES COURSE(courseNumber)
)

CREATE TABLE IF NOT EXISTS STUDENT_REQ (
	total_hours
	gradHours
	minGPA
)

CREATE TABLE IF NOT EXISTS ENROLL (
	mNumber		varchar(9) ,
	sectID		int(11)	,		
	grade		varchar(2) CHECK (grade in ('A','A-','B+','B','B-','C+','C','F','IP'))
	
	FOREIGN KEY(mNumber) REFERENCES STUDENT(mNumber),
	FOREIGN KEY(sectID) REFERENCES SECTIONS(sectID)
)
INSERT INTO ENROLL (mNumber, sectID, grade) VALUES
('112228888',2,'A-'),
('112228888',3,'B-'),
('112228888',4,'B+'),
('112228888',5,'B+'),
('112228888',12,'A-'), 
('112228888',21,'A-'),
('112228888',14,'B-'),
('112228888',15,'B+'),
('112228888',16,'B+'),
('112228888',17,'B+'),
('112228888',18,'B+'),
('112228888',51,'IP'),
('112229999',2,'A-'),
('112229999',3,'B-'),
('112229999',46,'IP'),
('113331111',2,'A-'),
('113331111',10,'A-'),
('113331111',56,'IP'),
('113332222',4,'B-'),
('113332222',47,'IP')


INSERT INTO COURSE (courseNumber, courseName, courseDescr, courseInstrID, primaryPreReq, secondaryPreReq, creditHours ) VALUES 
('CSCI 5130','Microprocessor Operation and Control' ,'Digital systems based around microprocessors and microcontrollers; including their architecture, logic, memory design, input/output, timing and interfacing.' ,1, , , 3), 
('CSCI 5160','Compiler Design and Software Development','The various phases of a compiler along with grammars, finite automata, regular expressions, LR parsing, error recovery, backward and forward flow analysis, and code optimization. A term project to design and construct a functional compiler required.', 2, , ,3),
('CSCI 5250','Computer Graphics','Topics include vector drawing displays, raster scan displays, input devices and techniques, graphics software, transformations, projections, interpolation, and approximation.',3,,,3),
('CSCI 5300','Data Communication and Networks','Computer network architectures, protocol hierarchies, and the open systems interconnection model. Modeling, analysis, design, and management of hardware and software on a computer network.',4, , ,3),
('CSCI 5350','Introduction to Artificial Intelligence','Principles and applications of artificial intelligence. Principles include search strategies, knowledge representation, reasoning, and machine learning. Applications include expert systems and natural language understanding.',5, , ,3),
('CSCI 5360','Intelligent Robot Systems','Principles & applications of intelligent mobile robotics. Various architectures in basic AI robotics development paradigms & basic techniques for robot navigation. Emphasis on hands-on mobile robot design, construction, programming, and experimentation.',1, , ,3),
('CSCI 5410','Web Technologies','An intensive introduction into current Web technologies including basic HTML, tools for web-page design, XML, client-side methods, and server-side methods. Students will be required to implement several Web-based projects.',2, , ,3),
('CSCI 5560','Data Base Management Systems','The relational and object models of database design along with relational algebras, data independence, functional dependencies, inference rules, normal forms, schema design, modeling languages, query languages, and current literature.',3, , ,3),
('CSCI 5600','Independent Study in Computer Science','Students wishing to enroll must submit a written course/topic proposal to the department prior to the semester in which CSCI 5600 is taken.',4, , ,3),
('CSCI 5700','Software Engineering','Consists of a theoretical and practical component. Topics include: history of software engineering, software development paradigms and life cycles, and computer-aided software engineering (CASE). A team project developed in parallel with theory.',5, , ,3),
('CSCI 5900','Selected Topics in Computer Science','Advanced topics in computer science to be selected and announced at time of class scheduling. May be repeated for up to six credits total.',1, , ,3),
('CSCI 6020','Data Abstraction and Programming Fundamentals','Advanced intro to data abstraction, problem solving, & programming. Programming language concepts, recursion, program development, algorithm design/analysis, data abstraction, objects & fundamental data structures such as stacks, queues, & trees.',2, , ,3),
('CSCI 6050','Computer Systems Fundamentals','Advanced intro to computer systems. Data representations, computer arithmetic, machine-level representations of programs, program optimization, memory hierarchy, linking, virtual memory & memory management, network concepts, & concurrent concepts.',3,'CSCI 6020', ,3),
('CSCI 6100','Analysis of Algorithms','Topics include the analysis and design of algorithms; efficiency of algorithms; design approaches including divide and conquer, dynamic programming, the greedy approach and backtracking; P and NP; and algorithms in many areas of computing.',4, , ,3),
('CSCI 6180','Software Design and Development','State-of-the-art techniques in software design and development; provides a means for students to apply the techniques.',5, , ,3),
('CSCI 6190','Theory of Compilers','Theory of parsing methods as well as symbol table construction, code optimization, run time storage management, and implementation of recursion.',1,'CSCI 5160', ,3),
('CSCI 6250','Advanced Operating Systems','Topics include concurrent processes, name management, resource allocation, protection, advanced computer architecture, and operating systems implementation.',2, , ,3),
('CSCI 6260','Advanced Computer Graphics','Topics include three-dimensional curves and surfaces, projections, hidden line and surface elimination, raster graphics systems, and shading techniques.',3,'CSCI 5250', ,3),
('CSCI 6300','Networks','Computer communications, network architectures, protocol hierarchies, and the open systems interconnection model. Modeling, analysis, and specification of hardware and software on a computer network. Wide area networks and local area networks.',4,'CSCI 5300', ,3),
('CSCI 6330','Parallel Processing Concepts','Parallel processing and programming in a parallel environment. Topics include classification of parallel architectures, actual parallel architectures, design and implementation of parallel programs, and parallel software engineering.',5,'CSCI 6050', ,3),
('CSCI 6350','Selected Topics in Artificial Intelligence','In-depth study of the principal areas of the field: artificial intelligence programming, problem-solving methods, knowledge representation methods, deduction and reasoning, and applications such as natural language processing and expert systems.',1,'CSCI 5350', ,3),
('CSCI 6430','Selected Topics in Parallel Processing','An in-depth investigation of one or more topics in parallel processing. Topic(s) to be selected by the professor. Possible topics include parallel algorithms, programming languages, software engineering, architectures, & parallel applications.',2,'CSCI 6330', ,3),
('CSCI 6450','Operating System Design','Definition, design, and implementation of a significant operating system examining such areas as file systems, process management, memory management, input/output device management, and user interfaces.',3,'CSCI 6250', ,3),
('CSCI 6560','Selected Topics in Database','An in-depth investigation of one or more topics in DB. Topic(s) to be selected by the professor. Possible topics include object-oriented DB systems, distributed DB systems, client-server DB systems, deductive DBs, multimedia DBs, and DB theory.',4,'CSCI 5560', ,3),
('CSCI 6600','Selected Topics in Computer Science',' An in-depth investigation of one or more topics in computer science. Topic(s) to be selected by the professor. Possible topics include search techniques, e.g. genetic algorithms, soft computing, object-oriented software engineering, expert systems.',5, , ,3),
('CSCI 6620','Research Methods in Computer Science','Emphasizes communication skills, creative thinking, problem-solving, & integrating knowledge of prior CS courses. Includes a study of CS research tools. Student selects a research problem w/approval of instructor, review literature, & produce a report.',1, , ,3),
('CSCI 6640','Thesis Research','Selection of research problem, review of pertinent literature, collection & analysis of data, & composition of thesis. Once enrolled, student should register for at least one credit hour of master\'s research each semester until completion. S/U grading.',2,'CSCI 6620', ,3),
('CSCI 6700','Selected Topics in Software Engineering','In-depth investigation of one or more topics in software engineering selected by the professor. Possible topics include rewriting system, graph grammar, formal method, source transformation, software architecture, and reverse engineering.  ',3,'CSCI 5700', ,3)

