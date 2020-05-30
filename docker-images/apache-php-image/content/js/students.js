$(function() {
    console.log("geting students Name");
    function getStudentsNames() {
        $.getJSON("/api/students/", function(students) {
            var message = "Nobody is here";
            console.log(students);
            if(students.length > 0){
                message = students[0].firstName + " " + students[0].lastName;
            }
            $(" .masthead-subheading").text(message);

        });
    };
    getStudentsNames();
    setInterval(getAStudentsNames, 2000);
});