 SELECT 
                distinct q."batchName",
                t."exm_examTerm" as term, 
                t."exm_examYear" as year, 
                q."programmeCode" as id
              FROM 
                public.tbl_u_exammarks u, 
                public.tbl_t_examination t, 
                public.tbl_s_moduleregistration s, 
                public.tbl_q_termadmission q
              WHERE 
                u."examinationID" = t."examinationID" AND
                u."moduleRegistrationID" = s."moduleRegistrationID" AND
                s."termAdmissionID" = q."termAdmissionID" AND
                q."programmeCode" = '111' AND     
                t.exm_type =  3 AND             
                u.emr_date between '2020-02-01' AND '2021-09-30' 
                order by t."exm_examYear",
                t."exm_examTerm",
                q."batchName";
