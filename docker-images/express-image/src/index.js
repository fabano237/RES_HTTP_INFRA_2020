var Chance = require('chance');

var chance = new Chance();

const express = require('express');
const app = express();
const port = 2020;

app.get('/', (req, res) => res.send(generateStudents()));
app.listen(port,() => console.log(`Accepting HTTP request on: ${port}`));

function generateStudents(){
    var numberOfstudents = chance.integer({min:0, max: 10});
    console.log(numberOfstudents);
    var students = [];

    for(var i = 0; i < numberOfstudents; ++i){
        var gender = chance.gender();
        var birthYear = chance.year({min: 1993, max: 2020});

        students.push({firstName: chance.first({gender: gender}),
                       lastName:  chance.last(),
                       gender:    gender,
                       birthday:  chance.birthday({year: birthYear})});
    };

    console.log(students + '\n');
    return students;
}
