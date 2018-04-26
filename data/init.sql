USE muhousing;

CREATE TABLE halls (
  hallNo int(9) NOT NULL,
  street varchar(30) NOT NULL,
  city varchar(30) NOT NULL,
  zipcode int(5) NOT NULL,
  hallName varchar(30) NOT NULL,
  phoneNo varchar(30) NOT NULL,
  staffNo varchar(9) NOT NULL,
  PRIMARY KEY (hallNo),
  FOREIGN KEY(staffNo) REFERENCES Staff(staffNo)
  );
