/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function nanToZero(n){
            if (isNaN(n))n=0;
            return n;
        }

function gradePoint(totalmark){
                        
        if(totalmark>=80 && totalmark<=100){ return 'A+';}
	else if(totalmark>=75 && totalmark<80){return 'A';}
	else if (totalmark>=70 && totalmark<75){ 
		return 'A-';}
	else if (totalmark>=65 && totalmark<70) {
		return 'B+';}
	else if (totalmark>=60 && totalmark<65) {
		return 'B';}
	else if (totalmark>=55 && totalmark<60) {
		return 'B-';}
	else if (totalmark>=50 && totalmark<55) {
		return 'C+';}
	else if (totalmark>=45 && totalmark<50) {
		return 'C';}
	else if (totalmark>=40 && totalmark<45) {
		return 'D';}
	else { return 'F*';}

                    }