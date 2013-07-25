ALTER TABLE  `users` ADD  `role` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `password`
UPDATE  `project1`.`users` SET  `role` =  'Administrator' WHERE  `users`.`id` =1;

INSERT INTO  `project1`.`users` (
`id` ,
`username` ,
`password` ,
`role` ,
`first_name` ,
`last_name` ,
`created_by` ,
`created_date`
)
VALUES (
NULL ,  'agent', MD5(  'agent' ) ,  'Agent',  'agent',  'test',  '',  '2013-07-25'
);