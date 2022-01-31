-- Function: public.calculate_batchwise_passing_out_list(integer, integer)

-- DROP FUNCTION public.calculate_batchwise_passing_out_list(integer, integer);
--DROP FUNCTION public.calculate_batchwise_passing_out_all(integer, integer);
CREATE OR REPLACE FUNCTION public.calculate_batchwise_passing_out_all(
    IN pterm integer,
    IN pyear integer)
  RETURNS TABLE(studentid character varying, comletedcredit real, requiredcredit real, status character varying, programmecode character varying, lastentry date) AS
$BODY$
DECLARE 
    var_r record;     
    maxCredit float;
    cgpa numeric;
    entry date;
BEGIN
   /* SELECT "studentID","stu_academicTerm", "stu_academicYear", "programmeCode", (SELECT sum(c_actual_credithour) as actual FROM generate_transcript(a."studentID")) FROM public.tbl_o_student WHERE "stu_academicYear" >= 2015;*/
   FOR var_r IN (SELECT a."studentID", a."batchName", a."programmeCode", (SELECT sum(c_actual_credithour) as actual FROM generate_transcript(a."studentID")) FROM   tbl_q_termadmission a WHERE  a.tra_year >= pyear)
    LOOP   
		SELECT s."syl_maxCreditHour" INTO maxCredit FROM  public.tbl_f_batch b,  public.tbl_d_syllabus s WHERE  b."syllabusCode" = s."syllabusCode" AND  b."batchName" = var_r."batchName" AND   b."programmeCode" = var_r."programmeCode";		
		SELECT MAX(emr_date) into lastentry FROM vw_result_final_exam WHERE "studentID"= var_r."studentID";
		IF var_r.actual >= maxCredit THEN
		  studentId 	:= var_r."studentID";
		  comletedcredit := var_r.actual;
		  requiredcredit := maxCredit;		  
		  status	 := 'complete';
		ELSE
		  studentId 	 := var_r."studentID";
		  comletedcredit := var_r.actual;		  
		  requiredcredit := maxCredit;
		  status	 := 'incomplete';
		END IF;	
		 programmecode := var_r."programmeCode";
		 entry := lastentry;        
		  	
	 RETURN NEXT; 
    END LOOP;           
	    
END; $BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.calculate_batchwise_passing_out_list(integer, integer)
  OWNER TO postgres;
GRANT EXECUTE ON FUNCTION public.calculate_batchwise_passing_out_list(integer, integer) TO public;
GRANT EXECUTE ON FUNCTION public.calculate_batchwise_passing_out_list(integer, integer) TO postgres;
GRANT EXECUTE ON FUNCTION public.calculate_batchwise_passing_out_list(integer, integer) TO admin;
GRANT EXECUTE ON FUNCTION public.calculate_batchwise_passing_out_list(integer, integer) TO exam;
