/*Test Data Set*/

-- User
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('dua', 'dua@x.com','1234','4000 0000 0000 0001');
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('wang', 'wang@x.com', '2345', '4000 0000 0000 1110');
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('zhu', 'zhu@x.com', '3456', '4101 0000 0000 0001');
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('jin', 'jin@x.com', '4567', '4010 9987 1123 5864');
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('tian', 'tian@x.com', '5678', '4100 0593 9874 1123');
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('zhang', 'zhang@x.com', '6789', '4000 3929 6849 1234');
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('hu', 'hu@x.com', '7890', '4194 1000 1234 6664');
INSERT INTO `user` (`uname`, `uemail`, `password`, `credit`) VALUES 
					('han', 'han@x.com', '8901', '4123 9980 1234 9868');
                    
-- Project
INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
					('zhu', '2017-04-17', '2017-09-17', 1000, 5000, 50, 'the dog king board game', 'FUNDING', 'strategy game');
INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
					('dua', '2017-05-01', '2017-06-30', 10000, 20000, 10500, 'Brooklyn Bridge alblem', 'FUNDED', 'jazz music');
INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
					('zhang', '2016-10-20', '2017-02-20', 5000, 150000, 3000, '2b model', 'FAIL', 'model game');
INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
					('hu', '2017-01-30', '2017-06-15', 2000, 5000, 0, 'a jazz musician', 'FUNDING', 'oil painting');
INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
					('han', '2016-10-01', '2017-04-16', 50000, 150000, 150, 'Ultra Era Concert', 'FAIL', 'jazz pop rock blues folk');
INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
					('dua', '2017-06-01', '2019-04-01', 20000000, 100000000, 50000, 'The golden cudgel', 'FUNDING', 'skyscraper building design');
INSERT INTO `project` (`uname`, `startDate`, `endDate`, `minAmount`, `maxAmount`, `curAmount`, `pname`, `status`, `tags`) VALUES 
					('hu', '2017-03-12', '2017-08-01', 5000, 10000, 10000, 'aerial fight club', 'FULL', 'sculpture');
                    
-- Progress
INSERT INTO `progress` (`pid`, `version`) VALUES (1001, 0.2);
INSERT INTO `progress` (`pid`, `version`) VALUES (1001, 0.5);
INSERT INTO `progress` (`pid`, `version`) VALUES (1001, 0.51);
INSERT INTO `progress` (`pid`, `version`) VALUES (1006, 0.1);
INSERT INTO `progress` (`pid`, `version`) VALUES (1006, 0.2);

-- Sponsor
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1000, 'jin', 50, 'WAIT');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1001, 'jin', 500, 'CHARGED');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1002, 'jin', 3000, 'CLOSED');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1004, 'jin', 150, 'WAIT');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1005, 'jin', 10000, 'WAIT');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1006, 'jin', 2000, 'CHARGED');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1001, 'tian', 5000, 'CHARGED');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1001, 'zhang', 5000, 'CHARGED');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1005, 'hu', 15000, 'WAIT');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1005, 'zhu', 25000, 'WAIT');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1006, 'han', 3000, 'CHARGED');
INSERT INTO `sponsor` (`pid`, `uname`, `amount`, `pledgeStatus`) VALUES 
					  (1006, 'dua', 5000, 'CHARGED');
                      
-- Follower
INSERT INTO `follower` (`uname`, `funame`) VALUES ('zhu', 'jin');
INSERT INTO `follower` (`uname`, `funame`) VALUES ('dua', 'jin');
INSERT INTO `follower` (`uname`, `funame`) VALUES ('zhang', 'jin');
INSERT INTO `follower` (`uname`, `funame`) VALUES ('dua', 'tian');
INSERT INTO `follower` (`uname`, `funame`) VALUES ('zhange', 'hu');
INSERT INTO `follower` (`uname`, `funame`) VALUES ('han', 'zhang');

-- notification Test
INSERT INTO `notification` (`uname`, `pid`, `description`) VALUES ('dua', '1000', 'TestTest');