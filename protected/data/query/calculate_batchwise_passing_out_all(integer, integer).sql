SELECT DISTINCT * from public.calculate_batchwise_passing_out_all(
    2,
    2015
);

SELECT 
  d.dpt_name, 
  p.pro_name, 
  s."studentID",
  a."batchName",
  concat(x."per_firstName", ' ', x."per_lastName") AS per_name,  
  x."per_dateOfBirth", 
  x."per_fathersName", 
  x."per_mothersName", 
  a."adm_startYear",   
  ac.ach_degree, 
  ac."ach_passingYear", 
  ac.ach_result 
  
FROM 
  public.tbl_b_department d, 
  public.tbl_c_programme p, 
  public.tbl_k_academichistory ac, 
  public.tbl_j_person x, 
  public.tbl_o_student s, 
  public.tbl_p_admission a
WHERE 
  d."departmentID" = p."departmentID" AND
  p."programmeCode" = a."programmeCode" AND
  x."personID" = ac."personID" AND
  s."personID" = x."personID" AND
  a."studentID" = s."studentID" AND
  s."stu_academicYear" >= 2018
  ORDER BY s."studentID";