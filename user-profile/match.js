$(function() {
	$.getScript("https://cdn.firebase.com/js/client/2.0.2/firebase.js", function(){
});
$.getScript("https://cdn.firebase.com/libs/firechat/2.0.1/firechat.min.js", function(){
});

  var person = {
    User:"",
    major: "",
    image: "",
    year: "",
    email: "",
    bio:""
};



  $("#yes").click(function(){
    yesMatch();
    getNew();}
  );
  $("#no").click(function(){
    noMatch();
    getNew();}
  );

  var fillInData = function(){
    if(person.User != "blank"){
      $( "#tester" ).text(person.User);
      $("#year").text(person.year);
      $("#biography").text(person.bio);
      if(person.image != undefined){
      $("#head").attr("src","create-profile/"+person.image);
      }
    }
    else{
      $( "#tester" ).text("NO MORE");
      $("#year").text("NO MORE");
      $("#biography").text("NO MORE");

  }
}


 var yesMatch = function(){
    $.post( "matchHandler.php", { email: person.email, answer: "yes" },function(){
    $.get( "dcheck.php", function( data ) {
    if(data.d == "yes"){
    	console.log("hi");
      createChat(data.hasher);}
      else{
      	console.log("bye");
      }
    },"json");})
  }

  

  var noMatch = function(){
    $.post( "matchHandler.php", {  email: person.email, answer: "no" } );
  }
	
	var createChat = function(cname){
      var chatRef = new Firebase("https://davidschat.firebaseio.com/");
      var chat = new Firechat(chatRef);
      chatRef.onAuth(function(authData) {
        if (authData) {
          chat.setUser(authData.uid, "Anon" + authData.uid.substr(10, 8));
        } else {
          chatRef.authAnonymously(function(error, authData) {
            if (error) {
              console.log(error);
            }
          });
        }
      });
      chat.createRoom(cname, "public", function( data ) {
      
     $.post( "addchatid.php", { chatid: data, chatname: cname } );
  	});
    }

  var getNew = function(){

    $.get( "newMatch.php", function( data ) {
    person.User = data.User;
    person.major = data.Major;
    person.year = data.GradeLevel;
    person.image = data.Image;
    person.email = data.Email;
    person.bio = data.Biography;
    fillInData();

  },"json");
}
  getNew();
  fillInData();

  

});
