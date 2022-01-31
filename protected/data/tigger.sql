CREATE TRIGGER tbl_a_school_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_a_school FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();



CREATE TRIGGER tbl_aa_fees_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_aa_fees FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_ab_waiver_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_ab_waiver FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();



CREATE TRIGGER tbl_ac_batchfees_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_ac_batchfees FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER  tbl_b_department_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON  tbl_b_department FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_c_programme_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_c_programme FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_d_syllabus_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_d_syllabus FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_e_module_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_e_module FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_f_batch_insert_deletetbl_f_batch
AFTER INSERT OR DELETE OR UPDATE ON tbl_f_batch FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_g_section_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_g_section FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();

CREATE TRIGGER tbl_h_offeredmodule_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_h_offeredmodule FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_i_administration_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_i_administration FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_j_person_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_j_person FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_k_academichistory_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_k_academichistory FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_k_institution_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_k_institution FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_l_jobexperiance_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_l_jobexperiance FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_m_employee_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_m_employee FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_n_faculty_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_n_faculty FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_o_student_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_o_student FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_p_admission_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_p_admission FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();



CREATE TRIGGER tbl_q_termadmission_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_q_termadmission FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_r_markingscheme_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_r_markingscheme FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_s_moduleregistration_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_s_moduleregistration FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();



CREATE TRIGGER tbl_t_examination_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_t_examination FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();



CREATE TRIGGER tbl_u_exammarks_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_u_exammarks FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_v_timeSlot_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON "tbl_v_timeSlot" FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();



CREATE TRIGGER tbl_w_room_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_w_room FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_x_university_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_x_university FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();


CREATE TRIGGER tbl_y_user_insert_delete
AFTER INSERT OR DELETE OR UPDATE ON tbl_y_user FOR EACH ROW
EXECUTE PROCEDURE audit.if_modified_func();
