------------------

-----------------Database Changes-----------

------------------verion 7p2 to verison ----------8p0-----------------

ALTER TABLE public.tbl_y_user ADD COLUMN usr_otp character varying(200);
ALTER TABLE public.tbl_y_user ADD COLUMN "usr_otpExpire" integer;
ALTER TABLE public.tbl_y_user ADD COLUMN "usr_lastLoginAt" timestamp with time zone;
ALTER TABLE public.tbl_y_user ADD COLUMN "usr_resetToken" character varying(200);
ALTER TABLE public.tbl_y_user ADD COLUMN "usr_resetTokenExpire" integer;
ALTER TABLE public.tbl_y_user ADD COLUMN "usr_lastLoginIP" character varying(20);
ALTER TABLE public.tbl_y_user ADD COLUMN "usr_lastLoingMAC" character varying(20);
ALTER TABLE public.tbl_y_user ADD COLUMN "usr_loginLog" json;

-- ALTER TABLE public.tbl_y_user DROP CONSTRAINT tbl_y_user_pkey;

ALTER TABLE public.tbl_y_user
  ADD CONSTRAINT tbl_y_user_pkey PRIMARY KEY("personID");


ALTER TABLE public.tbl_h_offeredmodule ADD COLUMN "userID" integer;
COMMENT ON COLUMN public.tbl_h_offeredmodule."userID" IS 'for access';

ALTER TABLE public.tbl_h_offeredmodule
  ADD CONSTRAINT fk_offeredmodule_user FOREIGN KEY ("userID")
      REFERENCES public.tbl_y_user ("personID") MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE public.tbl_u_exammarks ADD COLUMN "userID" integer;

ALTER TABLE public.tbl_u_exammarks ADD COLUMN emr_complete boolean;
ALTER TABLE public.tbl_u_exammarks ALTER COLUMN emr_complete SET NOT NULL;
ALTER TABLE public.tbl_u_exammarks ALTER COLUMN emr_complete SET DEFAULT false;

ALTER TABLE public.tbl_u_exammarks ADD COLUMN erm_publish boolean;
ALTER TABLE public.tbl_u_exammarks ALTER COLUMN erm_publish SET NOT NULL;
ALTER TABLE public.tbl_u_exammarks ALTER COLUMN erm_publish SET DEFAULT false;

ALTER TABLE public.tbl_u_exammarks
  ADD CONSTRAINT fk_exammarks_person FOREIGN KEY ("facultyID")
      REFERENCES public.tbl_j_person ("personID") MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE public.tbl_u_exammarks
  ADD CONSTRAINT fk_exammarks_user FOREIGN KEY ("userID")
      REFERENCES public.tbl_y_user ("personID") MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE SET NULL;
	  
------------------------------------------------------------------------------------------------------------
-- ALTER TABLE public.tbl_y_user DROP COLUMN "usr_lastLoginAt";

ALTER TABLE public.tbl_y_user ADD COLUMN "usr_lastLoginAt" integer;	  
------------------------------------------------------------------------------------------------------------
---DROP VIEW public.vw_usr_faculty;

CREATE OR REPLACE VIEW public.vw_usr_faculty AS 
 SELECT concat_ws(' '::text, p.per_title, p."per_firstName", p."per_lastName") AS per_name,
    p.per_email,
    p.per_mobile,
    p."per_bloodGroup",
    p.ex_per_ref,
    d."departmentID",
    d.dpt_code,
    d.dpt_name,
    t.*
    
   FROM tbl_y_user t
     JOIN tbl_j_person p ON p."personID" = t."personID"
     JOIN tbl_n_faculty f ON f."facultyID" = t."personID"
     JOIN tbl_b_department d ON d."departmentID" = f."departmentID"
  WHERE t.usr_active = true;

ALTER TABLE public.vw_usr_faculty
  OWNER TO postgres;
GRANT ALL ON TABLE public.vw_usr_faculty TO postgres;
GRANT SELECT ON TABLE public.vw_usr_faculty TO admission;
GRANT SELECT ON TABLE public.vw_usr_faculty TO coordinator;
GRANT SELECT ON TABLE public.vw_usr_faculty TO deo;
GRANT SELECT ON TABLE public.vw_usr_faculty TO exam;
GRANT SELECT ON TABLE public.vw_usr_faculty TO faculty;
GRANT SELECT ON TABLE public.vw_usr_faculty TO head;
GRANT SELECT ON TABLE public.vw_usr_faculty TO registry;
GRANT ALL ON TABLE public.vw_usr_faculty TO "super-admin";


--------------------------------------------------------------
-- DROP VIEW public.vw_usr_employee;

CREATE OR REPLACE VIEW public.vw_usr_employee AS 
 SELECT concat_ws(' '::text, p.per_title, p."per_firstName", p."per_lastName") AS per_name,
    p.per_email,
    p.per_mobile,
    p."per_bloodGroup",
    p.ex_per_ref,
    a."administrationID",
    a."administrationCode",
    a.adm_name,
    t.*
    
   FROM tbl_y_user t
     JOIN tbl_j_person p ON p."personID" = t."personID"
     JOIN tbl_m_employee m ON m."employeeID" = t."personID"
     JOIN tbl_i_administration a ON a."administrationCode"::text = m."administrationCode"::text
  WHERE t.usr_active = true;

ALTER TABLE public.vw_usr_employee
  OWNER TO postgres;
GRANT ALL ON TABLE public.vw_usr_employee TO postgres;
GRANT ALL ON TABLE public.vw_usr_employee TO public;
GRANT ALL ON TABLE public.vw_usr_employee TO "super-admin";
GRANT SELECT ON TABLE public.vw_usr_employee TO admission;
GRANT SELECT ON TABLE public.vw_usr_employee TO coordinator;
GRANT SELECT ON TABLE public.vw_usr_employee TO deo;
GRANT SELECT ON TABLE public.vw_usr_employee TO exam;
GRANT SELECT ON TABLE public.vw_usr_employee TO faculty;
GRANT SELECT ON TABLE public.vw_usr_employee TO head;
GRANT SELECT ON TABLE public.vw_usr_employee TO registry;

------------------------------------------------------------------


-- Function: public.sp_user_authentication(character varying)

-- DROP FUNCTION public.sp_user_authentication(character varying);

CREATE OR REPLACE FUNCTION public.sp_user_authentication(IN "per_loginID" character varying)
  RETURNS TABLE("uLoginID" character varying, u_active boolean, u_password character varying, u_role character varying, u_type character varying, "uPersonID" integer, u_name text, u_email character varying, u_mobile character varying, u_bloodgroup character varying, "u_dptID" integer, "u_dptCode" character varying, "u_dptName" character varying, u_otp character varying, "u_otpExpire" integer, "u_resetToken" character varying, "u_resetTokenExpire" integer, "u_lastLoginIP" character varying, "u_lastLoingMAC" character varying, "u_lastLoginAt" integer) AS
$BODY$
	DECLARE ref char(1);
BEGIN
	
	SELECT 
	  j.ex_per_ref into ref
	FROM 
	  public.tbl_y_user y, 
	  public.tbl_j_person j
	WHERE 
	  y."personID" = j."personID" AND y.usr_active=true and
	  y."loginID" = $1;

  
	IF ref='f' THEN
		return query select 
		"loginID" as	"uLoginID",
		usr_active as u_active,
		usr_password	as	u_password , 
		usr_role	as	u_role , 
		ex_per_ref	as	u_type ,
		"personID"	as	"uPersonID" ,
		per_name	as	u_name ,
		per_email	as	u_email ,
		per_mobile	as	u_mobile ,
		"per_bloodGroup"	as	u_bloodGroup ,
		"departmentID"	as	"u_dptID" ,
		dpt_code	as	"u_dptCode" ,
		dpt_name	as	"u_dptName",
		usr_otp  as u_otp,
		  "usr_otpExpire" as "u_otpExpire",
		  "usr_resetToken" as "u_resetToken",
		  "usr_resetTokenExpire" as "u_resetTokenExpire",
		  "usr_lastLoginIP" as "u_lastLoginIP",
		  "usr_lastLoingMAC" as "u_lastLoingMAC",
			"usr_lastLoginAt" as "u_lastLoginAt"		  
		from vw_usr_faculty Where "loginID"=$1; 
 
	ELSEIF ref='e' THEN
		return query select 
		"loginID" as	"uLoginID",
		usr_active as u_active, 
		usr_password	as	u_password , 
		usr_role	as	u_role , 
		ex_per_ref	as	u_type ,
		"personID"	as	"uPersonID" ,
		per_name	as	u_name ,
		per_email	as	u_email ,
		per_mobile	as	u_mobile ,
		"per_bloodGroup"	as	u_bloodGroup ,
		"administrationID"	as	"u_dptID" ,
		"administrationCode"	as	"u_dptCode" ,
		adm_name	as	"u_dptName",
		usr_otp as u_otp,
		  "usr_otpExpire" as "u_otpExpire",
		  "usr_resetToken" as "u_resetToken",
		  "usr_resetTokenExpire" as "u_resetTokenExpire",
		  "usr_lastLoginIP" as "u_lastLoginIP",
		  "usr_lastLoingMAC" as "u_lastLoingMAC",
		"usr_lastLoginAt" as "u_lastLoginAt"		  
		from vw_usr_employee Where "loginID"=$1; 

	
	END IF;

    
    END
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION public.sp_user_authentication(character varying)
  OWNER TO postgres;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO postgres;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO "super-admin" WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO admission WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO coordinator WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO deo WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO exam WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO faculty WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO head WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO registry WITH GRANT OPTION;
GRANT EXECUTE ON FUNCTION public.sp_user_authentication(character varying) TO admin;
REVOKE ALL ON FUNCTION public.sp_user_authentication(character varying) FROM public;

-----------------------------------------------------13-09-2020---------------------

-- ALTER TABLE public.tbl_y_user DROP COLUMN usr_password;

ALTER TABLE public.tbl_y_user ADD COLUMN usr_password character varying(200);

