<?php

$hashpass = password_hash("John", PASSWORD_BCRYPT);
$triagePass = password_hash("Triage", PASSWORD_BCRYPT);
$nursePass = password_hash("Nurse", PASSWORD_BCRYPT);
$everythingPass = password_hash("Everything", PASSWORD_BCRYPT);

$mysqli = new mysqli("localhost:3306", "root", "root");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

/* check if server is alive */
if ($mysqli->ping()) {
    printf ("Our connection is ok!\n");
} else {
    printf ("Error: %s\n", $mysqli->error);
}

$insertUser = "
USE Clinic;
INSERT INTO USER(USER_ID, HASHED_PASSWORD, RECEPTION) VALUES ('John', '$hashpass', 1);
INSERT INTO USER(USER_ID, HASHED_PASSWORD, TRIAGE) VALUES ('Triage', '$triagePass', 1);
INSERT INTO USER(USER_ID, HASHED_PASSWORD, NURSE) VALUES ('Nurse', '$nursePass', 1);
INSERT INTO USER(USER_NAME, HASHED_PASSWORD, RECEPTION, TRIAGE, NURSE, ADMIN) VALUES ('Everything', '$everythingPass', 1, 1, 1, 1);


INSERT INTO PATIENT(RAMQ_ID, FIRST_NAME, LAST_NAME, PHONE_HOME, PHONE_EMERGENCY, PRIMARY_PHYSICIAN, EXISTING_CONDITIONS, MEDICATION_1, MEDICATION_2, MEDICATION_3) VALUES ('123', 'John', 'SMITH', '555-555-5555', '555-666-6666', 'Doctor Who', 'Awesomeitis', 'Advil', 'Caffeine Pills', 'Coffee');
INSERT INTO QUEUE(QUEUE_NAME, QUEUE_CONTENT) VALUES ('TRIAGE', '');
INSERT INTO QUEUE(QUEUE_NAME, QUEUE_CONTENT) VALUES ('1', '');
INSERT INTO QUEUE(QUEUE_NAME, QUEUE_CONTENT) VALUES ('2', '');
INSERT INTO QUEUE(QUEUE_NAME, QUEUE_CONTENT) VALUES ('3', '');
INSERT INTO QUEUE(QUEUE_NAME, QUEUE_CONTENT) VALUES ('4', '');
INSERT INTO QUEUE(QUEUE_NAME, QUEUE_CONTENT) VALUES ('5', '');

INSERT INTO SYSTEM(CURRENT_POSITION) VALUES (0);
";

$mysqli->multi_query($insertUser);

echo $mysqli->error;

$mysqli->close();
?>
