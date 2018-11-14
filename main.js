(function() {

   var request;
    window.Async = function() {
        return {
            ready: function() {
               try {
                  // Opera, Firefox, Safari
                  request = new XMLHttpRequest();
               }catch (e) {
                  // Internet Explorer Browsers
                  try {
                     request = new ActiveXObject("Msxml2.XMLHTTP");
                  }catch (e) {
                     try {
                        request = new ActiveXObject("Microsoft.XMLHTTP");
                     }catch (e) {
                        // Something went wrong
                        alert("Your browser is old, recomend update it!");
                        return false;
                     }
                  }
               }
               //request = new XMLHttpRequest() || ActiveXObject("Msxml2.XMLHTTP") || ActiveXObject("Microsoft.XMLHTTP");
            },
            start: function(method, to, bool) {
               request.open(method, to, bool);
            },
            contentType: function(app = null) {
               // request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
               request.setRequestHeader("Content-type", app === null ? "application/x-www-form-urlencoded" : app);
               // request.setRequestHeader("Connection", "close");
            },
            sending: function(content = null) {
               request.send(content === null ? null : content);
               return;
            },
            response: function(where = null, callback) {
                let sec = document.querySelector(where);
                request.onreadystatechange = function() {
                    if(request.readyState < 4 && request.status < 200){
                       sec.innerHTML = "Loading...";
                    }

                    if (request.readyState == 4 && request.status == 200) {
                       if(sec !== null) {
                          sec.innerHTML += request.responseText;
                       }

                       if(callback) callback(request.responseText);

                       return;

                    }
                }

            }
        };
    };
}());
const async = Async();

          /* **** B E G I N **** */

window.addEventListener("load",function(){


  // Main Variables

  var admin_dash     = document.querySelector("#dashboard"),
      user_way       = document.querySelector("#user_way");
      wrapper        = document.querySelector(".wrapper"),
      title_info     = document.querySelector(".title--info"),
      user_log_page  = document.querySelector("#state_user_log"),
      reg_user_page  = document.querySelector("#reg_user_page") ;



  // Admin dashboard add users and modify theirs

if(admin_dash){
  // query for inserting admin user and pass
    const load_adm = {
      adm_load_val: "1"
    };

    async.ready();
    async.start("POST","routers/rout.php",true);
    async.contentType();
    async.response(".data_response");
    async.sending(`load_adm=1`);//${load_adm.adm_load_val}


  // Admin dashboard main variables

  var clk_insert_usr     = document.querySelector("button.users_send"),
      clk_update_usr     = document.querySelector(".update_user_pop"), // ura sra click@
      mgmr               = document.querySelectorAll(".data--fields_admin .mgmr_workers a"),
      radios             = document.getElementsByName("radio"),
      data_edit_pop      = document.querySelector(".data_pop_up_adm"),
      pop_adm_edit       = document.querySelector(".open_update_user"),
      clk_close_edit_pop = document.querySelector(".data_pop_up_adm .cross_pop"),
      clk_delete_user    = document.querySelector("button.delete_user")
      clk_edit_user_btn  = "";



  // Delete the user
 try {

    clk_delete_user.addEventListener("click",function(e){
        e.preventDefault();

         // get user id from checked radio
          for (var i = 0, length = radios.length; i < length; i++) {

             if (radios[i].checked) {
               var value_r = radios[i].value;
               break;
             }

          }

          const adm_users = {
             radio_value:value_r
          };

          async.ready();
          async.start("POST","routers/rout.php",true);
          async.contentType();
          async.response(); //".data_response"
          async.sending(`radio_value=${adm_users.radio_value}`);

          setTimeout(function(){ window.location.reload(); },300);
    });

 } catch(e) {
   console.log(e + "</br>" + " Line 133 in file main.js try something wrotn maybe async.response() function");
 }





  // inserting the users
  clk_insert_usr.addEventListener("click", function(e){
    e.preventDefault();

    // Local variables
    let user_names     = document.querySelector(".usr_names"),
        user_address   = document.querySelector(".usr_addr"),
        usr_tel        = document.querySelector(".usr_tel"),
        usr_state      = document.querySelector(".users_info .usr_state"),
        usr_pass       = document.querySelector(".usr_pass"),
        usr_email      = document.querySelector(".usr_email");


    const adm_users = {
      nm_srname: user_names.value,
      addr:      user_address.value,
      tel:       usr_tel.value,
      state:     usr_state.value,
      pass:      usr_pass.value,
      email:     usr_email.value
    };

    async.ready();
    async.start("POST","routers/rout.php",true);
    async.contentType();
    async.response(".data_response");
    async.sending(`usr_name=${adm_users.nm_srname}&usr_addr=${adm_users.addr}&usr_tel=${adm_users.tel}&usr_state=${adm_users.state}&usr_pass=${adm_users.pass}&usr_email=${adm_users.email}`);

    setTimeout(function(){ window.location.reload(); },400);

  });






  // Update user - pop-up open

  var current_pop = data_edit_pop;

  clk_update_usr.addEventListener("click",function(){

    current_pop.classList.add("open_update_user");
    current_pop.classList.remove("data_pop_up_adm");

    // clk_close_edit_pop.style.display="none";

    // let radios = document.getElementsByName("radio_btn");

     // get user id from checked radio
     for (var i = 0, length = radios.length; i < length; i++) {

        if (radios[i].checked) {
          var value_r = radios[i].value;
          break;
        }

     }


    // (Jquery) ajaxComplete alternative
    setTimeout(function(){
      clk_edit_user_btn = document.querySelector(".update_user_btn");
      clk_edit_user_btn.addEventListener("click",function(evt){
           evt.preventDefault();

           // console.log("work btn");
           let new_name  = document.querySelector(".edit_name"),
               new_addr  = document.querySelector(".edit_addr"),
               new_tel   = document.querySelector(".edit_tel"),
               new_uid   = document.querySelector(".hide_usr_id"),
               new_email = document.querySelector(".edit_email"),
               new_pass  = document.querySelector(".edit_pass"),
               new_state = document.querySelector(".edit_state");

         // Request  for update or delete

         const usr_upd = {
           usr_id: new_uid.value,
           new_n: new_name.value,
           new_a: new_addr.value,
           new_t: new_tel.value,
           new_s: new_state.value,
           new_e: new_email.value,
           new_p: new_pass.value
         };

         async.ready();
         async.start("POST","routers/rout.php",true);
         async.contentType();
         async.response(".data_response");
         async.sending(`user_id=${usr_upd.usr_id}&new_n=${usr_upd.new_n}&new_a=${usr_upd.new_a}&new_t=${usr_upd.new_t}&new_s=${usr_upd.new_s}&new_e=${usr_upd.new_e}&new_p=${usr_upd.new_p}`);

         setTimeout(function(){ window.location.reload(); },300);

     });

    },2000);




    // Request  for get a form content and set to pop window
        const usr_id = {
          u_id: value_r
        };

        async.ready();
        async.start("POST","routers/rout.php",true);
        async.contentType();
        async.response(".open_update_user");
        async.sending(`usr_id=${usr_id.u_id}`);

  });


  // Close user editing pop up and get radio value

  clk_close_edit_pop.addEventListener("click",function(){

    // pop_adm_edit
    current_pop.classList.add("data_pop_up_adm");
    current_pop.classList.remove("open_update_user");

  });

  // Updating data user
  // let clk_edit_user_btn  = document.querySelector(".update_user_btn");

} // end admin dashboard ##############



// If isn't admin dashboard page *********************

if (user_way){

  // query for inserting admin user and pass
    const load = {
      val: "1"
    };

    async.ready();
    async.start("POST","routers/rout.php",true);
    async.contentType();
    async.response(".data_response");
    async.sending(`load=${load.val}`);


    var admin_pop      = document.querySelector(".admin_login_pop_bg"),
        close_adm      = document.querySelector(".admin_login_pop .cross"),
        clk_adm_button = document.querySelector(".adm_log button"),
        burger_block   = document.querySelector(".burger"),
        clk_burger     = document.querySelector(".burger_lines"),
        brg_iterator   = 0,
        clk_admin_log  = document.querySelector(".admin_login_clk");



  //  Wrapper Text Show and hide
  wrapper.addEventListener("mouseenter", function(){
    title_info.classList.add("show_text");
  });

  wrapper.addEventListener("mouseleave", function(){
    title_info.classList.remove("show_text");
  });

 // Admin pop-up login

  clk_admin_log.addEventListener("click", function(event){
    event.preventDefault();
    admin_pop.classList.add("show_pop_admin");
  });

  close_adm.addEventListener("click", function(evt){
    evt.preventDefault();
    admin_pop.classList.remove("show_pop_admin");
  });


// Admin log in button request

 // clk_adm_button.addEventListener("click", function(evt){
 //  evt.preventDefault();

 //  let admin_name_val = document.querySelector(".adm_log input[type='text']").value;
 //  let admin_pass_val = document.querySelector(".adm_log input[type='password']").value;

 //  const admin_data = {
 //    name_val: admin_name_val,
 //    pass_val: admin_pass_val,
 //    adm_login:"login"
 //  };

 //  async.ready();
 //  async.start("POST","index.php",true);
 //  async.contentType();
 //  async.response(".data_response");
 //  async.sending(`admin_name=${admin_data.name_val}&admin_pass=${admin_data.pass_val}&login=${admin_data.adm_login}`);

 // });



// Burger Menu open and close in mobile device

 clk_burger.addEventListener("click",function(){
   brg_iterator++;
   if(brg_iterator % 2 === 1){

      burger_block.classList.remove("burger_close");
      burger_block.classList.add("burger_open");

   }

   if(brg_iterator % 2 === 0){

      burger_block.classList.add("burger_close");
      burger_block.classList.remove("burger_open");

   }

 });

} // End user_way



// User Login Page
if(user_log_page){


  let usr_e_log     = document.querySelector(".email_user_log"),
      usr_pass_log  = document.querySelector(".pass_user_log"),
      clk_login     = document.querySelector(".user_login");

  clk_login.addEventListener("click",function(e){
      e.preventDefault();
      // alert("work");
      const usr_data = {
        usr_e: usr_e_log.value,
        usr_p: usr_pass_log.value
      };

      async.ready();
      async.start("POST","routers/rout.php",true);
      async.contentType();
      async.sending(`log_u_e=${usr_data.usr_e}&log_u_p=${usr_data.usr_p}`);
      async.response(null, getResult);

      function getResult(arg) {
        if(arg === "ok"){
          window.location.href = "users.php";
        }else{
          console.log(" location.href cant doing becouse don't have valid response");
        }
      }

      //https://medium.com/front-end-hacking/ajax-async-callback-promise-e98f8074ebd7

      /*XMLHttpRequest.prototype.send = function() {
           this.addEventListener('load', function() {
              console.log('global handler', this.responseText)
              // add your global handler here

              if(res === "ok"){
                window.location.href = "users.php";
              }else{
                console.log(" location.href cant do becouse don't have valid response");
              }

            });
        return send.apply(this, arguments);
      };*/


      // if(res === "ok"){
      //   window.location.href = "../users.php";
      // }else{
      //   //console.log(" location.href cant do becouse don't have valid response");
      // }

  });

} // end user login page


// User registration page

if(reg_user_page){

  // Variables
  let name_user          = document.querySelector(".name_user"),
      addr_user          = document.querySelector(".addr_user"),
      phone_user         = document.querySelector(".phone_user"),
      state_user         = document.querySelector(".state_user"),
      pass_user          = document.querySelector(".pass_user"),
      email_user         = document.querySelector(".email_user"),
      clk_register_user  = document.querySelector(".register_user");


   // Validation

  function is_valid(){

    return{
      email: function(fld_email){
        let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
         if (re.test(fld_email)) return true;
      },

      email_repeat: function(){

      }

    };
  }
  const isValid = is_valid();

  clk_register_user.addEventListener("click", function(e){
    e.preventDefault();


    const usr = {
        na_user: name_user.value,
        ad_user: addr_user.value,
        ph_user: phone_user.value,
        st_user: state_user.value,
        pa_user: pass_user.value,
        em_user: email_user.value
    };

    async.ready();
    async.start("POST","routers/rout.php",true);
    async.contentType();
    async.sending(`na_user=${usr.na_user}&ad_user=${usr.ad_user}&ph_user=${usr.ph_user}&st_user=${usr.st_user}&pa_user=${usr.pa_user}&em_user=${usr.em_user}`);
    async.response(null, Result);

      function Result(argm) {

        if(argm === "email_exists"){
          alert("Can't register , that email is exists");
        }else{
          alert("Registration success !");
          setTimeout(function(){ window.location.href = "http://local.projects/new/astudio_task/php/"; }, 400);
        }

      }



    // if(isValid.email(email_user.value)){

    //   // document.write("your email is valid");
    // }else{
    //   // document.write("email isn't valid");
    // }

  });



} // end User registration page



}); // end window load