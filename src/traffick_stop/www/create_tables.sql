CREATE TABLE users ( 
    UserID int NOT NULL AUTO_INCREMENT,
    certification_date timestamp,
    password_hash varchar(255),
    username varchar(255) UNIQUE NOT NULL,
    lastname varchar(255),
    firstname varchar(255),
    phone varchar (12),
    address1 varchar(255),
    address2 varchar(255),
    zipcode int,
    govt_id varchar(255),
    id_type varchar(255),
    admin_id varchar(255),
    is_enabled boolean,
    comments varchar(255)
    role set('reporter','admin','police'),
    PRIMARY KEY (UserID)
);

CREATE TABLE reports (
    ReportID int NOT NULL AUTO_INCREMENT,
    when_created timestamp,
    username varchar(255),
    submit_lat float,
    submit_long float,
    location varchar(255),
    when_occurred varchar (255),
    room_number int,
    media_available set('photo','audio','video'),
    reporter_details blob,
    police_details blob,
    PRIMARY KEY (ReportID)
);

CREATE TABLE people (
    PersonID int NOT NULL AUTO_INCREMENT,
    ReportID int NOT NULL,
    person_type enum('pimp','victim','buyer','witness','other'),
    name varchar(255),
    sex enum('M','F'),
    race varchar (32),
    height_inches int,
    age_low int,
    age_high int,
    build varchar(32),
    hair_color varchar(64),
    hair_length varchar(32),
    eye_color varchar(32),
    clothing varchar(255),
    reporter_details blob,
    police_details blob,
    PRIMARY KEY (PersonID),
    FOREIGN KEY (ReportID) REFERENCES reports (ReportID)
);

CREATE TABLE vehicles (
    VehicleID int NOT NULL AUTO_INCREMENT,
    ReportID int NOT NULL,
    driven_by enum('pimp','victim','buyer','witness','other'),
    color varchar(64),
    make varchar(64),
    model varchar(64),
    plate varchar(8),
    state varchar(2),
    reporter_details blob,
    police_details blob,
    PRIMARY KEY (VehicleID),
    FOREIGN KEY (ReportID) REFERENCES reports (ReportID)
);