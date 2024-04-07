$().ready(function(){

    //submit form


    $("#signUpForm").validate({
        
        rules:{
            fullName:"required",
            email:{
                required:true,
                email:true
            },
            password:{
                required:true,
                minlength:8,

            },
            confirmpassword:{
                required:true,
                minlength:8,
                equalTo:"#password"
            },
            remember:"required",
        },
        messages:{
            fullName:"Please enter your full name",
            email:{
                required:"Please entr your email",
                email:"Please enter valid email address"
            },
            password:{
                required:"Please provide your password",
                minlength:"Not less than 8 characters long"
            },
            confirmPassword:{
                required:"Please enter your password again",
                minlength:"Your password must be at least 8 characters long",
                equalTo:"Please enter the same password as above"

            },
            remember:"Please accept our terms and conditions"
        }

    });



   //Login form
  
   $("#loginForm").validate({

    rules: {
        email:{
            required:true,
            email:true

        },
        password: "required"
    },

    messages:{
        email:{
            required:"Please entr your email",
            email:"Please enter valid email address"
        },
        password:{
            required:"Please provide your password",
        }
    }


   });

   //Add a New Bike Form Validation

   $("#addBikeForm").validate({
        
    rules:{
        registrationNo: {
            required:true,
            maxlength:7
        },
        bikename:"required",
        bikebrand:"required",
        datereg:"required",
        lastmont:"required",

    },
    messages:{
       registrationNo:{
        required:"Please enter a valid registration No",
        maxlength:"You registration characters must be at most 7 characters"
       },
       bikename:{
        required:"Please enter your bike name"
       },
       bikebrand:{
        required:"Please enter your bike brand"
       },
       datereg:{
        required:"Please enter your bike registration date"
       },
       lastmont:{
        required:"Please enter your bike last MOT"
       }
       

    }



   });

   $("#addNewJobForm").validate({

    rules:{
        jobname:"required",
        jobbrand:"required",
        jobdesc:"required",
        service:"required",
        upload:"required",
        calender:"required",

    },
    messages:{
        jobname:{
        required:"Please enter your job name",
     
       },
       jobbrand:{
        required:"Please enter your brand name"
       },
       jobdesc:{
        required:"Please enter your job description"
       },
       service:{
        required:"Please Select your service type"
       },
       upload:{
        required:"Please Upload a picture of your bike"
       },
       calender:{
        required:"Please select appointment date"
       }
       

    }

   });

// Update password form validation




   $("#updatePassword").validate({

    rules: {
        email:{
            required:true,
            email:true
        },
        password:{
            required:true,
            minlength:8,

        },
        confirmpassword:{
            required:true,
            minlength:8,
            equalTo:"#password"
        },
    },

    messages:{
        email:{
            required:"Please entr your email",
            email:"Please enter valid email address"
        },
        password:{
            required:"Please provide your password",
            minlength:"Not less than 8 characters long"
        },
        confirmPassword:{
            required:"Please enter your password again",
            minlength:"Your password must be at least 8 characters long",
            equalTo:"Please enter the same password as above"

        },
    }


   });
   
   $("#mechanicForm").validate({

    rules: {
        phone1:"required",
        address:"required",
    },

    messages:{
        phone1:{
            required:"Please entr mechanic Phone Number",
        },
        address:{
            required:"Please provide current mechanic address",

        },

    }


   });
   $("#editMechanicForm").validate({

    rules: {
        email:"required",
        fullName:"required",
        phone1:"required",
        address:"required"
    },

    messages:{
        email:{
            required:"Please enter email",
        },
        phone1:{
            required:"Please enter Full Name",
        },
        address:{
            required:"Please enter address"

        },

    }


   });

});







