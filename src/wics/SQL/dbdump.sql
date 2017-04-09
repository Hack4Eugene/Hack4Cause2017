CREATE TABLE roles (
	type_id 		SERIAL PRIMARY KEY,
	type 			VARCHAR(45) NOT NULL
);

CREATE TABLE users (
	user_id 		SERIAL PRIMARY KEY, 
	username 		VARCHAR(45) NOT NULL, 
	password 		VARCHAR(45) NOT NULL, 
	is_active 		BOOLEAN NOT NULL, 
	salt 			VARCHAR(45) NOT NULL, 
	email 			VARCHAR(45), 
	first_name 		VARCHAR(16), 
	last_name 		VARCHAR(32), 
	address 		VARCHAR(56), 
	phone_home 		VARCHAR(16), 
	phone_cell 		VARCHAR(16), 
	type_id 		SERIAL REFERENCES roles(type_id)
);

CREATE TABLE parents (
	user_id 					SERIAL REFERENCES users(user_id) NOT NULL, 
	worker_id 					SERIAL REFERENCES users(user_id) NOT NULL, 
	ssn 						VARCHAR(45) NOT NULL, 
	birth_date 					DATE NOT NULL, 
	birthplace 					VARCHAR(45) NOT NULL, 
	nationality 				VARCHAR(45) NOT NULL, 
	height_ft 					INTEGER, 
	height_in 					INTEGER, 
	stature 					VARCHAR(45), 
	hair_color 					VARCHAR(16), 
	eye_color 					VARCHAR(8), 
	skin_color 					VARCHAR(8), 
	prefer_sex 					VARCHAR(8), 
	prefer_age 					VARCHAR(45), 
	prefer_sib_group_size 		VARCHAR(16), 
	prefer_sib_group_gender 	VARCHAR(16), 
	prefer_religion 			VARCHAR(45), 
	bio 						VARCHAR(512), 
	prev_foster 				VARCHAR(8), 
	investigation 				VARCHAR(8), 
	inv_date 					DATE, 
	inv_reason 					VARCHAR(45), 
	inv_outcome 				VARCHAR(45), 
	med_gen_condition 			VARCHAR(32), 
	med_last_exam 				DATE, 
	meds 						VARCHAR(128), 
	safe_assess 				VARCHAR(8), 
	fam_checklist 				VARCHAR(8), 
	ann_income 					INTEGER, 
	month_expenses 				INTEGER, 
	ref_name 					VARCHAR(64), 
	ref_addr 					VARCHAR(128), 
	ref_phone 					VARCHAR(16), 
	ref_email 					VARCHAR(45)
);

INSERT INTO roles (type_id, type) VALUES (1, 'Parent');
INSERT INTO roles (type_id, type) VALUES (2, 'Worker');
INSERT INTO roles (type_id, type) VALUES (3, 'Admin');