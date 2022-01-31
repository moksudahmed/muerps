/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//alert('Bismillah Hir Rahmanir Rahim');

const app = Vue.createApp({
    data(){
        return {
            product: 'student',
            description: 'This is page where you can do all activities for a student',
            count: 0,
            message: 'You loaded this page on ' + new Date().toLocaleString(),
            pass: 40,
            grades: [{marks:65,grade:'B+'}, 
                {marks:70,grade:'A-'},
                {marks:75,grade:'A'},
                {marks:80,grade:'A+'}]
            ,
            
        }
    },
    mounted(){
        setInterval(
        ()=>{
            this.count ++
        }, 1000        
        )
    },
    methods:{
        reverseMessage(){
            this.message = this.message.split('').reverse().join('');
        },
       gradeMsg()
       {
           if(this.product>this.pass)
               return 'PASSED';
           else return 'FAILED';
       }
    }   
})

