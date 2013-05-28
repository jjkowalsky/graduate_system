<?php
// include("header.php");

  $gpa_funtion_query = "
  CREATE FUNCTION calculateGPA 
    ( 
    @mNumber varchar(9) 
    )
  RETURNS decimal(2,1)
  AS
  BEGIN
  --cursor iterates through enrolled classes & sum grade points earned(GPE) based on grade(a,b,c,d,f)
    DECLARE grade_cur CURSOR 
      FOR SELECT grade FROM ENROLL WHERE mNumber = @mNumber;
    DECLARE @totalGPE decimal(2,1), @currGrade varchar(2)
    Set @totalGPE = 0;
   
    OPEN grade_cur;
    FETCH NEXT FROM grade_cur
    INTO @currGrade;
   
    WHILE @@FETCH_STATUS=0
    BEGIN
                 if (@currGrade = ‘A+’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  12.0/3.0;
                 END 
                 if (@currGrade = ‘A’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  11.0/3.0;
                 END 
                 if (@currGrade = ‘A-’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  10.0/3.0;
                 END 
                 if (@currGrade = ‘B+’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  9.0/3.0;
                 END 
                 if (@currGrade = ‘B’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  8.0/3.0;
                 END 
                 if (@currGrade = ‘B-’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  7.0/3.0;
                 END 
                 if (@currGrade = ‘C+’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  6.0/3.0;
                 END 
                 if (@currGrade = ‘C’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  5.0/3.0;
                 END 
                 if (@currGrade = ‘C-’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  4.0/3.0;
                 END
                 if (@currGrade = ‘D+’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  3.0/3.0;
                 END 
                 if (@currGrade = ‘D’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  2.0/3.0;
                 END 
                 if (@currGrade = ‘D-’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  1.0/3.0;
                 END
                 if (@currGrade = ‘F’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  0.0;
                 END
                 if (@currGrade = ‘IP’)
                 BEGIN
                                 set @totalGPE = @totalGPE +  0.0;
                 END 
                 
                 FETCH NEXT FROM grade_cur
                 INTO @currGrade;
         END
         CLOSE grade_cur;
         DEALLOCATE grade_cur;

        --get total credit hours attempted by summing the credits for all courses
    DECLARE @totalCHA decimal(2,1)
    SELECT    @totalCHA = Sum(creditHours)
    FROM       COURSE C
    WHERE     C.courseNumber IN (SELECT  E.courseNumber 
          FROM      ENROLL E
            JOIN        SECTIONS S on E.sectID = S.sectID 
            WHERE   E.mNumber = @mNumber) SECT
        RETURN(@totalGPE / @totalCHA)
  END
  GO";

  $gpa_function_result = mysql_query($gpa_funtion_query);
  // $gpa = mysql_fetch_row($gpa_function_result);
  // echo strval($gpa_function_result);

function calculate_gpa($mNum) {
  $gpa_result = mysql_query("select calculateGPA(".$mNum.")");
  $gpa = mysql_fetch_array($gpa_result);
  echo $gpa[0];
  echo "gpa result???";
  echo strval($gpa_result);
  return $gpa;
}
// $result = mysql_query("select functionName($id)");
// $row = mysql_fetch_row($result, $link);
// $returnValue = $row[0];
?>