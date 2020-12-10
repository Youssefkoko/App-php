// $(document).ready(function(){
//     console.log("Hi students my name is Rick and Im really good!");
// });

$(".submenu").click(function(){
    $(this).children("ul").slideToggle();
});

$("ul").click(function(st){
    st.stopPropagation();
});