CREATE TABLE `cleaning` (
  `cleaning_id` int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `room_no` varchar(100) NOT NULL,
  `cleaning_status` varchar(20) NOT NULL,
  `cleaning_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO cleaning (room_no,cleaning_status,cleaning_by)values("101","clean","test");
