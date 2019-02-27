DELIMITER //;
/*************************** salaries lookup ***************************************/
DROP PROCEDURE IF EXISTS search;
CREATE PROCEDURE search(IN col VARCHAR(100),tab VARCHAR(50),firstcol VARCHAR(50),firstopt VARCHAR(50),secondcol VARCHAR(50),secondopt VARCHAR(50),divopt VARCHAR(50))
BEGIN
 SET @firstoption=firstopt;
 SET @secondoption=secondopt;
 SET @firstopt="";
 SET @secondopt="";
 SET @searchline="";
 /* checks if there is an option 1 or 2 or both and makes a searchilne*/
 if firstopt!="" THEN SET @firstopt=CONCAT(firstcol," LIKE ? "); SET @searchline=@firstopt; END IF; 
 if secondopt!="" THEN SET @secondopt=CONCAT(secondcol," LIKE ? "); SET @searchline=@secondopt; END IF;
 if @firstopt!="" AND @secondopt!="" THEN SET @searchline=CONCAT(@firstopt,"AND ",@secondopt); END IF;/* two search options*/
 if @searchline!="" THEN SET @searchline=CONCAT(" WHERE ",@searchline); END IF;
 
 /* selecten joiner salaries og tager den sidste opdateret salary i listen*/
 SET @sql = CONCAT("SELECT ",col," FROM ",tab," INNER JOIN (select emp_no, max(salary) AS salary, DATE_FORMAT(max(from_date), '%d-%m-%Y') AS salary_date FROM salaries GROUP BY emp_no) as salaries ON salaries.emp_no=employees.emp_no ",@searchline,divopt);
 PREPARE sql_prep FROM @sql;
 
 if @firstopt!="" AND @secondopt!="" THEN EXECUTE sql_prep USING @firstoption,@secondoption; 
 ELSEIF @firstopt!="" THEN EXECUTE sql_prep USING @firstoption;
 ELSEIF @secondopt!="" THEN EXECUTE sql_prep USING @secondoption;
 END IF;
END //

DELIMITER ;